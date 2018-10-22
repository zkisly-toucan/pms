@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
<br>
    <div class="box">
        <div class="column is-half">

            <h4 class="title is-4">Projekty</h4>
            <div class="field">
                <input type="text" class='input' v-model="search">
            </div>
            <div class="content">

                <table class="table">
                    <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Właściciel</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="group in projects">
                        <th v-html="group[0]"></th>
                        <th>@{{ group[1] }}</th>
                        <th><a class="button" :href="group[2]">Pokaż</a> </th>
                    </tr>
                    </tbody>

                </table>
            </div>
            <b-field label="Dodaj projekt">
                <b-input expanded v-model="groupName"></b-input>
                <p class="control">
                    <button class="button is-success" @click="addGroup">Dodaj</button>
                </p>
            </b-field>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script defer>
        let app = new Vue({
            el: '#app',
            data: {
                groups: [],
                search: '',
                groupName: ''
            },
            computed: {
                searchArray() {
                    return this.search.split(' ');
                },
                filteredGroups() {
                    let filterable = this.groups;
                    this.searchArray.forEach(function (item) {
                        filterable = filterable.filter(group => {
                            return group.name.toLowerCase().indexOf(item.toLowerCase()) > -1
                        })
                    });
                    return filterable;
                },

                projects() {
                    return this.filteredGroups.map(group => {
                        let replaced = group.name;
                        let i=0;
                        this.searchArray.forEach(function(item){
                            i++;
                            replaced = replaced.replace(new RegExp(item, 'i'), "%<$&%>");
                        });
                        for(;i>=0;i--){
                            replaced = replaced.replace("%<", "<span class='has-background-primary'>");
                            replaced = replaced.replace("%>", "</span>");
                        }

                        return [replaced, group.owner.name, 'project/' +group.id];
                    })
                }
            },

            methods: {
                loadGroups(){
                    axios.get('/api/groups')
                        .then(response => {
                            // handle success
                            this.groups = response.data;
                        })
                        .catch(function (error) {
                            // handle error
                            console.log('error');
                            console.log(error);
                        })
                        .then(function () {
                            // always executed
                        });
                },
                addGroup(){

                    axios.post('/api/group/add', {
                            name: this.groupName
                        })
                        .then(response=> {
                            // handle success
                            this.loadGroups();
                            this.groupName = '';
                        })
                        .catch(function (error) {
                            // handle error
                            console.log('error');
                            console.log(error);
                        })
                        .then(function () {
                            // always executed
                        });
                }
            },

            mounted(){
               this.loadGroups();
            }
        });
    </script>


@endsection
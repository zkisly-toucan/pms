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
    </div>
    </div>
</div>
@endsection

@section('script')
    <script defer>
        var app = new Vue({
            el: '#app',
            data: {
                groups: @json($groups),
                search: ''
            },
            computed: {
                filteredGroups() {
                    return this.groups.filter(group => {
                        return group.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
                    })
                },

                projects() {
                    return this.filteredGroups.map(group => {
                        //let replaced = group.name.replace(this.search, '<span class="has-background-primary">' + this.search + '</span>');
                        let replaced = group.name.replace(new RegExp(this.search, 'i'), "<span class='has-background-primary'>$&</span>");
                        return [replaced, group.owner.name, 'project/' +group.id];
                    })
                }
            }
        });
    </script>


@endsection
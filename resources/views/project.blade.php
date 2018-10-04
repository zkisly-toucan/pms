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
            <h4 class="title is-4">{{$group->name}}</h4>
            <div class="field">
                <input type="text" class='input' v-model="search">
            </div>
            <div class="content">

                <table class="table">
                    <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Wartość</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="group in filteredHGroups">
                        <th v-html="group[0]"></th>
                        <th>@{{ group[1] }}</th>
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
                secrets: @json($secrets),
                search: ''
            },
            computed: {
                filteredGroups() {
                    return this.secrets.filter(secret => {
                        return secret.name.toLowerCase().indexOf(this.search.toLowerCase()) > -1
                    })
                },

                filteredHGroups() {
                    return this.filteredGroups.map(secret => {
                        let replaced = secret.name.replace(this.search, '<span class="has-background-primary">' + this.search + '</span>');
                        return [replaced, secret.value];
                    })
                }
            }
        });
    </script>


@endsection
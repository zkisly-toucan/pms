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
                    <tr v-for="group in filteredHGroups">
                        <th v-html="group[0]"></th>
                        <th>@{{ group[1] }}</th>
                        <th></th>
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
                groups: [
                    ['Charmander', 'Fire'],
                    ['Charizard', 'Fire'],
                    ['Charmeleon', 'Fire'],
                    ['Squirtle', 'Water'],
                    ['Bulbasaur', 'Grass'],
                    ['Pikachu', 'Electric'],
                    ['Raichu', 'Electric'],
                    ['Mew', 'Psychic'],
                    ['Ponyta', 'Fire'],
                    ['Turtwig', 'Grass'],

                ],
                search: ''
            },
            computed: {
                filteredGroups() {
                    return this.groups.filter(group => {
                        return group[0].toLowerCase().indexOf(this.search.toLowerCase()) > -1
                    })
                },

                filteredHGroups() {
                    return this.filteredGroups.map(group => {
                        var replaced = group[0].replace(this.search, '<span class="has-background-primary">' + this.search + '</span>');
                        return [replaced, group[1]];
                    })
                }
            }
        });
    </script>


@endsection
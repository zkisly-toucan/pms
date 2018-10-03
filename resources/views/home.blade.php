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
        <article class="media">
            <table class="table">
                <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Właściciel</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="group in groups">
                    <th>@{{ group[0]}}</th>
                    <th>@{{ group[1] }}</th>
                    <th></th>
                </tr>
                </tbody>

            </table>
        </article>
    </div>
</div>
@endsection

@section('script')
    var app = new Vue({
        el: '#app',
        data: {
            groups: [
                ['SPN', 'Szymon'],
                ['EC1', 'Zbig']

            ]
        }
    });


@endsection
@extends('layouts.app')

@section('content')


    <div class="container">
        <story-component
        v-bind:stories="{{ json_encode($stories) }}">
        </story-component>
    </div>
    <div class="container profile-picture">
        <followers-info-component
                v-bind:images="{{ json_encode($images) }}">
        </followers-info-component>
    </div>
@endsection

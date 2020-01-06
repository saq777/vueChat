@extends('layouts.app')

@section('content')
    <guest-component
        v-bind:guest-info="{{ json_encode($guestInfo) }}"
        v-bind:auth-id="{{ json_encode(auth()->user()->id) }}"
    ></guest-component>
    <followers-info-component
            v-bind:images="{{ json_encode($images) }}">
    </followers-info-component>
@endsection

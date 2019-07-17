@extends('layouts.app')

@section('content')
    <guest-component
        v-bind:guest-info="{{ json_encode($guestInfo) }}"
    ></guest-component>
@endsection

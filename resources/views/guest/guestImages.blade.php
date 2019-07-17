@extends('layouts.app')

@section('content')
    <guest-images-component
        v-bind:guest-images="{{ json_encode($guestImages) }}"
    ></guest-images-component>
@endsection

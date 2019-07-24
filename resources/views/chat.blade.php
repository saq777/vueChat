@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <div>
        <messenger-component
            v-bind:my-info="{{  json_encode($myInfo) }}"
            v-bind:part="{{  json_encode($part) }}"
        ></messenger-component>
    </div>

@endsection

@extends('layouts.app')

@section('content')
    <messenger-component
            v-bind:messages="{{  json_encode($messages) }}"
            v-bind:my-info="{{  json_encode($myInfo) }}"
    ></messenger-component>
@endsection

@extends("layouts.app")

@section("content")
    <settings-component v-bind:settings="{{ json_encode($settings) }}"></settings-component>
@endsection
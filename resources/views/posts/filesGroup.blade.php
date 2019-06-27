@extends('layouts.app')

@section('content')
    <div class="container">
        <group-files
            v-bind:my-info="{{ json_encode($myInfo) }}"
            v-bind:files="{{ json_encode($files) }}"
        ></group-files>
    </div>

@endsection

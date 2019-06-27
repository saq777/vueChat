@extends('layouts.app')

@section('content')
    <div class="container">
        <upload-images
            v-bind:my-info="{{ json_encode($myInfo) }}"
            v-bind:images="{{ json_encode($images) }}"
            v-bind:folder-id="{{ $folderId }}"
        ></upload-images>
    </div>

@endsection

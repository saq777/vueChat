@extends('layouts.app')

@section('content')



    <div class="container profile-picture">
        <followers-info-component v-bind:files="{{ json_encode($files) }}"></followers-info-component>
    </div>
@endsection

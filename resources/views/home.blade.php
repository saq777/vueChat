@extends('layouts.app')

@section('content')



    <div class="container profile-picture">
        <followers-info-component v-bind:images="{{ json_encode($images) }}"></followers-info-component>
    </div>
@endsection

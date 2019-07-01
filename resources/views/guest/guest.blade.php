@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Home</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                Search User
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <search-guest></search-guest>

    <div>
        <messenger-component
            v-bind:messages="{{  json_encode($messages) }}"
            v-bind:my-info="{{  json_encode($myInfo) }}"
            v-bind:guest-info="{{  json_encode($guestUser) }}"
        ></messenger-component>
    </div>

@endsection

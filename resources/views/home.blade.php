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
                    <a href="home/messenger" class="btn-success btn">Messenger</a>
                    <a href="home/files-group" class="btn-primary btn">Upload Image</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

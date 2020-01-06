@extends('layouts.app')

@section('content')
<div class="container">
                <div class="row justify-content-center mt-5">
                    <div class="col-md-3 login-background" style="background-image: url({{ asset('images/logo.png') }});"></div>
                    <div class="col-md-2"></div>
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div>
                                        <label for="name">{{ __('Name') }}</label>
                                    </div>
                                    <div>
                                        <input id="name" type="text" placeholder="Name" class="w-80 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    </div>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <div>

                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                    </div>
                                    <div>
                                        <input id="email" type="email" placeholder="E-mail" class="w-80 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">


                                <div class="col-md-12">
                                    <div>

                                        <label for="password">{{ __('Password') }}</label>
                                    </div>
                                    <div>
                                        <input id="password" type="password" placeholder="********" class="w-80 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <div>
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    </div>
                                    <div>
                                        <input id="password-confirm" placeholder="********" type="password" class="w-80 form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>

@endsection

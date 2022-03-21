@extends('layouts.app')

@section('content')
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Register User</h3>
                        <div class="card-body">
                            @if (Auth::guest())
                                <form action="/register" method="POST">
                                    @csrf
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    <div class="form-group mb-3">
                                        <input type="text" placeholder="Name" id="email_address" class="form-control"
                                            name="name" required autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                    <div class="form-group mb-3">
                                        <input type="text" placeholder="Email" id="email_address" class="form-control"
                                            name="email" required autofocus>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                    <div class="form-group mb-3">
                                        <input type="password" placeholder="Password" id="password" class="form-control"
                                            name="password" required>

                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="password" placeholder="Password Confirmation" id="password"
                                            class="form-control" name="password_confirmation" required>

                                    </div>
                                    <div class="d-grid mx-auto">
                                        <button type="submit" class="btn btn-dark btn-block">Sign up</button>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </form>
                            @else
                                <h1>Sie sind bereits angemeldet</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

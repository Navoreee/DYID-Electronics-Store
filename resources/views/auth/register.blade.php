@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="card p-4">

                <div class="card-body">
                    <h2 class="card-title text-info">Join Us</h2>
                    <br>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <div>
                                <input id="name" type="text" placeholder="Full Name" class="form-control" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="F" {{ old('gender') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="M" {{ old('gender') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <textarea class="form-control" name="address" id="address" placeholder="Address" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <div>
                                <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div>
                                <input id="password" type="password" placeholder="Password" class="form-control" name="password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div>
                                <input id="password_confirmation" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tc" id="tc">

                                    <label class="form-check-label" for="tc">
                                        {{ __('I agree with terms & conditions') }}
                                    </label>
                                </div>
                                @error('tc')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Register Now') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

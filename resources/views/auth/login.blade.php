@extends('layouts.app')

@section('title', __('auth.login user'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-7">
                        @lang('auth.login')
                    </div>
                </div>
            </div>
            <div class="card-body">
            <form method="POST" action="">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="email">@lang('auth.email')</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}"
                            aria-describedby="emailHelp" placeholder="@lang('auth.enter your email')">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="password">@lang('auth.password')</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="@lang('auth.enter your password')">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-check offset-sm-3">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember"><small>@lang('auth.remember me')</small></label>
                    </div>
                    <div class="form-check">
                    <a href=""><small>@lang('auth.forget your password?')</small></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

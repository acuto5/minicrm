@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('New employee') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('employee.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="first_name">{{ __('First name') }}:</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                                       name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @error('first_name')
                                    @include('partials._error_message')
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="last_name">{{ __('Last name') }}:</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                                       name="last_name" value="{{ old('last_name') }}" required>

                                @error('last_name')
                                    @include('partials._error_message')
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="company">{{ __('Company') }}:</label>
                                <select class="form-control @error('company') is-invalid @enderror" id="company" name="company">
                                    <option value="">{{ __('Select company') }}</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company['id'] }}" {{ ($company['id'] == old('company'))? 'selected' : '' }}>{{ $company['name'] }}</option>
                                    @endforeach
                                </select>

                                @error('company')
                                    @include('partials._error_message')
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}:</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}">

                                @error('email')
                                    @include('partials._error_message')
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}:</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                       name="phone" value="{{ old('phone') }}">

                                @error('phone')
                                    @include('partials._error_message')
                                @enderror
                            </div>

                            <div class="form-group">
                                <a href="{{ route('employee.index') }}" class="btn btn-sm btn-info">{{ __('Back') }}</a>
                                <input class="btn btn-sm btn-success" type="submit" value="{{ __('Save') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
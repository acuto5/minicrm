@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('New company') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('company.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}:</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autofocus>

                                @error('name')
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
                                <label for="logo">{{ __('Logo') }}</label>
                                <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror"
                                       name="logo" accept=".jpg, .jpeg">

                                @error('logo')
                                    @include('partials._error_message')
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="website">{{ __('Website') }}:</label>
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror"
                                       name="website" value="{{ old('website') }}">

                                @error('website')
                                    @include('partials._error_message')
                                @enderror
                            </div>

                            <div class="form-group">
                                <a href="{{ route('company.index') }}" class="btn btn-sm btn-info">{{ __('Back') }}</a>
                                <input class="btn btn-sm btn-success" type="submit" value="{{ __('Save') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
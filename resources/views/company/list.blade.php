@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Companies') }}
                    </div>

                    <div class="card-body">
                        <a class="btn btn-sm btn-success mb-3" href="{{ route('company.create') }}">{{ __('Create new company') }}</a>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                {{ __('Companies list') }}
                            </div>
                            <div class="card-body">
                                @if(count($companies) > 0)
                                    <table class="table">
                                        <tr>
                                            <th>{{ __('Logo') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Website') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                        @foreach($companies as $company)
                                            <tr>
                                                <td>
                                                    @if ($company->logo)
                                                        <img src="{{ Storage::url($company->logo) }}" width="75" height="75" class="rounded-circle" alt="logo">
                                                    @endif
                                                </td>
                                                <td>{{ $company->name }}</td>
                                                <td>{{ $company->email }}</td>
                                                <td>{{ $company->website }}</td>
                                                <td>
                                                    <a class='btn btn-sm btn-primary' href="{{ route('company.edit', $company->id) }}">{{ __('Edit') }}</a>
                                                    <form action="{{ route('company.destroy', [$company->id]) }}" method="post" class="d-inline-block">
                                                        @method('delete')
                                                        @csrf
                                                        <input class="btn btn-sm btn-danger" type="submit" value="{{ __('Delete') }}">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @else
                                    {{ __('No companies registered yet!') }}
                                @endif
                            </div>
                        </div>
                        <div class="mt-3">
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

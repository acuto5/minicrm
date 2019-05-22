@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Employees') }}
                    </div>

                    <div class="card-body">
                        <a class="btn btn-sm btn-success mb-3" href="{{ route('employee.create') }}">{{ __('Create new employee') }}</a>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                {{ __('Employees list') }}
                            </div>
                            <div class="card-body">
                                @if(count($employees) > 0)
                                    <table class="table">
                                        <tr>
                                            <th>{{ __('First name') }}</th>
                                            <th>{{ __('Last name') }}</th>
                                            <th>{{ __('Company') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Phone') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                        @foreach($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->first_name }}</td>
                                                <td>{{ $employee->last_name }}</td>
                                                <td>{{ $employee->company->name }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->phone }}</td>
                                                <td>
                                                    <a class='btn btn-sm btn-primary' href="{{ route('employee.edit', $employee->id) }}">{{ __('Edit') }}</a>
                                                    <form action="{{ route('employee.destroy', [$employee->id]) }}" method="post" class="d-inline-block">
                                                        @method('delete')
                                                        @csrf
                                                        <input class="btn btn-sm btn-danger" type="submit" value="{{ __('Delete') }}">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @else
                                    {{ __('No employees registered yet!') }}
                                @endif
                            </div>
                        </div>
                        <div class="mt-3">
                            {{ $employees->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

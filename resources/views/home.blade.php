@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('You are logged in!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <a href="/companylist" class="btn btn-success mb-4">Companies</a>
                    <a href="/employeeslist" class="btn btn-info mb-4">Employees</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
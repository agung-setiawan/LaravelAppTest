@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>{{ __('form.user_list_header') }}</h4>

                    <table class="table" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>UserName</th>
                                <th>Status</th>
                                <th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($i = 1)
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $i }}.</td>
                                    <td>{{ $user['id'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['status'] }}</td>
                                    <td>{{ $user['position'] }}</td>
                                </tr>
                                @php ($i = ($i + 1))
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

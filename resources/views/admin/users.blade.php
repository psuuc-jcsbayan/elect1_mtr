@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>User Management</h1>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            <!-- Add user actions here if needed -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $users->links() }}
    </div>
@endsection

@extends('layouts.app')

@section('title', 'User Management')
@section('content')
    <div class="col-lg-10">
        <div class="row">
            <h1>User Management</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">E-mail Verified At</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_verified_at ? $user->email_verified_at->format('m/d/Y') : 'Not verified' }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <div class="pagination-wrapper">
                    {!! $users->links() !!}
                </div>
                </tbody>
            </table>
        </div>
    </div>
@endsection

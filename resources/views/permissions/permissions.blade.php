
@extends('layouts.app')

@section('title', 'User Management')
@section('content')
    <div class="col-lg-10">
        <div class="row">

            <h2>Permissions Management</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <th scope="row">{{ $permission->id }}</th>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary">Edit
                                Permissions</a>
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <div class="pagination-wrapper">
                    {!! $permissions->links() !!}
                </div>
                </tbody>
            </table>
        </div>
    </div>
@endsection

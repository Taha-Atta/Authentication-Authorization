@extends('back.master')
@section('title','Index')

@section('contnt')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Roles
                        </h4>
                        <a href="{{ url('roles/create') }}" class="btn btn-success float-end">Create New Role</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th width="50%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($roles) > 0)
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a href="{{ route('roles.show', $role->id) }}"
                                                    class="btn btn-success">Show</a>
                                                <a href="{{ url('roles/' . $role->id . '/givePermissionToRole') }}"
                                                    class="btn btn-warning">Add /Edit Permission To Role</a>
                                                <a href="{{ route('roles.edit', $role->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <a href="{{ url('roles/' . $role->id . '/delete') }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else

                                        <td colspan="100%">
                                            <div class="alert alert-danger">no record</div>
                                        </td>

                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('back.master')
@section('title','Index')

@section('contnt')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>admins
                        </h4>
                        {{-- @can('Add User') --}}
                            @role('User')
                        <a href="{{url('back/admins/create')}}" class="btn btn-success float-end">Create New Admin</a>
                        {{-- @endcan --}}

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin )
                                <tr>
                                    <td>{{$admin->id}}</td>
                                    <td>{{$admin->name }}</td>
                                    <td>{{$admin->email }}</td>
                                    <td>
                                        @if (!empty($admin->getRoleNames()))

                                            @foreach ($admin->getRoleNames() as $roleName )
                                            <label class="badge bg-warning mx-1">{{$roleName}}</label>
                                            @endforeach

                                        @endif
                                    </td>
                                    <td>
                                        @can('Edit User')

                                        <a href="{{route('back.admins.edit', $admin->id)}}" class="btn btn-primary">Edit</a>
                                        @endcan

                                        {{-- @can('delete roles') --}}
                                        @role('SuperAdmin')
                                        <a href="{{url('back/admins/'.$admin->id.'/delete')}}" class="btn btn-danger">Delete</a>
                                        {{-- @endcan --}}
                                        @endrole
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
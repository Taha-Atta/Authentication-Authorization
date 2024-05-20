@extends('back.master')
@section('title','Edit')

@section('contnt')
@include('errors')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4> Edit User
                            <a href="{{route('back.users.index')}}" class="btn btn-primary float-end ml-3">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('back.users.update',$user->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for=""> Name</label>
                                <input type="text" name="name" value="{{$user->name}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for=""> Email</label>
                                <input type="email" name="email"  value="{{$user->email}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for=""> Password</label>
                                <input type="password" name="password"  class="form-control">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="">Roles</label>
                                <select name="roles[]" multiple class="form-control" >
                                    <option value="">Role Select :</option> <br>
                                    @foreach ($roles as $role )
                                    <option value="{{$role}}"
                                    {{in_array($role,$userRoles) ? 'selected': ''}}
                                    >{{$role}}</option>
                                    @endforeach
                                </select>
                            </div> --}}


                      <div class="mb-3">

                            <label for="">Roles</label>
                            <select name="roles[]" multiple class="form-control" >
                                <option value="">Role Select :</option> <br>
                                @foreach ($roles as $role )
                                <option value="{{$role->name}}"selected >{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
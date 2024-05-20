@extends('back.master')
@section('title','Create Role')

@section('contnt')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card mt-3">
                    <div class="card-header">
                        <h4> Create Role
                            <a href="{{ route('roles.index') }}" class="btn btn-primary float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('roles') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="">Role Name</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="">guard Name</label>
                                <select name="guard_name" id=""  class="form-control">
                                    <option value="web">Web</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')
<title>Edit - User</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Edit Data User</h6>
                </div>
                <div class="col-lg-6 col-5 text-right text-white">
                    <strong><span id="tanggal"></span> ; <span id="watch"></span></strong>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h5 class="mt-1">Data Karyawan</h5>
                </div>
                <div class="card-body">
                    <form action="/user/{{$getUser->user_id}}/update" method="POST" enctype="multipart/form-data" class="ml-2 mr-2" style="margin: auto;">
                        @method('patch')
                        @csrf
                        <div class="form-group row">
                            <label for="staticName" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="username" value="{{old('username') ?? $getUser->username}}">
                                @error('username')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticUsername" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name') ?? $getUser->name}}">
                                @error('nik')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticRole" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="role" id="validationTooltip04" required>
                                    <option value="1" {{ $getUser->role == "1" ? 'selected' : ''}}>Admin</option>
                                    <option value="2" {{ $getUser->role == "2" ? 'selected' : ''}}>User</option>
                                </select>
                                @error('role')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticPassword" class="col-sm-2 col-form-label mt-4">Edit Password</label>
                            <div class="col-sm-10">
                                <small class="ml-1 text-muted">*jika tidak ingin merubah password, tidak perlu diisi</small>
                                <input type="password" class="form-control mt-1" id="password" name="password" placeholder="Password Baru">
                                <input type="password" class="form-control mt-3" id="password_confirmation" placeholder="Masukkan Ulang Password" name="password_confirmation">
                                @error('password')
                                <div class="mt-1">
                                    <small class="ml-1" style="color: red;">{{$message}}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg text-right p-0">
                            <a href="/master/user" type="button" class="btn btn-secondary">Batal</a>
                            <input type="submit" class="btn btn-primary" value="Edit"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
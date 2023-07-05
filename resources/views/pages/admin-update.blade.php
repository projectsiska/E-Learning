@extends('layouts.main') @section('content')
<div class="card card-compact w-full">
    <form action="{{ route('admin.update', $admin->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="card-title">
                <span>Profile Admin</span>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input
                    name="name"
                    type="text"
                    placeholder="Nama"
                    value="{{$admin->name}}"
                    class="input input-bordered w-full"
                />
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Tanggal Lahir</span>
                </label>
                <input
                    name="tgl_lahir"
                    type="date"
                    placeholder="Tanggal Lahir"
                    value="{{$admin->profile->tgl_lahir}}"
                    class="input input-bordered w-full"
                />
            </div>


            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Alamat</span>
                </label>
                <textarea
                    name="alamat" 
                    placeholder="Alamat Admin" 
                    class="input input-bordered w-full"
                />{{$admin->profile->alamat}}</textarea>
            </div>


            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input
                    name="email"
                    type="email"
                    placeholder="Email"
                    class="input input-bordered w-full"
                    value="{{$admin->email}}"
                />
            </div>


            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Telepon</span>
                </label>
                <input
                    name="telp"
                    type="text"
                    placeholder="Telepon"
                    class="input input-bordered w-full"
                    value="{{$admin->profile->telp}}"
                />
            </div>
 
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Username</span>
                </label>
                <input
                    name="username"
                    type="text"
                    placeholder="Username"
                    class="input input-bordered w-full"
                    value="{{$admin->username}}"
                />
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Password Baru</span>
                </label>
                <input
                    name="password"
                    type="password"
                    placeholder="Password"
                    class="input input-bordered w-full"
                />
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Ulangi Password</span>
                </label>
                <input
                    name="password_confirmation"
                    type="password"
                    placeholder="Type here"
                    class="input input-bordered w-full"
                />
            </div>
            <div class="my-4 card-actions justify-end">
                <button type="submit" class="btn btn-primary text-base-100">
                    Simpan
                </button>
                <a href="{{ route('admin.index') }}" class="btn btn-ghost"
                    >Batal</a
                >
            </div>
        </div>
    </form>
</div>


@endsection 


@section('script') 

@endsection

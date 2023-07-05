@extends('layouts.main') @section('content')
<div class="card card-compact w-full">
    <form action="{{ route('guru.update', $guru->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="card-title">
                <span>Profile Guru</span>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input name="name" type="text" placeholder="Nama" value="{{$guru->name}}"
                    class="input input-bordered w-full" />
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Tanggal Lahir</span>
                </label>
                <input name="tgl_lahir" type="date" placeholder="Tanggal Lahir" value="{{$guru->profile->tgl_lahir}}"
                    class="input input-bordered w-full" />
            </div>


            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Alamat</span>
                </label>
                <textarea name="alamat" placeholder="Alamat guru"
                    class="input input-bordered w-full" />{{$guru->profile->alamat}}</textarea>
            </div>


            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input name="email" type="email" placeholder="Email" class="input input-bordered w-full"
                    value="{{$guru->email}}" />
            </div>


            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Telepon</span>
                </label>
                <input name="telp" type="text" placeholder="Telepon" class="input input-bordered w-full"
                    value="{{$guru->profile->telp}}" />
            </div>


            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Foto</span>
                </label>
                <input type="hidden" name="oldImage" value="{{ $guru->profile->foto }}">
                @if($guru->profile->foto)
                <img src="{{ asset('storage/' . $guru->profile->foto) }}" style="height:200px"
                    class="img-preview img-fluid">

                @else
                <img class="img-preview img-fluid">
                @endif
                <img class="img-preview img-fluid">
                <input type="file" value="{{ old('foto')}}" name="foto" class="file-input file-input-bordered w-full max-w-xs" id="foto"
                    placeholder="Foto Bank" onchange="previewImage()">

                @error('foto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Username</span>
                </label>
                <input name="username" type="text" placeholder="Username" class="input input-bordered w-full"
                    value="{{$guru->username}}" />
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Password Baru</span>
                </label>
                <input name="password" type="password" placeholder="Password" class="input input-bordered w-full" />
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Ulangi Password</span>
                </label>
                <input name="password_confirmation" type="password" placeholder="Type here"
                    class="input input-bordered w-full" />
            </div>
            <div class="my-4 card-actions justify-end">
                <button type="submit" class="btn btn-primary text-base-100">
                    Simpan
                </button>
                <a href="{{ route('guru.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection @section('script') @endsection
@extends('layouts.main') @section('content')
<div class="card card-compact w-full">
    <form action="{{ route('kelas.update', $kelas->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="card-title">
                <span>Profile Kelas</span>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input name="nama" type="text" placeholder="Nama" value="{{$kelas->nama}}"
                    class="input input-bordered w-full" />
            </div>


            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Kode Kelas</span>
                </label>
                <input name="kode" readonly type="text" placeholder="Nama" value="{{$kelas->kode}}"
                    class="input input-bordered w-full" />
            </div>
 


            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Guru</span>
                </label>

                @if (auth()->user()->profile->role == 'Admin')

                <select class="select select-bordered w-full" name="profile_id">
                    <option value="{{$kelas->profile_id}}" selected>--{{$kelas->guru->user->name}}--</option>
                    @foreach( $guru as $gurus)
                    <option value="{{ $gurus->id }}">{{ $gurus->user->name }}</option> 
                    @endforeach
                  </select>

                
                @else
                <input name="profile_id" hidden value="{{$kelas->profile_id}}" />

                    <input type="text" readonly placeholder="Id" class="input input-bordered w-full"
                    value="{{$kelas->guru->user->name}}" />

                @endif
            </div>

 
            <div class="my-4 card-actions justify-end">
                <button type="submit" class="btn btn-primary text-base-100">
                    Simpan
                </button>
                <a href="{{ route('kelas.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection @section('script') @endsection
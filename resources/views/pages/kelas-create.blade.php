@extends('layouts.main') @section('content')
<div class="card card-compact w-full">
    <form action="{{ route('kelas.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="card-title">
                <span>Buat Kelas Baru</span>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input
                    name="nama"
                    type="text"
                    placeholder="Nama Kelas"
                    class="input input-bordered w-full"
                />
            </div>

            
            @if (auth()->user()->profile->role == 'Admin')
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Nama</span>
                </label>
            <select class="select select-bordered w-full" name="profile_id">
                <option selected>--  Pilih Guru --</option>
                @foreach( $guru as $gurus)
                <option value="{{ $gurus->id }}">{{ $gurus->user->name }}</option> 
                @endforeach
              </select>
            </div>
            
            @else
            <input name="profile_id" hidden value="{{auth()->user()->profile->id}}" />
 
            @endif
            

            <div class="my-4 card-actions justify-end">
                <button type="submit" class="btn btn-primary text-base-100">
                    Simpan
                </button>
                <a href="{{ route('kelas.index') }}" class="btn btn-ghost"
                    >Batal</a
                >
            </div>
        </div>
    </form>
</div>
@endsection @section('script') @endsection

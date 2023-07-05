@extends('layouts.main') @section('content')
<div class="card card-compact w-full">
    <div class="card-body">
        <div class="card-title justify-between items-center">
            <div>
                <span>Siswa</span>
                <a
                    href="{{ route('siswa.create') }}"
                    class="btn btn-primary btn-sm normal-case text-base-100"
                    >Tambah</a
                >
            </div>
            <div class="ml-auto join">
                <div>
                    <input
                        class="input input-bordered join-item"
                        placeholder="Search..."
                    />
                </div>
                <button class="btn join-item">Search</button>
            </div>
        </div>
    </div>
</div>

<div class="overflow-x-auto">
    <table class="table">
        <!-- head -->
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Tgl. Bergabung</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $siswa)
            <tr>
                <th>
                    {{$loop->iteration}}
                </th>
                <td>
                    <div class="flex items-center space-x-3">
                        <div class="avatar placeholder">
                            <div
                                class="bg-neutral-focus text-neutral-content rounded-full w-12"
                            >

                                @if( $siswa->foto)
                                <img style="background: url('{{ asset('storage/' . $siswa->foto) }}'); background-size:cover"> 
                                @else
                                <span>{{substr($siswa->user->name, 0, 1)}}</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">{{$siswa->user->name}}</div>
                            <div class="text-sm opacity-50">
                                {{$siswa->user->email}}
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    {{$siswa->alamat}}
                    <br />
                    <span class="badge badge-ghost badge-sm"
                        >Telp. {{$siswa->telp}}</span
                    >
                </td>
                <td>
                    {{date('d/m/Y', strtotime($siswa->created_at))}}
                </td>
                <th style="display: flex">
                    <a
                        href="{{ route('siswa.edit', $siswa->user_id) }}"
                        class="btn btn-ghost btn-xs"
                        >details</a
                    >

                    <form action="{{ route('siswa.destroy',$siswa->user_id) }}" method="post">
                       
                        @method('delete')
                        @csrf

                        <button onclick="return confirm('Are You Sure')" role="button"
                            class="btn btn-ghost btn-xs">Deleted</button>

                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection @section('script') @endsection

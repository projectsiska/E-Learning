@extends('layouts.main') @section('content')
<div class="card card-compact w-full">
    <div class="card-body">
        <div class="card-title justify-between items-center">
            <div>
                <span>Kelas</span>
                @if(auth()->user()->profile->role != 'Siswa')
                <a
                    href="{{ route('kelas.create') }}"
                    class="btn btn-primary btn-sm normal-case text-base-100"
                    >Tambah</a
                >
                @elseif(auth()->user()->profile->role == 'Siswa')
                <button
                    class="btn btn-sm btn-primary text-base-100"
                    onclick="modal_join_kelas.showModal()"
                >
                    Join Kelas
                </button>
                <dialog id="modal_join_kelas" class="modal">
                    <form
                        action="{{ route('kelas.join') }}"
                        method="post"
                        class="modal-box"
                    >
                        @csrf
                        <h3 class="font-bold text-lg mb-2">Input Kode Kelas</h3>
                        <input
                            name="kode"
                            type="text"
                            placeholder="Kode Kelas"
                            class="input input-bordered w-full"
                        />
                        <div class="modal-action">
                            <!-- if there is a button in form, it will close the modal -->
                            <button
                                type="submit"
                                class="btn btn-primary text-base-100"
                            >
                                Join
                            </button>
                            <label class="btn">Batal</label>
                        </div>
                    </form>
                </dialog>
                @endif
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
@include('layouts.allert')
<div class="overflow-x-auto">
    <table class="table">
        <!-- head -->
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Kelas</th>
                <th>Kode Kelas</th>
                @if(auth()->user()->profile->role != 'Siswa')
                <th>Jumlah Siswa</th>
                <th>Tgl. Dibuat</th>
                @elseif(auth()->user()->profile->role == 'Siswa')
                <th>Nama Guru</th>
                <th>Tgl. Bergabung</th>
                @endif
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelas as $row) 
            
            @if(auth()->user()->profile->role !='Siswa')
            <tr>
                <th>
                    {{$loop->iteration}}
                </th>
                <td>{{$row->nama}}</td>
                <td>
                    <span
                        class="badge font-bold normal-case"
                        >{{$row->kode}}</span
                    >
                </td>
                <td>{{count($row->siswa)}}</td>
                <td>{{date('d/m/Y', strtotime($row->created_at))}}</td>
                <td style="display: flex">
                    <a
                        href="{{ route('kelas.edit', $row->id) }}"
                        class="btn btn-ghost btn-xs"
                        >Lihat</a
                    >
                    <form action="{{ route('kelas.destroy',$row->id) }}" method="post">
                       
                        @method('delete')
                        @csrf

                        <button onclick="return confirm('Are You Sure')" role="button"
                            class="btn btn-ghost btn-xs">Deleted</button>

                    </form>
                </td>
            </tr>
            @elseif(auth()->user()->profile->role == 'Siswa')
            <tr>
                <th>
                    {{$loop->iteration}}
                </th>
                <td>{{$row->kelas->nama}}</td>
                <td>
                    <span
                        class="badge font-bold normal-case"
                        >{{$row->kelas->kode}}</span
                    >
                </td>
                <td>{{$row->kelas->guru->user->name}}</td>
                <td>{{date('d/m/Y', strtotime($row->created_at))}}</td>
                <td>
                    <a
                        href="{{ route('kelas.edit', $row->id) }}"
                        class="btn btn-ghost btn-xs"
                        >Lihat</a
                    >

                    
                </td>
            </tr>
            @endif @endforeach
        </tbody>
    </table>
</div>
@endsection @section('script') @endsection

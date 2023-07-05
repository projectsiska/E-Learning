@extends('layouts.main') @section('content')
<div class="card card-compact w-full">
    <form action="{{ route('profil.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')


        <div class="min-h-screen bg-base-100">
            <div class="">

              
              <div class="card  shadow-2xl bg-base-100">
                <div class="card-body">
                    <div class="avatar">
                        <div class="w-44 rounded-xl">
                            <input type="hidden" name="oldImage" value="{{ $user->profile->foto }}">
                            @if($user->profile->foto)
                            <img src="{{ asset('storage/' . $user->profile->foto) }}" style="height:200px"
                                class="img-preview img-fluid">
            
                            @else
                            <img class="img-preview img-fluid">
                            @endif
                                          
                        </div>
 
                       
                      </div>
                      
                      <input type="file" value="{{ old('foto')}}" name="foto" class="file-input file-input-bordered w-full max-w-xs" id="foto"
                      placeholder="Foto Bank" onchange="previewImage()">
  
                  @error('foto')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror         

                </div>
                <div class="card-body">
                  <div class="form-control">
                    <label class="label">
                      <span class="label-text">Name</span>
                    </label>
                    <input type="text" name="name" placeholder="name" value="{{$user->name}}" class="input input-bordered" />
                  </div>
                 
                  <div class="form-control">
                    <label class="label">
                      <span class="label-text">Tanggal Lahir</span>
                    </label>
                    <input type="date" name="tgl_lahir" value="{{$user->profile->tgl_lahir}}" placeholder="Tanggal Lahir" class="input input-bordered" />
                  </div>

                  <div class="form-control">
                    <label class="label">
                      <span class="label-text">Alamat</span>
                    </label>
                    <textarea type="text" name="alamat" placeholder="Alamat" class="input input-bordered" />{{$user->profile->alamat}}</textarea>
                  </div>

                  <div class="form-control">
                    <label class="label">
                      <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" value="{{$user->email}}" placeholder="email" class="input input-bordered" />
                  </div>

                  <div class="form-control">
                    <label class="label">
                      <span class="label-text">Telepon</span>
                    </label>
                    <input type="text" name="telp" value="{{$user->profile->telp}}" placeholder="Telepon" class="input input-bordered" />
                  </div>

                  <div class="form-control">
                    <label class="label">
                      <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="username" value="{{$user->username}}" placeholder="username" class="input input-bordered" />
                  </div>
                  <br>
                  <div class="form-control">
                    <label class="label">
                      <span class="label-text">Ubah Password</span>
                    </label>
                    <input type="password" placeholder="password" name="password" class="input input-bordered" />
                    <label><i style="color:red">Kosongkan Apabila Tidak Ingin Mengubah Password</i></label>
                     <br>
                  </div>

                  <div class="form-control">
                    <label class="label">
                        <span class="label-text">Ulangi Password</span>
                    </label>
                    <input name="password_confirmation" type="password" placeholder="Type here"
                        class="input input-bordered" />
                </div>

                  <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </form>

{{-- 
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
        </div> --}}
    </form>
</div>


@endsection 


@section('script') 

@endsection

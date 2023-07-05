<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.guru', [
            'title' => 'Guru',
            'gurus' => Profile::where('role', 'Guru')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.guru-create', [
            'title' => 'Buat Guru Baru',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {
            $data['password'] = bcrypt($data['password']);
            $id = User::create($data)->id;
            Profile::create([
                'user_id' => $id,
                'role' => 'Guru',
            ]);
            return redirect(route('guru.index'))->with('success','Guru Has Been Add!');;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id, User $user)
    {
        $user = User::with('profile')->find($id);
        return view('pages.guru-update', [
            'title' => 'Profil Guru',
            'guru' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, User $user)
    {
         
        $rules = [ 
            'name' => 'required',     
            
        ];
        
        $validatedDataUser= $request->validate($rules); 
 
        
        $validatedData['tgl_lahir']=$request->tgl_lahir;
        $validatedData['alamat']=$request->alamat;
        $validatedData['telp']=$request->telp;
        
        if(!empty($request->password))
        {
            $rules['password'] =  'required|confirmed';
            $validatedDataUser['password']= Hash::make($request->password);
            
        } 
        
        if($request->email != $user->email)
        {
            $rules['email'] = 'required|unique:users';
        }
        
        if($request->username != $user->username)
        {
            $rules['username'] = 'required|unique:users';  
            $validatedDataUser['username']= $request->username;
        }

        if($request->file('foto')){
            $validatedData['foto']=$request->file('foto')->store('profil');
        } 
         
        user::where('id',$id)
        ->update($validatedDataUser); 

         profile::where('user_id',$id)
         ->update($validatedData);


         return redirect('/guru')->with('updated','Guru Has Been Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, User $user)
    {
        if( $foto = Profile::where('user_id', $id)->value('foto')){
            Storage::delete($foto);
        } 
        profile::destroy('user_id',$id);
         user::destroy($id);
        return redirect('/guru')->with('deleted','Guru Has Been Deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Storage;


class PageController extends Controller
{
    public function dashboard()
    {
        $user = User::with('profile')->find(auth()->user()->id);
        return view('pages.dashboard', [
            'title' => 'Dashboard | ' . $user->profile->role,
            'user' => $user,
        ]);
    }
    public function materi()
    {
        $user = User::with('profile')->find(auth()->user()->id);
        return view('pages.materi', [
            'title' => 'Materi',
            'user' => $user,
        ]);
    }
    public function tugas()
    {
        $user = User::with('profile')->find(auth()->user()->id);
        return view('pages.tugas', [
            'title' => 'Tugas',
            'user' => $user,
        ]);
    }
    public function kuis()
    {
        $user = User::with('profile')->find(auth()->user()->id);
        return view('pages.kuis', [
            'title' => 'Kuis',
            'user' => $user,
        ]);
    }


    public function profil()
    {
        $user = User::with('profile')->find(auth()->user()->id);
        return view('pages.profil', [
            'title' => 'Profil',
            'user' => $user,
        ]);
    }


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


         return redirect('/dashboard')->with('updated','Your Profile Has Been Update!');
    }
}

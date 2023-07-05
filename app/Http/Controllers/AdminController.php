<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('profile');
        return view('pages.admin', [
            'title' => 'Admin',
            'user' => $user->find(auth()->user()->id),
            'admins' => Profile::where('role', 'Admin')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::with('profile');
        return view('pages.admin-create', [
            'title' => 'Buat Admin Baru',
            'user' => $user->find(auth()->user()->id),
            'admins' => Profile::where('role', 'Admin')->get(),
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
                'role' => 'Admin',
            ]);
            return redirect(route('admin.index'))->with('success','Admin Has Been Add!');;
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
        return view('pages.admin-update', [
            'title' => 'Profil Admin',
            'admin' => $user,
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
         
        user::where('id',$id)
        ->update($validatedDataUser); 

         profile::where('user_id',$id)
         ->update($validatedData);


         return redirect('/admin')->with('updated','Admin Has Been Update!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        if($admin->foto){
            Storage::delete($admin->foto);
        }
         user::destroy($admin->id);
         profile::destroy($admin->id);
        return redirect('/admin')->with('deleted','Admin Has Been Deleted!');
    }
}

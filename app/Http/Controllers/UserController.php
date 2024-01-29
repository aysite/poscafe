<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public $page ="User";
    public function index()
    {
    $data = [
        "title" => $this->page,
        "page_title" => $this->page,
        "dtUser" => User::all(),
        "edit" => false
    ];
    
    return view('user.data', $data);
    }


    public function create()
    {
        //
    }

    public function store(StoreUserRequest $request)
    {
        // Upload Foto
        if($request->file("file_foto")){
            $fileName = Str::random(6).time().'.'.$request->file("file_foto")->extension();
            
            // Proses Upload
            $result = $request->file("file_foto")->move(public_path('uploads/user'), $fileName);
        } else {
            $fileName = null;
        }

        try {
            User::create([
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "password" => Hash::make($request->input('password')),
            "role" => $request->input('role'),
            "foto" => $request->input('foto'),
            "status" => $request->input('status'),
        ]);
            
            $notif = [
                "type" => "success",
                "message" => "Data Berhasil di Simpan !"
            ];

        } catch (Exception $err){
            
            $notif = [
                "type" => "error",
                "message" => "Data Gagal di Simpan !"
            ];
    }
        return redirect()->back()->with('notif',$notif);
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $data = [
            "title" => $this->page,
            "page_title" => $this->page,
            "dtUser" => User::all(),
            "rsUser" => User::where('id',$user->id)->first(),
            "edit" => true
        ];
        return view('user.data',$data);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        // Upload Foto
        if($request->file("file_foto")){
            $fileName = Str::random(6).time().'.'.$request->file("file_foto")->extension(); 

            // Proses Upload
            $result = $request->file("file_foto")->move(public_path('uploads/user'), $fileName);
        } else {
            $fileName = $request->input('old_foto');
        }

        try {
            User::find($user->id)->update([
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "password" => $request->input('password') ? Hash::make($request->input('password')) : $request->input('old_password'),
                "role" => $request->input('role'),
                "foto" => $fileName,
                "status" => $request->input('status'),
            ]);

            $notif = [
                "type" =>
                "success",
                "message" => "Data Berhasil di Update !"
            ];

        } catch(Exception $err){

            $notif = [ 
                "type" => "error",
                "message" => "Data Gagal di Update !"
            ];
            
        }
        return redirect(route('user.index'))->with('notif',$notif);
    }

    public function destroy(User $user)
    {
        try {
            User::find($user->id)->delete();

                $notif = [
                "type" => "success",
                "message" => "Data Berhasil di Hapus !"
                ];
                
            } catch (Exception $err){

                $notif = [
                "type" => "error",
                "message" => "Data Gagal di Hapus !"
                ];
    }
        return redirect()->back()->with('notif',$notif);
    }
}
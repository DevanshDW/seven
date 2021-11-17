<?php

namespace App\Http\Controllers;

use Illuminate\Support\facades\DB;
use Illuminate\Http\Request; 
use App\Models\User;
use Storage;


class UserController extends Controller
{

    public function uploadAvatar(Request $request)
    {
        if ($request->hasFile('image')) {
           User::uploadAvatar ($request->image);
           return redirect()->back()->with('message',  'Image Uploaded'); 
        }
        return redirect()->back()->with('error',  'Image could not Uploaded'); 
    }

    public function index()
    {
        // DB::insert('insert into users (name, email, password)
        // values (?,?,?)', [
        //     'Devansh2', 'Devansh2@dp.com', 'password2',
        // ]);
        
        // DB::update('update users set name = ? where id = 4', ['swagshadow']);

        // DB::delete('delete from users where id = 4');

        // $user = DB::select('select * from users');
        // return $user;
        
        // $user = new User();        
        // $user->name = 'swag_shadow2';
        // $user->email = 'swag_shadow2@gmail.com';
        // $user->password = bcrypt('password2');
        // $user->save();

    

        // User::where('id',6)->delete();
        // User::where('id',5)->update(['name' => 'Devanshhhhhhh']);

        $data = [
            'name'     => 'Elon2',
            'email'    => 'elon2@devansh.com',
            'password' => bcrypt('password2'),
        ];

        // User::create($data);
        $user = User::all();
        return $user;

        return view('home');
    }
}

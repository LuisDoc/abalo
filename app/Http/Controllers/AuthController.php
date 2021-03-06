<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ab_user;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Rules\DomainRules;
use App\Models\User;
use Hash;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    public function username(){
        return 'ab_mail';
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->passwort;

        //Suche nach einem Nutzer mit dieser Email
        $User = User::where('ab_mail','like',$email)->get()->first();
        if(!$User){
            return view('tailwind.auth.login')->withErrors(['email' => 'Es wurde kein Konto unter dieser Email gefunden']);
        }


        //Passwörter identisch ? 
        if(!Hash::check($password,$User->ab_password)){
            return view('tailwind.auth.login')->withErrors(['password' => 'Passwort inkorrekt']);
        }
        
        //Nutzer anmelden
        $userdata = array(
            'ab_mail'=>$request->email,
            'password'=>$request->passwort
        );
        
        if(!Auth::attempt($userdata)){
            return redirect('/showRegister')->withErrors(['error' => 'Anmeldung fehlgeschlagen']);;
        }

        return redirect('/home');
    }

    public function register(Request $request){
        /*
            Eingabevalidierung
        */

        $User = User::query()->where('ab_mail','like',$request->email)->get()->first();
        
        //Überprüfung der E-Mail
        if($User){
            return view('tailwind.auth.register')->withErrors(['email' => 'Diese E-Mail existiert bereits']);
        }
        //Validierung ob Passwörter identisch
        if($request->password != $request->password_confirmation){
            return view('tailwind.auth.register')->withErrors(['password_confirmation' => 'Die Passwörter sind nicht identisch']);
        }
        //Anlegen des neuen Nutzers
        User::create([
            'ab_mail' => $request->email,
            'ab_name'=>$request->name,
            'ab_password'=>Hash::make($request->password)
            
        ]);

        return redirect('/showLogin');
    }

    public function api_register(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string|unique:pgsql.ab_user,ab_mail',
            'password'=>[
                'required',
                'confirmed'
            ]
        ]);
        //Anlegen des neuen Nutzers
        $user = User::create([
            'ab_mail' => $request->email,
            'ab_name'=>$request->name,
            'ab_password'=>Hash::make($request->password)
            
        ]);
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user'=>$user,
            'token'=>$token
        ]);

    }

    public function api_login(Request $request){
        
        $request->validate([
            'email'=> 'required|email|string|exists:pgsql.ab_user,ab_mail',
            'password'=>[
                'required'
            ],
        ]);
        //Nutzer anmelden
        $userdata = array(
            'ab_mail'=>$request->email,
            'password'=>$request->password
        );
        
        if(!Auth::attempt($userdata)){
            return response([
                'error'=>'The Provided credentials are not correct'
            ], 422);
            
        };
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;
        return response([
            'user'=>$user,
            'token' => $token
        ]);
    }

    public function signOut(){
        session()->flush();
        Auth::logout();
        
        return redirect('/home');
    }


    public function api_logout(){
        $user = Auth::user();

        $user->currentAccessToken()->delete();
        return response([
            'success'=>true
        ]);
    }


}
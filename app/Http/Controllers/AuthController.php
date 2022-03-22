<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ab_user;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Rules\DomainRules;
use Hash;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function login(Request $request){
        $email = $request->email;
        $password = $request->passwort;

        //Suche nach einem Nutzer mit dieser Email
        $User = ab_user::where('ab_mail','like',$email)->get()->first();
        if(!$User){
            return view('auth.login')->withErrors(['email' => 'Es wurde kein Konto unter dieser Email gefunden']);
        }


        //Passwörter identisch ? 
        if(!Hash::check($password,$User->ab_password)){
            return view('auth.login')->withErrors(['password' => 'Passwort inkorrekt']);
        }
        
        //Nutzer anmelden
        

        return view('index');
    }

    public function register(Request $request){
        /*
            Eingabevalidierung
        */

        $User = ab_user::query()->where('ab_mail','like',$request->email)->get()->first();
        
        //Überprüfung der E-Mail
        if($User){
            return view('auth.register')->withErrors(['email' => 'Diese E-Mail existiert bereits']);
        }
        //Validierung ob Passwörter identisch
        if($request->password != $request->password_confirmation){
            return view('auth.register')->withErrors(['password_confirmation' => 'Die Passwörter sind nicht identisch']);
        }
        //Anlegen des neuen Nutzers
        $user = new ab_user();
        $user->ab_name = $request->name;
        $user->ab_password = Hash::make($request->password);
        $user->ab_mail = $request->email;
        $user->save();

        return redirect('/');
    }

    public function signOut(){

        dd($request);
        return view('index');
    }


}
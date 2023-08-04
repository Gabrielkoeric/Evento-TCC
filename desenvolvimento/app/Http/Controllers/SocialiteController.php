<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function hendProviderCallback()
    {
        $user = Socialite::driver('google')->user();


        $existingUser = User::where('email', $user->getEmail())->first();

        if (!$existingUser) {
           /* echo "<h1>Seja bem vindo {$user->getName()}</h1>";
            echo "<img src='{$user->getAvatar()}' style='max-width: 200px; border-radius: 50%;'>";
            echo "<h1> {$user->getEmail()}</h1>";
            echo "<h1> {$user->getId()}</h1>";
            echo "<h1> {$user->getNickname()}</h1>";*/
        //}else {
            $usuario = new User();
            $usuario->nome_completo = $user->name;
            $usuario->email = $user->email;
            $usuario->celular = 123;
            $usuario->save();
            //$existingUser = true;
            $existingUser = User::where('email', $user->getEmail())->first();

          /*  echo "<h1>Seja bem vindo {$user->getName()}</h1>";
            echo "<img src='{$user->getAvatar()}' style='max-width: 200px; border-radius: 50%;'>";
            echo "<h1> {$user->getEmail()}</h1>";
            echo "<h1> {$user->getId()}</h1>";
            echo "<h1> {$user->getNickname()}</h1>";*/
            //var_dump($user);

        }

        Auth::login($existingUser);
        session([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail()
        ]);
        //dd(Auth::user());

        return to_route('home.index');
    }

    public function destroy(){
        Auth::logout();
        //dd(Auth::user());
        return to_route('home.index');
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class HomeController extends Controller
{
    public function index()
    {
        $sqls = DB::table('home')
            ->where('permite_home', 1)
            ->get();

        return view('home.index')->with('sqls', $sqls);
    }
}

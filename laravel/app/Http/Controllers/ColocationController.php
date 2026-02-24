<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;


class ColocationController extends Controller
{
    public function index(){
        $colocations = Colocation::all();
        return view('index', compact('colocations'));
    }
}

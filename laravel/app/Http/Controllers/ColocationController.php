<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Colocation;


class ColocationController extends Controller
{
    public function index(){
        $user = Auth::user();
        $colocations = Auth::user()->activeColocations()->get();
        return view('index', compact('colocations'));
    }
    public function create(){
        return view('colocation.create');
    }
    public function store(Request $request){
        $colocation = Colocation::create([
            'name' => $request->name,
            'owner_id' => Auth::id()
        ]);
        $colocation->members()->attach(Auth::id(), [
            'role' => 'owner',
        ]);
        return redirect('/');
    }
    public function show($id){
        $colocation = Colocation::with('activeMembers', 'categories.exponses.payer')->find($id);
        $isOwner = $colocation->isOwner(Auth::user());
        return view('colocation.show', compact('colocation', 'isOwner'));
    }
    public function invite(Colocation $colocation){
        $colocation = Colocation::with('activeMembers', 'categories.exponses.payer')->find($colocation->id);
        return view('invite', compact('colocation'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Colocation;


class ColocationController extends Controller
{
    public function index(){
        $user = Auth::user();
        $colocations = $user->activeColocations()->get();
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

        $members = $colocation->activeMembers;
        $memberCount = count($members);
        $debts = [];

        foreach($colocation->categories as $category){
            foreach($category->exponses as $exponse){
                $share = $exponse->amount / $memberCount;
                foreach($members as $member){
                    if($member->id === $exponse->payer_id) continue;
                    $debts [] = [
                        "from_id" => $member->id,
                        "from" => $member->name,
                        "to_id" => $exponse->payer_id,
                        "to" => $members->find($exponse->payer_id)->name,
                        "amount" => round($share, 2),
                    ];
                }
            }
        }
        return view('colocation.show', compact('colocation', 'isOwner', 'debts'));
    }
    public function invite(Colocation $colocation){
        $colocation = Colocation::with('activeMembers', 'categories.exponses.payer')->find($colocation->id);
        return view('invite', compact('colocation'));
    }
}

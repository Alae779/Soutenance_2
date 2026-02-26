<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreColocationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Colocation;
use App\Models\User;

class ColocationController extends Controller
{
    public function index(){
        $user = User::find(Auth::id());
        $colocations = $user->currentColocations()->get();
        $hasActiveColocation = $user->colocations()->where('status', 'active')->exists();
        return view('index', compact('colocations', 'hasActiveColocation'));
    }
    public function create(){
        return view('colocation.create');
    }
    public function store(StoreColocationRequest $request){
        $colocation = Colocation::create([
            'name' => $request->name,
            'owner_id' => Auth::id()
        ]);
        $colocation->members()->attach(Auth::id(), [
            'role' => 'owner',
        ]);
        return redirect('/');
    }
    public function cancel($id){
        $colocation = Colocation::find($id);
        $colocation->status = "cancelled";
        $colocation->save();
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
                        "exponse_id" => $exponse->id,
                        "from_id" => $member->id,
                        "from" => $member->name,
                        "to_id" => $exponse->payer_id,
                        "to" => $members->find($exponse->payer_id)->name,
                        "amount" => round($share, 2),
                    ];
                }
            }
        }
        foreach($colocation->settlements as $set){
            foreach($debts as $key => $debt){
                if($debt['from_id'] === $set->from_user_id && $debt['exponse_id'] === $set->exponse_id
                && $debt['to_id']){
                    unset($debts[$key]);
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

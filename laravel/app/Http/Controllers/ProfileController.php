<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function show(){
        return view('profile');
    }
    public function leave(Colocation $colocation){
        $user = Auth::user();
        $colocation->load('activeMembers', 'categories.exponses', 'settlements');
        if($this->userHasDebt($colocation, $user->id)){
            $user->decrement('reputation');
        }else{
            $user->increment('reputation');
        }
        $colocation->members()->updateExistingPivot($user->id, [
            'left_at' => now(),
        ]);
        return redirect ('/');
    }
    public function userHasDebt(Colocation $colocation, $userID){
        $members = $colocation->activeMembers;
        $memberCount = count($members);
        foreach($colocation->categories as $category){
            foreach($category->exponses as $exponse){
                foreach($members as $member){
                    if($member->id === $userID && $member->id !== $exponse->payer_id){
                        $paid = $colocation->settlements->where('from_user_id', $userID)->where('exponse_id', $exponse->id)
                        ->isNotEmpty();
                        if(!$paid) return true;
                    }
                }
            }
        }
        return false;
    }
}

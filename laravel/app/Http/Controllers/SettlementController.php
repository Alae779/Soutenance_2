<?php

namespace App\Http\Controllers;

use App\Models\Settlement;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function pay(Request $request, $id){
        $settlement = Settlement::create([
            "colocation_id" => $id,
            "from_user_id" => $request->from_id,
            "to_user_id" => $request->to_id,
            "amount" => $request->amount,
        ]);
    }
}

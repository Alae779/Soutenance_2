<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Colocation;
use App\Mail\InvitationMail;
use App\Models\Invitation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function invite(Colocation $colocation){
        $colocation = Colocation::with('activeMembers', 'categories.exponses.payer')->find($colocation->id);
        // dd($colocation);
        return view('invite', compact('colocation'));
    }
    public function send(Request $request, Colocation $colocation){
        $invitation = Invitation::create([
            'colocation_id' => $colocation->id,
            'email' => $request->email,
            'token' => Str::uuid(),
            'status' => 'pending',
            'expires_at' => now()->addDays(7),
        ]);
        // $invitation->load('colocation');
        Mail::to($request->email)->send(new InvitationMail($invitation));
        return redirect('home');
    }
    
    public function accept($token){
        $invitation = Invitation::where('token', $token)->firstOrFail();
        if ($invitation->email !== Auth::user()->email) {
            return redirect()->route('home');
        }
        $invitation->colocation->members()->attach(Auth::id(), ['role' => "member"]);
        $invitation->update(['status' => "accepted"]);
        return redirect()->route('show_colocation', $invitation->colocation_id);
    }
}

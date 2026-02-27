<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExponseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Colocation;
use App\Models\Category;
use App\Models\Exponse;

class ExponseController extends Controller
{
    public function create(Category $category){
        return view('exponse.create', compact('category'));
    }
    public function store(StoreExponseRequest $request, $id){
        Exponse::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'category_id' => $id,
            'payer_id' => Auth::id()
        ]);
        return redirect('/');
    }
    public function delete($id){
        Exponse::destroy($id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Colocation $colocation){
        return view('category.create', compact('colocation'));
    }
    public function store(Request $request, Colocation $colocation){
        Category::create([
            'name' => $request->name,
            'colocation_id' => $colocation->id
        ]);
        return redirect('/');
    }
}

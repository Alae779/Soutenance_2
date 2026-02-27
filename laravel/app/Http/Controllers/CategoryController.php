<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Colocation $colocation){
        return view('category.create', compact('colocation'));
    }
    public function store(StoreCategoryRequest $request, Colocation $colocation){
        Category::create([
            'name' => $request->name,
            'colocation_id' => $colocation->id
        ]);
        return redirect('/');
    }
    public function delete($id){
        Category::destroy($id);
        return redirect('/');
    }
}

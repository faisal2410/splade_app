<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;

class CategoryController extends Controller
{
    public function index(){

        return view('categories.index',[
    'categories' => SpladeTable::for(Category::class)
        ->column('name', canBeHidden: false,sortable: true)
        ->withGlobalSearch( columns: ['name'] )
        ->column('slug')
        ->column('action')
        ->paginate(5),
]);
    }

    public function edit($id){

    }
}

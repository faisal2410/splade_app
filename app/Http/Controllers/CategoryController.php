<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\CategoryStoreRequest;

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

    public function create(){
        return view('categories.create');

    }

    public function store(CategoryStoreRequest $request){
        Category::create($request->validated());
        Toast::title( 'New Category created successfully' );
        return redirect()->route('categories.index');

    }

    public function edit(Category $category){
        return view('categories.edit',compact('category'));

    }

    public function update(CategoryStoreRequest $request, Category $category){
        $category->update( $request->validated() );
        Toast::title( ' Category updated successfully' );
        return redirect()->route( 'categories.index' );

    }

    public function destroy(Category $category){
        $category->delete();
        Toast::title( ' Category Deleted successfully' );
        return redirect()->back();
    }
}

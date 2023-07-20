<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Tables\Posts;
use App\Models\Category;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Requests\PostStoreRequest;

class PostController extends Controller {
    public function index() {


        return view( 'posts.index', [
            // 'posts' => SpladeTable::for ( $posts )
            //         ->column( 'title', canBeHidden: false, sortable: true )
            //         ->withGlobalSearch( columns: ['title'] )
            //         ->column( 'slug',sortable:true )
            //         ->column('action')
            //         ->selectFilter('category_id',$categories)
            //         ->paginate( 5 ),

               'posts'=>Posts::class
            ] );


        }


            public function create(){
                $categories=Category::pluck('name','id')->toArray();
                return view('posts.create',compact('categories'));

    }

    public function store(PostStoreRequest $request){
        Post::create($request->validated());
        Toast::title( 'New Post created successfully' );
        return to_route('posts.index');
    }


        public function edit(Post $post){
            $categories = Category::pluck( 'name', 'id' )->toArray();

            return view('posts.edit',compact('post','categories'));

        }


        public function update(PostStoreRequest $request, Post $post){

            $post->update( $request->validated() );
            Toast::title( 'Post updated successfully' );
            return to_route( 'posts.index' );

        }

        public function destroy(Post $post){
            $post->delete();
            Toast::title( ' Post Deleted successfully' );
            return redirect()->back();
        }

    }


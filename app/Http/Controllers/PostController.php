<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class PostController extends Controller {
    public function index() {

        $globalSearch = AllowedFilter::callback( 'global', function ( $query, $value ) {
            $query->where( function ( $query ) use ( $value ) {
                Collection::wrap( $value )->each( function ( $value ) use ( $query ) {
                    $query
                        ->orWhere( 'title', 'LIKE', "%{$value}%" )
                        ->orWhere( 'slug', 'LIKE', "%{$value}%" );
                        // ->orWhere( 'description', 'LIKE', "%{$value}%" );
                } );
            } );
        } );

        $posts = QueryBuilder::for ( Post::class )
                 ->defaultSort('title')
                 ->allowedSorts(['title', 'slug', ])
                 ->allowedFilters(['title', 'slug','category_id', $globalSearch]);

        $categories=Category::pluck('name','id')->toArray();

        return view( 'posts.index', [
            'posts' => SpladeTable::for ( $posts )
                    ->column( 'title', canBeHidden: false, sortable: true )
                    ->withGlobalSearch( columns: ['title'] )
                    ->column( 'slug',sortable:true )
                    ->column('action')
                    ->selectFilter('category_id',$categories)
                    ->paginate( 5 ),
            ] );
        }

        public function edit($id){

        }

    }


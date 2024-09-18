<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = ['asc', 'desc'];

        $posts = Post::paginate(10);

        $postsCollection = $posts->getCollection();

        $arraySort = [];
        if(in_array($request->created_at, $sort)) {
            array_push($arraySort, ['created_at', $request->created_at]);
        }

        if(in_array($request->price, $sort)) {
            array_push($arraySort, ['price', $request->price]);
        }

        if(count($arraySort) > 0) {
            $postsCollection = $postsCollection->sortBy($arraySort);
            $postsCollection = $postsCollection->values()->all();     
        }

        $postsCollection = collect($postsCollection)->map(function ($item, int $key) {
            return $item->only(['id', 'name', 'url1', 'price']);
        });

        $posts = $posts->setCollection($postsCollection);


        return response()
            ->json([
                'data' => $posts,
                'ok' => true,
            ]);

        // if(in_array($request->created_at, $sort)) {
        //     $posts->setCollection(
        //         $request->created_at === 'desc' ? $posts->sortByDesc('created_at') : $posts->sortBy('created_at')
        //     );
        // }

        // if(in_array($request->price, $sort)) {
        //     $posts->setCollection(
        //         $request->price === 'desc' ? $posts->sortByDesc('price') : $posts->sortBy('price')
        //     );
        // }            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $query = Post::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'url1' => $request->url1,
            'url2' => $request->url2,
            'url3' => $request->url3,
        ]);

        $query->save();

        return response()
            ->json([
                'data' => $query->id,
                'ok' => true 
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post_data = $post->query()->where('id', $post->id)->first();
        
        return response()
            ->json([
                'data' => $post_data,
                'ok' => true
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

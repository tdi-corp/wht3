<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return response()
            ->json($posts);
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
                'id' => $query->id
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, $id)
    {
        $post_data = $post->query()->where('id', $id)->first();
        
        if(!isset($post_data)) {
            abort(404);
        }

        return response()
            ->json($post_data);
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

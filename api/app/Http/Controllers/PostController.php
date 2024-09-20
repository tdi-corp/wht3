<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = ['asc', 'desc'];

        $posts = Post::when($request->has('created_at') && in_array($request->created_at, $sort), function($query) use ($request) {
            $query->orderBy('created_at', $request->created_at);
        })
        ->when($request->has('price') && in_array($request->price, $sort), function($query) use ($request) {
            $query->orderBy('price', $request->price);
        })
        ->select('id', 'name', 'url1', 'price')
        ->paginate(10);

        return response()
            ->json([
                'data' => $posts,
                'ok' => true,
            ]);
        
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'description' => 'required|max:1000',
            'price' => 'required|numeric',
            'url1' => 'required|url:http,https',
            'url2' => 'url:http,https',
            'url3' => 'url:http,https',          
        ]);

        if($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => true,
                'messages' => $validator->errors()
            ], 400);
        }

        $query = Post::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => floatval($request->price),
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
    public function show(Post $post, Request $request)
    {
        $post_data = $post->query()->where('id', $post->id)->first();
        
        if($request->fields == 'description')
        {
            $result = $post_data->only('description');
        }
        elseif($request->fields == 'url2')
        {
            $result = $post_data->only('url2');
        }
        elseif($request->fields == 'url3')
        {
            $result = $post_data->only('url3');
        }        
        else 
        {
            $result = $post_data->only('id', 'name', 'price', 'url1');

        }
        
        return response()
            ->json([
                'data' => $result,
                'ok' => true,
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

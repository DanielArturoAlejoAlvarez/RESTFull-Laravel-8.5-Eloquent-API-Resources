<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post as PostRequest;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    protected $post;

    /**HTTP Status
     * 1XX Info
     * 2XX Respose Successfully
     * 3XX Redirection
     * 4XX Error Client
     * 5XX Error Server
     */

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            new PostCollection(
                $this->post->orderBy('id', 'DESC')->get()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $post = $this->post->create($request->all());
        return response()->json(new PostResource($post), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return response()->json(new PostResource($post), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());
        return response()->json(new PostResource($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        /**
         * VerifyCsrfToken apply except api/*
         */
        return response()->json(null, 204);
    }
}

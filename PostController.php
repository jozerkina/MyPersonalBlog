<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $post = new Post();
        $post->id = $request['id'];
        $post->type = $request['type'];
        $post->blog_id = $request['blog_id'];
        $post->title = $request['title'];
        $post->url = $request['url'];
        $post->description = $request['description'];
        $post->save();
        return redirect('/blog/'.$request['blog_id']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->id = $request['id'];
        $post->type = $request['type'];
        $post->blog_id = $request['blog_id'];
        $post->title = $request['title'];
        $post->url = $request['url'];
        $post->description = $request['description'];
        $post->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    public function pc(){
        return view('post_create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $blog_id = $post->blog_id;
        Post::deleteData($id);
        return redirect('/blog/'.$blog_id);
    }
}

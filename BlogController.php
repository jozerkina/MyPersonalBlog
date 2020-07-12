<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $users = User::find($user_id);
            if(Auth::id()){
                $blog = Blog::All();
                if($users->role == 1){
                    
                } else  
                $blog = Blog::Where('user_id',$user_id)->get();
            } else {
                
            }
            return view('blogs', ['blogs' => $blog]);
        } else {
            return redirect ('/login');
        }   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'regex:/^[a-zA-Z ]+$/', 'max:50'],
        ]);

        if ($validator->fails()) {
            return redirect('/blog')->withErrors($validator);
        } else {
        $blog = new Blog();
        $blog->id = $request['id'];
        $blog->name = $request['name'];
        $blog->user_id = $request['user_id'];
        $blog->save();
        return redirect('/blogs');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->id = $request['id'];
        $blog->name = $request['name'];
        $blog->user_id = $request['user_id'];
        $blog->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            //$user_id = $blogs->user_id;
            $user_id = Auth::id();
            $users = User::find($user_id);
            if($users->role == 1){
                $posts = Post::All();
            } else {
                $posts = Post::Where('blog_id',$id)->get();
            }
            $blog = Blog::find($id);
            //$posts = Post::Where('blog_id',$id);
            return view('posts', ['posts' => $posts, 'blog' => $blog]);
        } else {
            return redirect ('/login');
        }
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->input('name');

        if($name !=''){
           $data = array('name'=>$name);
           Blog::updateData($id, $data);
        }
    }
    
    public function bc(){
        return view('blog_create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::Where('blog_id',$id)->get();
        foreach($posts as $post) {
            $post_id = $post->id;
            Post::deleteData($post_id);
        }
            if (Post::Where('blog_id',$id)->exists()){
                return redirect('/blogs');
            } else {
                Blog::deleteData($id);
            }
        return redirect('/blogs');
    }
}

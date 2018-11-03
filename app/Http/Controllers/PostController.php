<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['publicHomePage', 'show']]);
    }

    public function publicHomePage(Request $request) {
        if ($request->input('type') == 'recentPosts') {
            $posts = Post::orderBy('created_at', 'desc')->paginate(10);
            $organization = 'Top 10 Most Recent Posts';
        } else if ($request->input('type') == 'mostCommented') {
            $posts = Post::orderBy('comment_count', 'desc')->paginate(10);
            $organization = 'Top 10 Most Commented Posts';
        } else if ($request->input('type') == 'mostVisited') {
            $posts = Post::orderBy('visit_count', 'desc')->paginate(10);
            $organization = 'Top 10 Most Visited Posts';
        } else {
            $posts = Post::orderBy('created_at', 'asc')->paginate(10);
            $organization = 'Top 10 Most Recent Posts';
        }


        $data = array(
          'posts' => $posts,
          'organization' => $organization
        );


        return view('blog/home', $data);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedInUserId = Auth::id();
        $posts = Post::all()->where('user_id', $loggedInUserId);

        return view('adminPanel/home', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminPanel/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        $post = new Post;

        $postTitle = $request->title;
        $postBody = $request->body;
        $postUserId = Auth::id();

        $post->user_id = $postUserId;
        $post->title = $postTitle;
        $post->body = $postBody;
        $post->comment_count = 0;
        $post->visit_count = 0;


        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find ($id);

        $data = array(
            'id' => $id,
            'post' => $post
        );

        return view('blog.view_post', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('adminPanel.edit', ['post'=>$post]);
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
        $post = Post::find($id);

        if (isset($request->commentCount)) {
            $commentCount = $request->commentCount;
            $post->comment_count = $commentCount;

        }

        if (isset($request->visitCount)) {
            $visitCount = $request->visitCount;
            $post->visit_count = $visitCount;
        }

        if (isset($request->title)) {
            $post->title = $request->title;
        }

        if (isset($request->body)) {
            $post->body = $request->body;
        }

        $post->save();

        if (isset($request->editForm)) {
            return redirect()->route('posts.index');

        } else {
          return redirect()->route('posts.show', ['id'=>$id]);
        }


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

        $post->delete();

        return redirect()->route('posts.index');
    }
}

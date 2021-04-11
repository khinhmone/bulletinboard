<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Carbon\Carbon;
use Auth;

class PostController extends Controller
{
	// show all posts
	public function index() 
	{
		if (Auth::user()->type == 1) {
			$postList = Post::leftJoin('users','posts.create_user_id', '=', 'users.id')
			->select('posts.*' ,'users.name')
			->orderBy('created_at', 'DESC')
			->paginate(5);
		} else {
			$postList = Post::leftJoin('users','posts.create_user_id', '=', 'users.id')
			->select('posts.*' ,'users.name')
			->where('users.id', '=', Auth::user()->id)
			->orderBy('created_at', 'DESC')
			->paginate(5);
		}
		return view('post.postlist',['postList' => $postList]);
	}

	// create post form
	public function createPost() 
	{
		return view('post.createpost');
	}

	// confirm create post
	public function createPostConfirm(Request $request)
	{
		$this->validate(request(),[
			'title'=>'required|unique:posts|max:255',
			'description'=>'required',
		]);

		$title = $request->get('title');
		$description = $request->get('description');
		return view('post.createpostconfirm',['title' => $title, 'description' => $description]);
	}

	// store post to db
	public function storePost(Request $request) 
	{
		$post = new Post;
		$post->title = $request->get('title');
		$post->description = $request->get('description');
		$post->status = 1;
		$post->create_user_id = Auth::user()->id;
		$post->updated_user_id = Auth::user()->id;
		$post->created_at = Carbon::now();
		$post->updated_at = Carbon::now();
		$post->save();
		return redirect('/posts')->with('success','Post created successfully!');
	}

	// retrieve data for update post form
	public function editPost($id) 
	{
		$ids = $id;
		$post = Post::findOrFail($id);
		$title = $post->title;
		$description = $post->description;
		$status = $post->status;
		if ($status == 1) {
			$checked = 'checked';
		} else {
			$checked = '';
		}
		return view('post.updatepost', ['title' => $title, 'description' => $description, 'id' => $ids, 'checked' => $checked, 'status' => $status]);
	}

	// show data for update post form
	public function editPostConfirm($id, Request $request) 
	{
		// dd($request);
		$this->validate(request(),[
			'title'=>'required|unique:posts|max:255',
			'description'=>'required',
		]);

		$ids = $id;
		$title = $request->input('title');
		$description = $request->input('description');
		$status = $request->input('status');
		if ($status == 1) {
			$checked = 'checked';
		} else {
			$checked = '';
		}
		return view('post.updatepostconfirm', ['title' => $title, 'description' => $description, 'id' => $ids, 'checked' => $checked, 'status' => $status]);
	}

	// update post data to db
	public function updatePost($id, Request $request) 
	{
		$this->validate(request(),[
			'title'=>'required|unique:posts|max:255',
			'description'=>'required',
		]);

		$post = Post::findOrFail($id);
		$post->title = $request->get('title');
		$post->description = $request->get('description');
		// $post->stauts = $request->get('stauts');
		$post->updated_user_id = Auth::user()->id;
		$post->updated_at = Carbon::now();
		$post->save();
		return redirect('/posts')->with('success', 'Post updated successfully!');
	}

	// delete post data to db
	public function deletePost($id) 
	{
		$post = Post::findOrFail($id);
		$post->deleted_user_id = Auth::user()->id;
		$post->deleted_at = Carbon::now();
		$post->update();
		return redirect('posts')->with('success','Post temporarily deleted!');
	}

	public function searchPost(Request $request) 
	{
		$search_data = $request->get('search');
		if ($search_data != null) {
			$postList = Post::where('title', 'LIKE', '%'.$search_data.'%')->get();
			return view('post.postsearchresult',compact('postList'));
		} else {
			return redirect('/posts')->with('success','Please insert search keywords');
		}
	}
}

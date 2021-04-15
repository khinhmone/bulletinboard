<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;
use Carbon\Carbon;
use Auth;

class PostController extends Controller
{
	// show all posts
	public function index() 
	{
		$postList = '';
		if (isset(Auth::user()->type)) {
			if (Auth::user()->type == 0) {
				$postList = Post::leftJoin('users','posts.create_user_id', '=', 'users.id')
				->select('posts.*' ,'users.name', DB::raw('DATE_FORMAT(posts.created_at, "%d/%m/%Y") as formatted_created_at'))
				->orderBy('created_at', 'DESC')
				->paginate(5);
			} else {
				$postList = Post::leftJoin('users','posts.create_user_id', '=', 'users.id')
				->select('posts.*' ,'users.name')
				->where('users.id', '=', Auth::user()->id)
				->orderBy('created_at', 'DESC')
				->paginate(5);
			}
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
		$checked = '';
		$ids = $id;
		$post = Post::findOrFail($id);
		$title = $post->title;
		$description = $post->description;
		$status = $post->status;
		if ($status == 1) {
			$checked = 'checked';
		}
		return view('post.updatepost', ['title' => $title, 'description' => $description, 'id' => $ids, 'checked' => $checked, 'status' => $status]);
	}

	// show data for update post form
	public function editPostConfirm($id, Request $request) 
	{
		$checked = '';
		$this->validate(request(),[
			'title'=>'required|unique:posts|max:255',
			'description'=>'required',
		]);

		$ids = $id;
		$title = $request->get('title');
		$description = $request->get('description');

		if ($request->get('status') == "0") {
			$checked = 'checked';
		}

		return view('post.updatepostconfirm', ['title' => $title, 'description' => $description, 'id' => $ids, 'checked' => $checked]);
	}

	// update post data to db
	public function updatePost($id, Request $request) 
	{

		if ($request->get('status') == 'on') {
			$status = 1;
		}

		if (empty($request->get('status'))) {
			$status = 0;
		}

		$post = Post::findOrFail($id);
		$post->title = $request->get('title');
		$post->description = $request->get('description');
		$post->status = $status;
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
			if (Auth::user()->type == 0) {
				$postList = Post::where('title', 'LIKE', '%'.$search_data.'%')->paginate(5);
			} else {
				$postList = Post::where('title', 'LIKE', '%'.$search_data.'%')->where('create_user_id', '=', Auth::user()->id)->paginate(5);
			}
			return view('post.postList',compact('postList'));
		} else {
			return redirect('/posts')->with('success','Please insert search keywords');
		}
	}

	public function uploadCSV() 
	{
		return view('post.uploadcsv');
	}

}

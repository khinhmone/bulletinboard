<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Carbon\Carbon;
use Auth;

class PostController extends Controller
{
	public function index() {

		// $users = User::paginate(10);
		// $users->load('customer');
		// $users->load('admin');
		// return view('admin.userlist',compact('users'));


		// $postList = Post::latest()->paginate(5);
		// $postList->load('user');

		$postList = Post::leftJoin('users','posts.create_user_id', '=', 'users.id')
        ->select('posts.*' ,'users.name')
        ->orderBy('created_at', 'DESC')
        ->paginate(5);




		return view('post.postlist',['postList' => $postList]);
	}

	public function createView() {
		return view('post.createpost');
	}

	public function createConfirm(Request $request){
		$this->validate(request(),[
		'title'=>'required|unique:posts|max:255',
		'description'=>'required',
    ]);
		$title = $request->get('title');
		$description = $request->get('description');
		return view('post.createpostconfirm',['title' => $title, 'description' => $description]);
	}

	public function storePost(Request $request){
		$post = new Post;
    	$post->title = $request->get('title');
    	$post->description = $request->get('description');
    	$post->status = 1;
    	$post->create_user_id = Auth::user()->id;
    	$post->updated_user_id = Auth::user()->id;
    	$post->created_at = Carbon::now();
    	$post->updated_at = Carbon::now();
    	$post->save();
    	return redirect('posts')->with('success','Post created successfully!!!');
	}

	public function searchPost(Request $request){
		$search_data = $request->get('search');
		if ($search_data != null) {
			$postList = Post::where('title', 'LIKE', '%'.$search_data.'%')->get();
			return view('post.postsearchresult',compact('postList'));
		} else {			
			return redirect('/posts')->with('success','No data in search box!');
		}                
	}
}

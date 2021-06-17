<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use Auth;

class PostDao implements PostDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
	public function getPostList()
	{
		$postList = '';
		if (Auth::user()->type == 0) {
			$postList = Post::leftJoin('users','posts.create_user_id', '=', 'users.id')
			// ->andJoin('users','posts.updated_user_id', '=', 'users.id')
			->select('posts.*' ,'users.name', DB::raw('DATE_FORMAT(posts.created_at, "%d/%m/%Y") as formatted_created_at'))
			->orderBy('created_at', 'DESC');
		} else {
			$postList = Post::leftJoin('users','posts.create_user_id', '=', 'users.id')
			->select('posts.*' ,'users.name', DB::raw('DATE_FORMAT(posts.created_at, "%d/%m/%Y") as formatted_created_at'))
			->where('users.id', '=', Auth::user()->id)
			->orderBy('created_at', 'DESC');
		}
		return $postList->paginate(5);
	}

	public function savePostConfirm(Request $request)
	{
		$title = $request->get('title');
	    $description = $request->get('description');
	    return view('post.createpostconfirm',[
	      'title' => $title, 
	      'description' => $description
	    ]);
	}

	public function savePost(Request $request)
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
	}

	public function getPostById($id)
	{
		$checked = '';
		$ids = $id;
		$post = Post::findOrFail($id);
		$title = $post->title;
		$description = $post->description;
		$status = $post->status;
		if ($status == 1) : $checked = 'checked'; endif;
		return view('post.updatepost', [
			'title' => $title,
			'description' => $description,
			'id' => $ids,
			'checked' => $checked,
			'status' => $status]);
	}

	public function updatePostConfirm($id, Request $request)
	{
		$checked = '';
		$ids = $id;
	    $title = $request->get('title');
	    $description = $request->get('description');
	    if ($request->get('status') == "0") : $checked = 'checked'; endif;

	    return view('post.updatepostconfirm', [
	      'title' => $title, 
	      'description' => $description, 
	      'id' => $ids, 
	      'checked' => $checked]);
	}

	public function updatePost($id, Request $request)
	{
		if ($request->get('status') == 'on') : $status = 1; endif;
		if (empty($request->get('status'))) : $status = 0; endif;
		$post = Post::findOrFail($id);
		$post->title = $request->get('title');
		$post->description = $request->get('description');
		$post->status = $status;
		$post->updated_user_id = Auth::user()->id;
		$post->updated_at = Carbon::now();
		$post->save();
	}

	public function deletePost($id)
	{
		$post = Post::findOrFail($id);
	    $post->deleted_user_id = Auth::user()->id;
	    $post->deleted_at = Carbon::now();
	    $post->update();
	}

	public function searchPost($search)
	{
		if (Auth::user()->type == 0) {
			$search_post = Post::leftJoin('users','posts.create_user_id', '=', 'users.id')
				->select('posts.*' ,'users.name', DB::raw('DATE_FORMAT(posts.created_at, "%d/%m/%Y") as formatted_created_at'))->where('title', 'LIKE', '%'.$search.'%');
		} else {
			$search_post = Post::leftJoin('users','posts.create_user_id', '=', 'users.id')
				->select('posts.*' ,'users.name', DB::raw('DATE_FORMAT(posts.created_at, "%d/%m/%Y") as formatted_created_at'))->where('title', 'LIKE', '%'.$search.'%')
						->where('posts.create_user_id', '=', Auth::user()->id);
		}
		return $search_post->paginate(5);
	}
}

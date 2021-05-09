<?php

namespace App\Http\Controllers\Post;

use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{

  private $postInterface;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(PostServiceInterface $postInterface)
  {

    $this->middleware('auth');
    $this->postInterface = $postInterface;
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $postList = $this->postInterface->getPostList();

    return view('post.postlist', [
      'postList' => $postList,
    ]);
  }

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

    $savePostConfirm = $this->postInterface->savePostConfirm($request);
    return $savePostConfirm; 
  }

  // store post to db
  public function storePost(Request $request) 
  {
    $this->postInterface->savePost($request);
    return redirect('/posts')->with('success','Post created successfully!');    
  }

  // retrieve data for update post form
  public function editPost($id) 
  {
    $getPostById = $this->postInterface->getPostById($id);
    return $getPostById;    
  }

  // show data for update post form
  public function editPostConfirm($id, Request $request) 
  {
    $checked = '';
    $this->validate(request(),[
      'title'=>'required|unique:posts|max:255',
      'description'=>'required',
    ]);

    $updatePostConfirm = $this->postInterface->updatePostConfirm($id, $request);
    return $updatePostConfirm; 
  }

  // update post data to db
  public function updatePost($id, Request $request) 
  {
    $this->postInterface->updatePost($id, $request);
    return redirect('/posts')->with('success', 'Post updated successfully!');
  }

  // delete post data to db
  public function deletePost($id) 
  {
    $this->postInterface->deletePost($id);
    return redirect('posts')->with('success','Post temporarily deleted!');
  }

  public function searchPost(Request $request) 
  {
    $search_data = $request->get('search');
    $postList = $this->postInterface->searchPost($search_data);
    return view('post.postList',compact('postList'));
  }

  public function uploadCSV() 
  {
    return view('post.uploadcsv');
  }
}

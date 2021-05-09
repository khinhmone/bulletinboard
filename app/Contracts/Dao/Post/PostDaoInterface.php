<?php

namespace App\Contracts\Dao\Post;
use Illuminate\Http\Request;

interface PostDaoInterface
{
  //get post list
  public function getPostList();
  public function savePost(Request $request);
  public function getPostById($id);
  public function updatePost($id, Request $request);
  public function deletePost($id);
}

<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Http\Request;

class PostService implements PostServiceInterface
{
  private $postDao;

  /**
   * Class Constructor
   * @param OperatorPostDaoInterface
   * @return
   */
  public function __construct(PostDaoInterface $postDao)
  {
    $this->postDao = $postDao;
  }

  /**
   * Get Post List
   * @param Object
   * @return $postList
   */
  public function getPostList()
  {
    return $this->postDao->getPostList();
  }

  public function savePostConfirm(Request $request)
  {
    return $this->postDao->savePostConfirm($request);
  }

  public function savePost(Request $request)
  {
    return $this->postDao->savePost($request);
  }

  public function getPostById($id)
  {
    return $this->postDao->getPostById($id); 
  }

  public function updatePostConfirm($id, Request $request)
  {
    return $this->postDao->updatePostConfirm($id, $request); 
  }

  public function updatePost($id, Request $request)
  {
    return $this->postDao->updatePost($id, $request); 
  }

  public function deletePost($id)
  {
    return $this->postDao->deletePost($id); 
  }

  public function searchPost($request)
  {
    return $this->postDao->searchPost($request); 
  }
}

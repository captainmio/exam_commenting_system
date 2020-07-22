<?php
namespace App\Repositories;  

use App\Repositories\Interfaces\CommentRepositoryInterface; 
use Illuminate\Support\Collection;

use App\Comment;

class CommentRepository implements CommentRepositoryInterface 
{
    /**
     * Add a comment to a post
     * @param string $name = Name of the commentor
     * @param int $parent_id = to identify if this comment is a parent comment or under(reply) a parent comment(its a child comment)
     * @param int $body = content of the comment
     * 
     * @return int id of the the inserted comment
     */
    public function store(string $name, int $parent_id, $body): int
    {
        $comment  = new Comment;
        $comment->name = $name;
        $comment->body = $body;
        $comment->parent_id = $parent_id;
        $result = $comment->save();

        if($result){
            return $result;
        } else {
            return 0;
        }
    }

    /** Pull comment by parent_id
     * @param int $parent_id = parent_id of the comment to be pulled
     * 
     * @return int collection of comments
     */
    public function findByParentId(int $parent_id): collection
    {
        return Comment::where('parent_id', '=', $parent_id)->orderBy('created_at','desc')->get();
    }
}
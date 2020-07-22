<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Comment;

class CommentController extends Controller
{
    protected $commentRepository;
    /**
     * commentController constructor. Implemented Repository design pattern
     *
     * @param commentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    // Save a comment to comments table
    public function store(Request $request) {
        // validate data receive
        $request->validate([
            'name'=>'required',
            'parent_id'=>'required|integer',
            'body'=>'required'
        ]);

        $name = $request->name;
        $parent_id = $request->parent_id;
        $body = $request->body;
        
        $comment_result = $this->commentRepository->store($name, $parent_id, $body);

        if($comment_result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true], 400);
        }

        return response()->json(['error' => 'Unidentifed Error, Please contact our personnel immediately'], 400);
    }

    // Pull
    public function findByParentId(Request $request) {
        // validate data
        $request->validate([
            'id'=>'required'
        ]);

        $parent_id = $request->id;

        $comment_result = $this->commentRepository->findByParentId($parent_id);

        return response()->json($comment_result);

    }
}

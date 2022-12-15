<?php
namespace App\Http\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{
    public function delete($idComment){
        $comment = Comment::find($idComment);
        $comment->delete();

        return json_encode(['result'=>'success']);
    }
}

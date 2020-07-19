<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * The storeComment function is used to store comment in blogblog by any user .
     * @param  \App\Http\Requests\StoreBlogPost  $request , object of blog
     * @return \Illuminate\Http\Response
     */
    public function storeComment(StoreCommentRequest $request, Blog $blog)
    {

        if ($blog->exists()) {

            if ($request->comment != null  || $request->rank != null) {

                $comment = Comment::create([
                    'comment_owner' => $request->user_name,
                    'blog_id' => $blog->id,
                ]);

                if ($request->comment != null) {
                    $comment->comment = $request->comment;
                }
                if ($request->rank != null) {
                    $comment->rank = $request->rank;
                }
                $comment->save();
                $avg = DB::table('comments')->where('blog_id', '=', $blog->id)->avg('rank');
                $blog->overallRate = $avg;
                $blog->save();

                return  $this->showWithRelations($blog, $blog->comments);
            } else {
                return $this->errorResponse('can not store  without one of comment or rank ', 422);
            }
        } else {
            return $this->errorResponse('blog is not exist', 404);
        }
    }
}

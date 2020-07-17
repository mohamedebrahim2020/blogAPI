<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function storeComment(Request $request ,Blog $blog){
        
        if ($blog->exists()) {
            
            
            if ($request->comment != null  || $request->rank != null) {
                $validatedUsername = $request->validate([
                    'user_name' => 'required',
                ]);
                $comment = Comment::create([
                    'comment_owner' => $request->user_name, 
                    'blog_id' => $blog->id,
                ]);
                
               // dd($request);
               
                if ($request->comment != null){
                    $comment->comment = $request->comment;
                    
                }
                if ($request->rank != null){
                    $validatedRank = $request->validate([
                        'rank' => 'integer|between:1,5',
                    ]);
                    $comment->rank = $request->rank;
                    $avg = DB::table('comments')->where('blog_id','=',$blog->id)->avg('rank');
                    
                    $blog->overallRate = $avg;
                    $blog->save();
                    
                    
                }
                $comment->save();
                return response()->json($comment);
            }else{
                return response()->json('can not store  without one of comment or rank ');
            }
        } else {
            return "404";
        }
       
        
        
    }
}

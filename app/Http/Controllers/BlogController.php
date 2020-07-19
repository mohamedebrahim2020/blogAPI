<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Support\Facades\Auth;

class BlogController extends ApiController
{
    public $successStatus = 200;

    /**
     * The store function is used to create blog by only Auth user .
     * @param  \App\Http\Requests\StoreBlogPost  $request
     * @return  \Illuminate\Http\Response
     */

    public function store(StoreBlogPost $request)
    {

        $auth = Auth::id();
        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => $auth,

        ]);
        if ($request->hasFile('image')) {

            foreach ($request->file('image') as $img) {

                $name = $img->getClientOriginalName();
                $img->move(public_path() . '/storage/files', $name);
                $data[] = $name;
                $blog->image = json_encode($data);
            };



            $blog->save();
            return $this->showOne($blog);

            if (Auth::id() == null) {
                return $this->errorResponse('unauthorized person', 401);
            }
        }
    }
    /**
     * The index function is used to show blogs list contains title&images only by any user .
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $blogs = Blog::paginate(10, ['title', 'image']);
        return $this->showEloquent($blogs);
    }


    /**
     * The showBlog function is used to show certain blog with comments  by any user .
     * @param  int id
     * @return \Illuminate\Http\Response
     */
    public function showBlog($blog)
    {

        $blog = Blog::find($blog);
        return  $this->showWithRelations($blog, $blog->comments);
    }
}

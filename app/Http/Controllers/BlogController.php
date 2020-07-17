<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends ApiController
{   
    public $successStatus = 200;
    public function store(StoreBlogPost $request){
       
        $auth = Auth::id(); 
        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
           
            //'image' => $request->image->store('files','public'),
            'author_id' => $auth,
            
            ]);
            foreach($request->file('image') as $img)
            {
                
                $name = $img->getClientOriginalName();
               // dd(public_path());
                $img->move(public_path().'\storage\files', $name);  
                $data[] = $name;  
            };
            $blog->image=json_encode($data);
            $blog->save();
            return $this->showOne($blog);

            // if (Auth::id() == null) {
            // return $this->errorResponse('unauthorized person',401);
            // }
    }
   

    public function index(){

        $blogs = Blog::paginate(10,['title','image']);
        return $this->showEloquent($blogs); 
    }

    

    public function showBlog($blog){

        $blog = Blog::findorfail($blog);
        return  $this->showWithRelations($blog,$blog->comments);
    }
}

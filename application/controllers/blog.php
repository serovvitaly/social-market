<?php


class Blog_Controller extends Base_Controller
{
    public function action_index()
    {
        return View::make('base.blog.index', array(
            'ctgs' => Blog::all(),
            'blog_title' => 'Все статьи',
            'posts' => Post::where('published', '=', 1)->take(10)->get()
        ));
    }
    
    public function action_ctg($ctg_id = 0)
    {    
    
        $ctg_id = Input::get('id', $ctg_id);
        
        $posts = array();
        
        if ($ctg_id > 0) {
            $blog = Blog::find($ctg_id);
            
            $posts = $blog->posts()->get();
        }
        
        return View::make('base.blog.index', array(
            'ctgs'  => Blog::all(),
            'blog_title' => $blog ? $blog->name : '',
            'posts' => $posts
        ));
    }
    
    
    public function action_post($id = 0)
    {   
        $id = Input::get('id', $id);
        
        $post = Post::find($id);
         
        return View::make('base.blog.post', array(
            'post' => $post->to_array(),
            'blog_title' => $post->category->name,
            'ctgs' => Blog::all()
        ));
    }
}
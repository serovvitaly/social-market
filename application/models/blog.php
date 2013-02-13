<?php


class Blog extends Eloquent
{
    public static $table = 'blog_ctgs';
    
    public function posts()
    {
        return $this->has_many('Post', 'parent');
    }
    
    public function alias()
    {
        return '/left_stat.php?id=' . $this->id;
        return '/blog/ctg/' . $this->id;
    }
    
    public function posts_count()
    {
        return $this->posts()->count();
    }
}
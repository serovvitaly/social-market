<?php

class Post extends Eloquent
{
    public static $table = 'blog_posts';
    
    
    public function created_month()
    {
        $month = (int) date('m', strtotime($this->create_by));
        
        $mt = array('','янв','фев','мрт','апр','май','июн','июл','авг','снт','окт','ноя','дек');
        
        return $mt[$month];
    }
    
    public function created_day()
    {
        return (int) date('d', strtotime($this->create_by));
    }
    
    public function created_year()
    {
        return date('Y', strtotime($this->create_by));
    }
    
    
    public function category()
    {
        return $this->belongs_to('Blog', 'parent');
    }
    
    
    public function alias()
    {
        return '/left_stat_det.php?id=' . $this->id;
        return '/blog/post/' . $this->id;
    }
    
    
    public function image()
    {
        $image = Image::where('contentid', '=', $this->id)->first();
        
        return $image ? '/data/img_stat/' . substr($image->value, 23) : '/vendors/skydream/images/pic_blog_4_2.jpg';
    }
    
    public function introtext()
    {
        $string = strip_tags($this->content);
        $string = substr($string, 0, 500);
        $string = substr($string, 0, strrpos($string, ' '));
        
        return $string;
    }
}
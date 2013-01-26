<?php

class User extends Eloquent
{
    
    public function apps()
    {
        return $this->has_many('Application');
    }
    
    
    public function products()
    {
        return $this->has_many('Product');
    }
    
}
<?php

class User extends Eloquent
{
    
    public function apps()
    {
        return $this->has_many('Application');
    }
    
}
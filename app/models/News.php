<?php

class News extends Eloquent
{
    public function pics()
    {
        return $this->hasMany('NewsPic');
    }
}

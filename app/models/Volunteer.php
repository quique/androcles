<?php

// See http://laravel.com/docs/eloquent

class Volunteer extends Eloquent
{

    protected $table = 'volunteers';
    protected $fillable = ['id', 'alias', 'task', 'description', 'photo', 'publish'];
    // protected $guarded = array('id');

}

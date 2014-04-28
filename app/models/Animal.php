<?php

class Animal extends Eloquent
{
    public function species()
    {
        return $this->belongsTo('Species');
    }

    public function sex()
    {
        return $this->belongsTo('Sex');
    }

    public function color()
    {
        return $this->belongsTo('Color');
    }

    public function coat()
    {
        return $this->belongsTo('Coat');
    }

    public function status()
    {
        return $this->belongsTo('Status');
    }

    public function animal_pics()
    {
        return $this->hasMany('AnimalPic');
    }

}


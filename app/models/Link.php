<?php

use Magniloquent\Magniloquent\Magniloquent;

class Link extends Magniloquent
{

    protected $fillable = ['name', 'url', 'description'];
    protected $guarded = array();
    protected static $purgeable = ['_token'];
    protected $table = "links";

    /**
     * Validation rules
     */
    public static $rules = array(
        "save" => array(
            'name' => 'required',
            'url'  => 'required|url'
        ),
        "create" => array(
            'name' => 'unique:links',
            'url'  => 'unique:links',
        ),
        "update" => array(
            'name' => 'unique:links',
            'url'  => 'unique:links',
        )
    );


    public function update(array $input = array())
    {
        $link = Link::find($input['id']);
        $link->save($input);
        return $link;
    }

}

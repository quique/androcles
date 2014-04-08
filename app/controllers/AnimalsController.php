<?php

class AnimalsController extends BaseController
{
    public function read()
    {
        $animals = Animal::all();
#       return View::make('animals.read', compact('animals'));
#       return View::make('animals.read')->with('animals', $animals);
        return View::make('animals.read', ['animals' => $animals, 'title' => "All animals"]);
    }
}


<?php

use \Auth, \BaseController, \Form, \Input, \Redirect, \Sentry, \View;

class LinksController extends \BaseController {

    /**
     * Instantiate a new LinksController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('hasAccess', array('except' => ['index', 'show']));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $links = Link::orderBy('name', 'ASC')->get();
        #$foos = Link::all(); //$this->orderBy('name', 'ASC')->get();
        return View::make('links.index')->with('links', $links)->with('title', "links.all");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('links.create')->with('title', "links.add");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // Validation rules are defined in the model, and managed by Magniloquent.
        $s = Link::create(Input::all());

        if ($s->isSaved()) {
            Session::flash('success', 'links.created');
            return Redirect::route('links.index');// ->with('flash', 'The new link has been created');
        }

        return Redirect::route('links.create')
            ->withInput()
            ->withErrors($s->errors());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Link $link)
    {
        //$link = Link::findOrFail($id);
        return View::make('links.edit')->with('link', $link)->with('title', "links.edit");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Link $link)
    {
        $s = $link->update(Input::all());

        if($s->isSaved()) {
            Session::flash('success', 'links.updated');
            return Redirect::route('links.index'); // route('links.show', $id)->with('flash', 'The link was updated');
        }

        return Redirect::route('links.edit', $id)
            ->withInput()
            ->withErrors($s->errors());
    }


    /**
     * Show delete confirmation page.
     */
    public function delete(Link $link)
    {
        return View::make('links.delete')->with('link', $link)->with('title', "links.removal");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Link $link)
    {
        try {
            $link->delete;
        } catch (Exception $e) {
            //
        }
        return Redirect::route('links.index');

    }


}

<?php

// See http://laravel.com/docs/controllers

class VolunteersController extends \BaseController {

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        // Filters are defined in app/filters.php
        $this->beforeFilter('auth', array('except' => ['index', 'show']));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $volunteers = Volunteer::where('publish', 1)->orderBy('alias', 'ASC')->get();
        return View::make('volunteers.index', [
            'volunteers' => $volunteers,
            'title'      => 'volunteers.all'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Every user has one and only one volunteer record.  There is no need for this method.
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // Every user has one and only one volunteer record.  There is no need for this method.
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Volunteer $volunteer)
    {
        if (!$volunteer->publish) {
            return Redirect::action('VolunteersController@index');
        }

        return View::make('volunteers.show', [
            'volunteer' => $volunteer,
            'title'     => trans('volunteers.about', ['alias' => $volunteer->alias]),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Volunteer $volunteer)
    {
        if ($volunteer->id != Sentry::getUser()->id) {
            return Redirect::action('VolunteersController@index');
        }

        return View::make('volunteers.edit', [
            'volunteer' => $volunteer,
            'title'     => 'volunteers.edition',
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Volunteer $volunteer)
    {
        $input = Input::all();
        if ($volunteer->id != Sentry::getUser()->id or $volunteer->id != $input['id']) {
            return Redirect::action('VolunteersController@index');
        }

        $rules = [
            'alias'       => 'required',
            'description' => 'required',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            Session::flash('danger', 'volunteers.not-updated');
            return Redirect::action('VolunteersController@edit', ['id'=>$input['id']])
                ->withErrors($validator)
                ->withInput();
        }

        /* And new picture */
        $images_dir = public_path() ."/images/volunteers/";
        $thumbnails_dir  = public_path() ."/images/volunteerthumbs/";

        if (Input::hasFile('photo') and Input::file('photo')->getMimeType() == "image/jpeg") {
            $filename = $volunteer->id . '_' . str_random(6) . '.jpg';

            try {
                $movedfile = Input::file('photo')->move($images_dir, $filename);
                $this->resizeImage($images_dir . $filename, $thumbnails_dir . $filename, 320, 240);
                $this->resizeImage($images_dir . $filename, $images_dir . $filename, 960, 720);
            } catch(Exception $e) {
                die($e->getMessage());
            }
            if ($volunteer->photo and $volunteer->photo != 'nopic.jpg') {  // "Delete" the old file.
                unlink($images_dir . $volunteer->photo);
                unlink($thumbnails_dir . $volunteer->photo);
            }
            $volunteer->photo = $filename;
        } elseif (!$volunteer->photo) {
            $volunteer->photo = "nopic.jpg";
        }

        $volunteer->alias       = $input['alias'];
        $volunteer->task        = $input['task'];
        $volunteer->description = $input['description'];
        $volunteer->publish     = Input::has('publish') && Input::get('publish') == "publish";

        if ($volunteer->save()) {
            Session::flash('success', 'volunteers.updated');
            return Redirect::action('VolunteersController@show', $volunteer->id);
        } else {
            Session::flash('danger', 'volunteers.error-saving');
            return Redirect::route('volunteers.edit', $volunteer->id)
            ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Volunteer $volunteer)
    {
        // This may be called from the UsersController when an admin deletes a user.
        if ($volunteer->photo and $volunteer->photo != 'nopic.jpg') {  // "Delete" the old file.
            $images_dir = public_path() ."/images/volunteers/";
            $thumbnails_dir  = public_path() ."/images/volunteerthumbs/";
            unlink($images_dir . $volunteer->photo);
            unlink($thumbnails_dir . $volunteer->photo);
        }
        $volunteer->delete();
        return;
    }


    // XXX Does this function actually belong here?
    public function resizeImage($input, $output, $new_width, $new_height)
    {
        // Get new dimensions
        list($original_width, $original_height) = getimagesize($input);
        if (($new_width > $original_width) and ($new_height > $original_height)) {  // Keep the original dimensions
            $new_width = $original_width;
            $new_height = $original_height;
        } else {  // Adjust the new dimensions to the picture's proportions
            $ratio = $original_width/$original_height;
            if ($new_width/$new_height > $ratio) {
                $new_width = $new_height*$ratio;
            } else {
                $new_height = $new_width/$ratio;
            }
        }

        // Resample
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($input);  // TODO: Add support for other file formats?
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

        // Output
        imagejpeg($image_p, $output, 80);

        // Free up memory
        imagedestroy($image_p);
    }

}

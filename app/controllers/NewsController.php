<?php

class NewsController extends BaseController
{
    /**
     * Show a listing of news.
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'DESC')->get();
        foreach ($news as $item)
            $item['pic'] = $item->pics()->orderBy(DB::raw('RAND()'))->first()['filename'];

        return View::make('news.index', [
            'news'  => $news,
            'title' => "news.all"
        ]);
    }


    /**
     * Show a news item.
     */
    public function show(News $news)
    {
        $pics = $news->pics()->get();
        return View::make('news.show', [
            'news'  => $news,
            'pics'  => $pics,
            'title' => $news->title
        ]);
    }


    /**
     * Show the create news form.
     */
    public function create()
    {
        return View::make('news.create', [
            'title' => "news.add"
        ]);
    }


    /**
     * Handle create form submission.
     */
    public function store()
    {
        $rules = [
            'title' => 'required',
            'body'  => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::action('NewsController@create')->withErrors($validator)->withInput();
        }

        $news = new News;
        $news->title = Input::get('title');
        $news->body  = Input::get('body');
        $news->save();

        if (Input::hasFile('photo') and Input::file('photo')->getMimeType() == "image/jpeg") {
            $images_dir = public_path() ."/images/newspics/";
            $thumbnails_dir  = public_path() ."/images/newsthumbs/";
            $filename = $news->id . '_' . str_random(6) . '.jpg';

            try {
                $movedfile = Input::file('photo')->move($images_dir, $filename);
                $this->resizeImage($images_dir . $filename, $thumbnails_dir . $filename, 320, 240);
                $this->resizeImage($images_dir . $filename, $images_dir . $filename, 960, 720);
            } catch(Exception $e) {
                die($e->getMessage());
            }

            $pic = new NewsPic();
            $pic->filename = $filename;
            $pic = $news->pics()->save($pic);
            //$pic->animal_id = $animal->id;
            //$pic->save();
        }

        return Redirect::action('NewsController@show', ['id' => $news->id]);
    }


    /**
     * Show the edit news form.
     */
    public function edit(News $news)
    {
        $pics = $news->pics()->get();
        return View::make('news.edit', [
            'news'  => $news,
            'pics'  => $pics,
            'title' => 'news.edition',
        ]);
    }


    /**
     * Handle edit form submission.
     */
    public function update()
    {
        $rules = [
            'title' => 'required',
            'body'  => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::action('NewsController@edit', ['id' => $input['id']])->withErrors($validator)->withInput();
        }

        $news = News::findOrFail(Input::get('id'));
        $news->title = Input::get('title');
        $news->body  = Input::get('body');
        $news->save();


        $images_dir = public_path() ."/images/newspics/";
        $thumbnails_dir  = public_path() ."/images/newsthumbs/";

        /* Delete the selected pictures */
        $picstodelete = Input::get('picstodelete');
        if (count($picstodelete) > 0) {
            foreach($picstodelete as $picId) {
                $pic = NewsPic::findOrFail($picId);
                unlink($images_dir . $pic->filename); // "Delete" the file.
                unlink($thumbnails_dir . $pic->filename);
                $pic->delete();
            }
        }

        /* And new picture */
        if (Input::hasFile('photo') and Input::file('photo')->getMimeType() == "image/jpeg") {
            $filename = $news->id . '_' . str_random(6) . '.jpg';

            try {
                $movedfile = Input::file('photo')->move($images_dir, $filename);
                $this->resizeImage($images_dir . $filename, $thumbnails_dir . $filename, 320, 240);
                $this->resizeImage($images_dir . $filename, $images_dir . $filename, 960, 720);
            } catch(Exception $e) {
                die($e->getMessage());
            }

            $pic = new NewsPic();
            $pic->filename = $filename;
            $pic = $news->pics()->save($pic);
        }

        return Redirect::action('NewsController@show', ['id' => $news->id]);
    }


    /**
     * Show delete confirmation page.
     */
    public function delete(News $news)
    {
        return View::make('news.delete', [
            'news'  => $news,
            'title' => 'news.removal'
        ]);
    }


    /**
     * Handle the delete confirmation.
     */
    public function destroy()
    {
        $id = Input::get('news');
        $news = News::findOrFail($id);

        $images_dir = public_path() ."/images/newspics/";
        $thumbnails_dir  = public_path() ."/images/newsthumbs/";
        $pics = NewsPic::whereNewsId($id)->get();
        foreach ($pics as $pic) {
            unlink($images_dir . $pic->filename); // "Delete" the file.
            unlink($thumbnails_dir . $pic->filename);
            $pic->delete();
        }

        $news->delete();
        return Redirect::action('NewsController@index');
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

        // Resample - This requires installing and enabling the php-gd module.
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($input);  // TODO: Add support for other file formats?
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

        // Output
        imagejpeg($image_p, $output, 80);

        // Free up memory
        imagedestroy($image_p);
    }
}


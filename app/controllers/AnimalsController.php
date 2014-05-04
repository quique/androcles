<?php

class AnimalsController extends BaseController
{
    public function create()
    {
        $species = array('' => 'Seleccione la especie') + Species::lists('name', 'id'); // TODO: i18n & l10n
        $sexes = Sex::lists('name', 'id');
        $colors = ['' => 'Seleccione el color'] + Color::lists('name', 'id');
        $coats = ['' => 'Seleccione el pelaje'] + Coat::lists('description', 'id');
        $statuses = ['' => 'Seleccione el estado'] + Status::lists('name', 'id');
        return View::make('animals.create', [
            'title'    => "Añadir un nuevo animal",
            'species'  => $species,
            'sexes'    => $sexes,
            'colors'   => $colors,
            'coats'    => $coats,
            'statuses' => $statuses
        ]);
    }


    public function saveCreate()
    {
        $input = Input::all();
        $rules = [
            'name'       => 'required',
            'species_id' => 'required',
            'color_id'   => 'required',
            'coat_id'    => 'required',
            'status_id'  => 'required',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::action('AnimalsController@create')->withErrors($validator)->withInput();
        }

        $animal = new Animal;
        $animal->name            = $input['name'];
        $animal->species_id      = $input['species_id'];
        $animal->breed           = $input['breed'];
        $animal->size            = $input['size'];
        $animal->weight          = $input['weight'];
        $animal->sex_id          = $input['sex_id'];
        $animal->neutered        = $input['neutered'];
        $animal->dateofbirth     = $input['dateofbirth'];
        $animal->dateofarrival   = $input['dateofarrival'];
        $animal->dateofexit      = $input['dateofexit'];
        $animal->color_id        = $input['color_id'];
        $animal->coat_id         = $input['coat_id'];
        $animal->status_id       = $input['status_id'];
        $animal->comments        = $input['comments'];
        $animal->youtube         = $input['youtube'];
        $animal->provenance      = $input['provenance'];
        $animal->deliverer       = $input['deliverer'];
        $animal->chipcode        = $input['chipcode'];
        $animal->vaccinations    = $input['vaccinations'];
        $animal->diseases        = $input['diseases'];
        $animal->surgeries       = $input['surgeries'];
        $animal->treatment       = $input['treatment'];
        $animal->privatecomments = $input['privatecomments'];
        $animal->save();

        if (Input::hasFile('photo') and Input::file('photo')->getMimeType() == "image/jpeg") {
            // $file = Input::file('photo');
            // $filename = $file->getClientOriginalName();
            // $extension = $file->getClientOriginalExtension();
            $images_dir = public_path() ."/images/animalpics/";
            $thumbnails_dir  = public_path() ."/images/animalthumbs/";
            $filename = $animal->id . '_' . str_random(6) . '.jpg';

            try {
                $movedfile = Input::file('photo')->move($images_dir, $filename);
                AnimalsController::resizeImage($images_dir . $filename, $thumbnails_dir . $filename, 320, 240);
                AnimalsController::resizeImage($images_dir . $filename, $images_dir . $filename, 960, 720);
            } catch(Exception $e) {
                die($e->getMessage());
            }

            $pic = new AnimalPic();
            $pic->filename = $filename;
            $pic->animal_id = $animal->id;
            $pic->save();
        }

        return Redirect::action('AnimalsController@readSingle', ['id' => $animal->id]);
    }


    public function read()
    {
        $animals = Animal::all();
        foreach ($animals as $animal) {
            $animal['pic'] = $animal->animal_pics()->orderBy(DB::raw('RAND()'))->first()['filename'];
            if (!$animal['pic'])
                $animal['pic'] = "nopic.jpg";
        }

        return View::make('animals.read', [
            'animals' => $animals,
            'title'   => "Todos los animales"]);
        // return View::make('animals.read', compact('animals'));
        // return View::make('animals.read')->with('animals', $animals);
    }

    public function readStatus($status)
    {
        if ($status == "up-for-adoption") {
            $animals = Animal::where('status_id', '<=', 10)->get();
            $title = "Animales en adopción";
        } elseif ($status == 'lost') {
            $animals = Animal::whereIn('status_id', [13, 25, 30])->get();
            $title = "Animales perdidos y encontrados";
        } elseif ($status == 'particular') {
            $animals = Animal::whereStatusId(14)->get();
            $title = "Animales de particulares";
        } elseif ($status == 'happy-endings') {
            $animals = Animal::whereBetween('status_id', [15, 20])->get();
            $title = "Finales felices";
        } elseif ($status == 'in-our-heart') {
            $animals = Animal::whereBetween('status_id', [35, 40])->get();
            $title = "Siempre en nuestro corazón";
        } else {
            return Redirect::action('AnimalsController@readStatus', "up-for-adoption");
        }

        foreach ($animals as $animal) {
            $animal['pic'] = $animal->animal_pics()->orderBy(DB::raw('RAND()'))->first()['filename'];
            if (!$animal['pic'])
                $animal['pic'] = "nopic.jpg";
        }

        return View::make('animals.read', [
            'animals' => $animals,
            'title'   => $title]);
    }

    public function readSingle(Animal $animal)
    {
        $pics = $animal->animal_pics()->get();
        return View::make('animals.readsingle', [
            'animal' => $animal,
            'pics'   => $pics,
            'title'  => "Información sobre $animal->name"]);
    }


    public function readStatusSpecies($status, $species)
    {
        if ($species == "dogs") {
            $animals = Animal::whereSpeciesId(1);
            $species_name = "Perros";
        } elseif ($species == "cats") {
            $animals = Animal::whereSpeciesId(2);
            $species_name = "Gatos";
        } else {
            $animals = Animal::where('species_id', '>', 2);
            $species_name = "Otros";
        }
        
        if ($status == "up-for-adoption") {
            $animals = $animals->where('status_id', '<=', 10)->get();
            $title = "$species_name en adopción";
        } elseif ($status == 'lost') {
            $animals = $animals->whereIn('status_id', [13, 25, 30])->get();
            $title = "$species_name perdidos y encontrados";
        } elseif ($status == 'particular') {
            $animals = $animals->whereStatusId(14)->get();
            $title = "$species_name de particulares";
        } elseif ($status == 'happy-endings') {
            $animals = $animals->whereBetween('status_id', [15, 20])->get();
            $title = "$species_name con final feliz";
        } elseif ($status == 'in-our-heart') {
            $animals = Animal::whereSpeciesId($species_id)->whereBetween('status_id', [35, 40])->get();
            $title = "$species_name en nuestro corazón";
        } else {
            return Redirect::action('AnimalsController@readStatus', "up-for-adoption");
        }

        foreach ($animals as $animal) {
            $animal['pic'] = $animal->animal_pics()->orderBy(DB::raw('RAND()'))->first()['filename'];
            if (!$animal['pic'])
                $animal['pic'] = "nopic.jpg";
        }

        return View::make('animals.read', [
            'animals' => $animals,
            'title' => $title]);
    }


    public function update($animal)
    {
        $animal_pics = $animal->animal_pics()->get();

        $species = array('' => 'Seleccione la especie') + Species::lists('name', 'id');
        $sexes = Sex::lists('name', 'id');
        $colors = ['' => 'Seleccione el color'] + Color::lists('name', 'id');
        $coats = ['' => 'Seleccione el pelaje'] + Coat::lists('description', 'id');
        $statuses = ['' => 'Seleccione el estado'] + Status::lists('name', 'id');

        return View::make('animals.update', [
            'animal'      => $animal,
            'animal_pics' => $animal_pics,
            'title'       => "Editar la información sobre $animal->name",
            'species'     => $species,
            'sexes'       => $sexes,
            'colors'      => $colors,
            'coats'       => $coats,
            'statuses'    => $statuses
        ]);
    }

    public function saveUpdate()
    {
        $input = Input::all();
        $rules = [
            'name'       => 'required',
            'species_id' => 'required',
            'color_id'   => 'required',
            'coat_id'    => 'required',
            'status_id'  => 'required',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::action('AnimalsController@update', ['id'=>$input['id']])->withErrors($validator)->withInput();
        }

        $animal = Animal::findOrFail($input['id']);
        $animal->name            = $input['name'];
        $animal->species_id      = $input['species_id'];
        $animal->breed           = $input['breed'];
        $animal->size            = $input['size'];
        $animal->weight          = $input['weight'];
        $animal->sex_id          = $input['sex_id'];
        $animal->neutered        = $input['neutered'];
        $animal->dateofbirth     = $input['dateofbirth'];
        $animal->dateofarrival   = $input['dateofarrival'];
        $animal->dateofexit      = $input['dateofexit'];
        $animal->color_id        = $input['color_id'];
        $animal->coat_id         = $input['coat_id'];
        $animal->status_id       = $input['status_id'];
        $animal->comments        = $input['comments'];
        $animal->youtube         = $input['youtube'];
        $animal->provenance      = $input['provenance'];
        $animal->deliverer       = $input['deliverer'];
        $animal->chipcode        = $input['chipcode'];
        $animal->vaccinations    = $input['vaccinations'];
        $animal->diseases        = $input['diseases'];
        $animal->surgeries       = $input['surgeries'];
        $animal->treatment       = $input['treatment'];
        $animal->privatecomments = $input['privatecomments'];
        $animal->save();

        
        $images_dir = public_path() ."/images/animalpics/";
        $thumbnails_dir  = public_path() ."/images/animalthumbs/";

        /* Delete the selected pictures */
        $picstodelete = Input::get('picstodelete');
        if (count($picstodelete) > 0) {
            foreach($picstodelete as $picId) {
                $pic = AnimalPic::findOrFail($picId);
                unlink($images_dir . $pic->filename); // "Delete" the file.
                unlink($thumbnails_dir . $pic->filename);
                $pic->delete();
            }
        }

        /* Add new picture */
        if (Input::hasFile('photo') and Input::file('photo')->getMimeType() == "image/jpeg") {
            $filename = $animal->id . '_' . str_random(6) . '.jpg';

            try {
                $movedfile = Input::file('photo')->move($images_dir, $filename);
                $this->resizeImage($images_dir . $filename, $thumbnails_dir . $filename, 320, 240);
                $this->resizeImage($images_dir . $filename, $images_dir . $filename, 960, 720);
            } catch(Exception $e) {
                die($e->getMessage());
            }

            $pic = new AnimalPic();
            $pic->filename = $filename;
            $pic->animal_id = $animal->id;
            $pic->save();
        }

        return Redirect::action('AnimalsController@readSingle', ['id' => $animal->id]);
    }


    public function delete(Animal $animal)
    {
        return View::make('animals.delete', [
            'animal' => $animal,
            'title'  => "Borrar animal",
        ]);
    }


    public function doDelete()
    {
        $animal = Animal::findOrFail(Input::get('id'));

        $images_dir = public_path() ."/images/animalpics/";
        $thumbnails_dir  = public_path() ."/images/animalthumbs/";
        $pics = AnimalPic::whereAnimalId(Input::get('id'))->get();
        foreach ($pics as $pic) {
            unlink($images_dir . $pic->filename); // "Delete" the file.
            unlink($thumbnails_dir . $pic->filename);
            $pic->delete();
        }
        
        $animal->delete();
        return Redirect::action('AnimalsController@read');
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

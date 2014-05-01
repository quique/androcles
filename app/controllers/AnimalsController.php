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
            //return Redirect::action('AnimalsController@create')->withErrors($validator)->withInput();
            return Redirect::to('animals/create')->withInput()->withErrors($validator);
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
            $destination_path = public_path() ."/images/animalpics/";
            $thumbnails_path  = public_path() ."/images/animalthumbs/";
            $destination_filename = $animal->id . '_' . str_random(6) . '.jpg';

            try {
                $movedfile = Input::file('photo')->move($destination_path, $destination_filename);
                AnimalsController::resizeImage($destination_path . $destination_filename, $thumbnails_path . $destination_filename, 320, 240);
                AnimalsController::resizeImage($destination_path . $destination_filename, $destination_path . $destination_filename, 960, 720);
            } catch(Exception $e) {
                die($e->getMessage());
            }

            $pic = new AnimalPic();
            $pic->filename = $destination_filename;
            $pic->animal_id = $animal->id;
            $pic->save();
        }

        return Redirect::action('AnimalsController@readSingle', ['id' => $animal->id]);
    }


    public function read()
    {
        $animals = Animal::all();
        foreach ($animals as $animal)
            $animal['pic'] = $animal->animal_pics()->orderBy(DB::raw('RAND()'))->first()['filename'];
        
        return View::make('animals.read', [
            'animals' => $animals,
            'title' => "Todos los animales"]);
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
            $animals = Animal::where('status_id', '<=', 10)->get();
            $title = "Animales en adopción";
        }

        foreach ($animals as $animal) {
            $animal['pic'] = $animal->animal_pics()->orderBy(DB::raw('RAND()'))->first()['filename'];
        }

        return View::make('animals.read', [
            'animals' => $animals,
            'title' => $title]);
    }

    public function readSingle($id)
    {
        $animal = Animal::find($id);
        $animal_pics = $animal->animal_pics()->get();
        return View::make('animals.readsingle', [
            'animal' => $animal,
            'animal_pics' => $animal_pics,
            'title'  => "Información sobre $animal->name"]);
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

        
        $destination_path = public_path() ."/images/animalpics/";
        $thumbnails_path  = public_path() ."/images/animalthumbs/";

        /* Delete the selected pictures */
        $picstodelete = isset($input['picstodelete']) ? $input['picstodelete'] : [];
        if (count($picstodelete) > 0) {
            foreach($picstodelete as $picId) {
                $pic = AnimalPic::findOrFail($picId);
                unlink($destination_path . $pic->filename); // "Delete" the file.
                unlink($thumbnails_path . $pic->filename);
                $pic->delete();
            }
        }

        /* Add new picture */
        if (Input::hasFile('photo') and Input::file('photo')->getMimeType() == "image/jpeg") {
            $destination_filename = $animal->id . '_' . str_random(6) . '.jpg';

            try {
                $movedfile = Input::file('photo')->move($destination_path, $destination_filename);
                AnimalsController::resizeImage($destination_path . $destination_filename, $thumbnails_path . $destination_filename, 320, 240);
                AnimalsController::resizeImage($destination_path . $destination_filename, $destination_path . $destination_filename, 960, 720);
            } catch(Exception $e) {
                die($e->getMessage());
            }

            $pic = new AnimalPic();
            $pic->filename = $destination_filename;
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

        $destination_path = public_path() ."/images/animalpics/";
        $thumbnails_path  = public_path() ."/images/animalthumbs/";
        $pics = AnimalPic::whereAnimalId(Input::get('id'))->get();
        foreach ($pics as $pic) {
            unlink($destination_path . $pic->filename); // "Delete" the file.
            unlink($thumbnails_path . $pic->filename);
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

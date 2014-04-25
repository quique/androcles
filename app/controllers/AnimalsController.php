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
            'title'    => "Add a new animal",
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
                AnimalsController::resizeImage($destination_path . $destination_filename, $thumbnails_path . $destination_filename, 240, 180);
                AnimalsController::resizeImage($destination_path . $destination_filename, $destination_path . $destination_filename, 720, 540);
            } catch(Exception $e) {
                die($e->getMessage());
            }

            $pic = new AnimalPic();
            $pic->filename = $destination_filename;
            $pic->animal_id = $animal->id;
            $pic->save();
        }

        return Redirect::action('AnimalsController@read'); // TODO: Redirect to the view of this animal.
    }


    public function read()
    {
        $animals = Animal::all();
        return View::make('animals.read', ['animals' => $animals, 'title' => "All animals"]);
        // return View::make('animals.read', compact('animals'));
        // return View::make('animals.read')->with('animals', $animals);
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

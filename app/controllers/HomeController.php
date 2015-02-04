<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

    /**
     * Show a listing of news, latest arrivals and latest adoptions.
     */
    public function index()
    {
        // News
        $news = News::orderBy('created_at', 'DESC')->take(3)->get();
        foreach ($news as $item)
            $item['pic'] = $item->pics()->orderBy(DB::raw('RAND()'))->first()['filename'];
            if (!$item['pic'])
                $item['pic'] = "nopic.jpg";

        // Latest arrivals
        $arrivals = Animal::where('status_id', '<=', 10)->orderBy('id', 'DESC')->take(3)->get();
        foreach ($arrivals as $animal) {
            $animal['pic'] = $animal->animal_pics()->orderBy(DB::raw('RAND()'))->first()['filename'];
            if (!$animal['pic'])
                $animal['pic'] = "nopic.jpg";
        }

        // Latest adoptions
        $adoptions = Animal::whereBetween('status_id', [15, 20])->orderBy('dateofexit', 'DESC')->take(3)->get();
        foreach ($adoptions as $animal) {
            $animal['pic'] = $animal->animal_pics()->orderBy(DB::raw('RAND()'))->first()['filename'];
            if (!$animal['pic'])
                $animal['pic'] = "nopic.jpg";
        }

        return View::make('hello', [
            'news'      => $news,
            'arrivals'  => $arrivals,
            'adoptions' => $adoptions,
            'shelter'   => Config::get('custom.shelter'),
            'motto'     => Config::get('custom.motto'),
            'title'     => Config::get('custom.shelter') ." - ". Config::get('custom.motto'),
        ]);
    }

}

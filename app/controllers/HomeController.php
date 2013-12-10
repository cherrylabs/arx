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

    // See {vendor/arx/core}/views/layouts/starter
    protected $layout = 'arx::layouts.starter';

	public function showWelcome()
	{

        $this->layout->nav = Lang::get('nav');

        $this->layout->project = Lang::get('project');

        $this->layout->content = View::make('home');
	}

}
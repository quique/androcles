<?php

use \Auth, \BaseController, \Form, \Input, \Redirect, \Sentry, \View;

class UsersController extends BaseController {

    /**
     * Instantiate a new UsersController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('hasAccess', array('except' => ['getLogin', 'postLogin', 'getLogout']));
        $this->beforeFilter('isGuest', ['only' => 'getLogin']);
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
     * Display the login page
     * @return View
     */
    public function getLogin()
    {
        return View::make('users.login')->with('title', "Inicio de sesión");
    }


    /**
     * Login action
     * @return Redirect
     */
    public function postLogin()
    {
        // Set login credentials
        $credentials = [
            'email'    => Input::get('email') ?: null,
            'password' => Input::get('password') ?: null
        ];

        $remember = Input::has('remember_me') and Input::get('remember_me') == 'remember_me';

        try {
            // Log the user in and send him where he wanted to go
            $user = Sentry::authenticate($credentials, $remember);
            if ($user)
                return Redirect::intended(URL::route('home'));
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $message = 'users.login-required';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $message = 'users.password-required';
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $message = 'users.user-not-found';
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $user = Sentry::getUserProvider()->findByLogin(Input::get('email'));
            // Email::queue($user, 'users.emailActivation', 'users.activation');
            $message = 'users.user-not-activated';
        }
        // This is a subclass of UserNotFoundException, so to be caught it should be moved up.
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            $message = 'users.wrong-password';
        }
        // The following is only needed if throttle is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
            $message = 'users.user-suspended';
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
            $message = 'users.user-banned';
        } catch(\Exception $e) {
            $message = $e->getMessage();
        }

        return Redirect::route('login')->withErrors(['login' => $message]);
    }


    /**
     * Logout action
     * @return Redirect
     */
    public function getLogout()
    {
        Sentry::logout();
        return Redirect::route('login');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::orderBy('email', 'ASC')->get();
        return View::make('users.index', [
            'users' => $users,
            'title' => "users.all"
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('users.create')->with('title', "users.add");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $rules = [
            'first_name' => 'required',
            'email'      => 'required|email',
            'password'   => 'required|confirmed',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::action('UsersController@create')->withErrors($validator)->withInput();
        }

        try {
            Sentry::getUserProvider()->create(array(
                'email'       => $input['email'],
                'password'    => $input['password'],
                'first_name'  => $input['first_name'],
                'last_name'   => $input['last_name'],
                'activated'   => 1,
            ));
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            return Redirect::action('UsersController@create')->withErrors(['email' => 'users.user-exists'])->withInput();
        }

        return Redirect::action('UsersController@index'); // @show', ['id' => $user->id]);
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
    public function edit($id)
    {
        return View::make('users.edit', [
            'user'  => $id,
            'title' => 'users.edition',
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::all();
        $rules = [
            'first_name' => 'required',
            'email'      => 'required|email|unique:users,email,'.$id->id,
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::route('users.edit', $input['id'])->withErrors($validator)->withInput();
        }

        try {
            // Update the user details
            $id->first_name = $input['first_name'];
            $id->last_name = $input['last_name'];
            $id->email = $input['email'];
            // Update the user
            if ($id->save()) {
                    // User information was updated
            } else {
                    // User information was not updated
            }
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            return Redirect::action('UsersController@edit', $id)->withErrors(['email' => 'users.user-exists'])->withInput();
        }
        return Redirect::route('users.index');
    }


    /**
     * Show delete confirmation page.
     */
    public function delete($id)
    {
        return View::make('users.delete', [
            'user'  => $id,
            'title' => 'users.removal'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // TODO: Evitar que el admin se pueda borrar a sí mismo?
        try {
            $id->delete;
        } catch (Exception $e) {
            //
        }
        return Redirect::route('users.index');
    }

}

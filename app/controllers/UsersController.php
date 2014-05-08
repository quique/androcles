<?php

use Auth, BaseController, Form, Input, Redirect, Sentry, View;

class UsersController extends BaseController {

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
                return Redirect::intended(URL::route('root'));
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

}

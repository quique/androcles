<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
        try {
            // Find the user using the user email address
            $email = Input::get('email');
            $user = Sentry::findUserByLogin($email);

            // Get the password reset code
            $resetCode = $user->getResetPasswordCode();

            // Send this code to the user via email    FIXME: La plantilla no está internacionalizada
            Mail::send('emails.auth.reminder', ['token' => $resetCode], function($message) use ($user)
            {
                $message->to($user->email, $user->first_name .' '. $user->last_name)->subject(trans('users.password-reset'));
            });
            return Redirect::back()->with('info', 'users.reminder-sent');
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::back()->with('warning', 'users.user-not-found');
        }
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
        $email = Input::get('email');
        $token = Input::get('token');
        $password = Input::get('password');
        try {
            // Find the user using the user email address
            $user = Sentry::findUserByLogin($email);

            // Check if the reset password code is valid
            if ($user->checkResetPasswordCode($token)) {
                // Attempt to reset the user password
                if ($user->attemptResetPassword($token, $password)) {
                    // Password reset passed
                    return Redirect::route('home')->with('success', 'users.password-changed');
                } else {
                    // Password reset failed
                    return Redirect::route('home')->with('danger', 'users.reset-failed');
                }
            } else {
                // The provided password reset code is invalid
                return Redirect::route('home')->with('warning', 'users.invalid-code');
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::back()->with('warning', 'users.user-not-found');
        }
	}

}

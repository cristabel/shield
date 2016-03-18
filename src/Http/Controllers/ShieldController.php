<?php namespace Cristabel\Shield\Http\Controllers;

use Cristabel\Http\Controllers\Controller;
use Cristabel\Shield\Http\Requests\LoginRequest;

use Cristabel\Shield\ShieldGuard as Guard;
use Config;

class ShieldController extends Controller {

	protected $auth;

	protected $redirectAfterLogout;
	protected $redirectPath;
	protected $loginPath;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;

		$this->redirectAfterLogout = Config::get('cristabel.shield.redirect_after_logout');
		$this->redirectPath = Config::get('cristabel.shield.redirect_path');
		$this->loginPath = Config::get('cristabel.shield.login_path');
	}

	/**
	 * Show login application.
	 */
	public function getIndex()
	{
		return view('shield::index');
	}

	/**
	 * Show login application.
	 */
	public function getLogin()
	{
		return redirect('shield');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  Cristabel\Shield\Http\Requests\LoginRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(LoginRequest $request)
	{
		$credentials = $request->only('email', 'password');
		if ( $this->auth->attempt($credentials, $request->has('remember')) ) {
			return redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => 'These credentials do not match our records.',
					]); 
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();

		return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
	}

	protected function redirectPath()
	{
		return $this->redirectPath;
	}

	protected function loginPath()
	{
		return $this->loginPath;
	}

}

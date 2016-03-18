<?php namespace Cristabel\Shield\Http\Controllers;

use Cristabel\Http\Controllers\Controller;

use Cristabel\Shield\Http\Requests\ProfileRequest;

use Cristabel\Shield\Domain\Repository\UserAdministratorRepository;
use Cristabel\Shield\ShieldGuard as Guard;

class ProfileController extends Controller {

	protected $auth;

	protected $repository;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth, UserAdministratorRepository $repository)
	{
		$this->auth = $auth;

		$this->repository = $repository;
	}

	public function getIndex()
	{
		return view('shield::profile');
	}

	public function postSave(ProfileRequest $request)
	{
		$errors = [];
		try {
			$profile = $this->repository->getProfile( $request->only('email') );
			if( is_null($profile) ) {
				throw new Exception("User not found", 1);
			}

			$params = $request->all();
			if( !strlen($request->has('password')) ) {
				unset($params['password']);
			}

			$profile->fill($params);
			$profile->update();

			$errors['message'] = 'Profile updated!';
		} catch (Exception $e) {
			$errors['message'] = $e->getMessage();
		}

		return redirect()->back()->with($errors);
	}

}

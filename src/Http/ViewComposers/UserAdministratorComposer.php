<?php namespace Cristabel\Shield\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;

use ShieldAuth;

class UserAdministratorComposer {

    /**
     *
     * @var $user
     */
    protected $user;

    /**
     * Create a new layout composer.
     *
     * @param  Config  $config
     * @return void
     */
    public function __construct()
    {
        $this->user = ShieldAuth::user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('user', $this->user);
    }

}

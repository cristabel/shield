<?php namespace Cristabel\Shield;

use Illuminate\Auth\Guard;

class ShieldGuard extends Guard {

    public function getName()
    {
        return 'login_admin_'.md5(get_class($this));
    }

    public function getRecallerName()
    {
        return 'remember_admin_'.md5(get_class($this));
    }

}

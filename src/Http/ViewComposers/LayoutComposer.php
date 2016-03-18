<?php namespace Cristabel\Shield\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Config;

class LayoutComposer {

    /**
     *
     * @var layout
     */
    protected $layout;

    /**
     * Create a new layout composer.
     *
     * @param  Config  $config
     * @return void
     */
    public function __construct(Config $config)
    {
        $this->layout = $config::get('cristabel.shield.layout');
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('layout', $this->layout);
    }

}

<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;
use Modules\Backend\Entities\Page;

class About extends Component
{
    public $padding;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($padding=null)
    {
        $this->padding = $padding;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $about = Page::find(1);
        return view('components.frontend.about',compact('about'));
    }
}

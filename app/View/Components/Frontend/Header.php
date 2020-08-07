<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;
use Modules\Backend\Entities\Category;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $categories = Category::allCategories();
        return view('components.frontend.header',compact('categories'));
    }
}

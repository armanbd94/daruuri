<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;
use Modules\Backend\Entities\Brand;

class SearchForm extends Component
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
        $brands = Brand::allBrands();
        return view('components.frontend.search-form',compact('brands'));
    }
}

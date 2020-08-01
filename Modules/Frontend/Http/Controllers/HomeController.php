<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class HomeController extends BaseController
{

    public function index()
    {
        $this->setPageData('Home','Home');
        return view('frontend::home.home');
    }

    public function about()
    {
        $this->setPageData('About','About');
        return view('frontend::about.about');
    }

    public function service()
    {
        $this->setPageData('Service','Service');
        return view('frontend::service.service');
    }

   
}

<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class FrontendBaseController extends Controller
{
    /**
     * @param $title
     * @param $subTitle
     */
    protected function setPageData($page_title, $sub_title, $page_icon=null)
    {
        view()->share(['page_title' => $page_title, 'sub_title' => $sub_title, 'page_icon' => $page_icon]);
    }
}

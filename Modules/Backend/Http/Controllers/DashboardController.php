<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Entities\Brand;
use Modules\Backend\Entities\Method;
use Modules\Backend\Entities\Product;
use Modules\Backend\Entities\Review;
use Modules\Backend\Entities\Service;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        view()->share(['page_title' => 'Dashboard', 'sub_title' => 'Dashboard', 'page_icon' => 'fas fa-home']);
        $data['total_brands'] = Brand::allBrands()->count();
        $data['total_services'] = Service::allServices()->count();
        $data['total_products'] = Product::toBase()->select('id')->count();
        $data['total_feedbacks'] = Review::toBase()->select('id')->count();
        // dd($data);
        return view('backend::home',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function unauthorized()
    {
        view()->share(['page_title' => 'Unauthorized', 'sub_title' => 'Unauthorized Access Blocked', 'page_icon' => 'fas fa-ban']);
        return view('backend::unauthorized');
    }

    
}

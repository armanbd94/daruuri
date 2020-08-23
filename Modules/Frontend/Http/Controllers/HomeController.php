<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Backend\Entities\HighlightedService;
use Modules\Backend\Entities\Page;
use Modules\Frontend\Http\Controllers\FrontendBaseController;
use Modules\Backend\Entities\Phone;
use Modules\Backend\Entities\Product;
use Modules\Backend\Entities\Slider;

class HomeController extends FrontendBaseController
{


    public function index()
    {
        $this->setPageData('Home','Home');
        $data['sliders']  = Slider::allSliderImages();
        $data['products'] = Product::with('brand:id,brand_name')->where('status',1)->inRandomOrder()->limit(8)->get();
        return view('frontend::home.home',compact('data'));
    }

    public function about()
    {
        $this->setPageData('About','About');
        return view('frontend::about.about');
    }

    public function service()
    {
        $this->setPageData('Service','Service');
        $services = Page::hardwareSoftwareService();
        return view('frontend::service.service',compact('services'));
    }

    public function brandWisePhone(Request $request)
    {
        if ($request->ajax()) {
           $phones =  Phone::brandWisePhone($request->brand_id);
            $output = '<option value="">Select Please</option>';
            if($phones->count()){
                foreach ($phones as $value) {
                    $output .= "<option value='".$value->id."'>".$value->phone_name."</option>";
                }
            }
            return response()->json($output);
        }
    }

    public function phoneWiseService(Request $request)
    {
        if ($request->ajax()) {
            $phones =  Phone::with(['brand:id,brand_name','services'])->find($request->phone_id);
            $output = view('frontend::phone-service',compact('phones'))->render();
            return response()->json($output);
        }
    }

   
}

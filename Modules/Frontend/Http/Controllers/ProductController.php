<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Backend\Entities\Brand;
use Modules\Frontend\Http\Controllers\FrontendBaseController;
use Modules\Backend\Entities\Product;

class ProductController extends FrontendBaseController
{
    public function index(string $category)
    {
        if($category){
            $page_title = ucwords(str_replace('-',' ',$category));
            $this->setPageData($page_title,$page_title);
            $brands = Brand::allBrands();
            return view('frontend::product.index',compact('category','brands'));
        }else{
            return redirect()->back();
        }
    }

    public function product_list(Request $request)
    {
        $category   = $request->category;
        $phone      = $request->phone;
        $brand_name = $request->brand_text;
        $products   = Product::with(['brand:id,brand_name','category:id,category_name,category_slug'])
        ->where('status',1)
        ->whereHas('category',function($query) use ($category){
            $query->where('category_slug',$category);
        })
        ->when($request->brand_id, function($query) use ($request){
            return $query->where('brand_id',$request->brand_id);
        })->when($request->phone, function($query) use ($request){
            return $query->where('product_name','LIKE',"%{$request->phone}%");
        })->paginate(15);
        $output     = view('frontend::product.list',compact('products','phone','brand_name'))->render();
        return response()->json($output);
    }

    
}

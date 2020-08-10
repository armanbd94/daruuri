<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Modules\Backend\Entities\Product;
use Modules\Backend\Entities\Brand;
use Modules\Backend\Entities\Category;
use Validator;
use App\Traits\UploadAble;
class ProductController extends BaseController
{
    use UploadAble;
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        if (permission('product-access')){
            $this->setPageData('Product','Product','fab fa-product-hunt');
            $data['brands'] = Brand::allBrands();
            $data['categories'] = Category::allCategories();
            return view('backend::product.index',compact('data'));
        }else{
            return $this->access_blocked();
        }
    }

    public function getList(Request $request)
    {
        if($request->ajax()){
            if (permission('product-access')){
                if(!empty($request->brand_id)){
                    $this->model->setBrandID($request->brand_id);
                }
                if(!empty($request->category_id)){
                    $this->model->setCategoryID($request->category_id);
                }
                if(!empty($request->product_name)){
                    $this->model->setProductName($request->product_name);
                }
                if(!empty($request->status)){
                    $this->model->setStatus($request->status);
                }
                
                $this->model->setOrderValue($request->input('order.0.column'));
                $this->model->setDirValue($request->input('order.0.dir'));
                $this->model->setLengthValue($request->input('length'));
                $this->model->setStartValue($request->input('start'));
        
                $list   = $this->model->getList();
                $data   = array();
                $no     = $request->input('start');
                foreach ($list as $value) {
                    $no++;
                    $action = '';
                    if (permission('product-edit')){
                    $action .= '<li class="kt-nav__item"><a class="kt-nav__link edit_data" data-id="' . $value->id . '" >'.EDIT_ICON.'</a></li>';
                    }
                    if (permission('product-view')){
                    $action .= '<li class="kt-nav__item"><a class="kt-nav__link view_data" data-id="' . $value->id . '" >'.VIEW_ICON.'</a></li>';
                    }
                    if (permission('product-delete')){
                    $action .= '<li class="kt-nav__item"><a class="kt-nav__link delete_data" data-id="'.$value->id .'" >'.DELETE_ICON.'</a></li>';
                    }
                    $btngroup = '<span style="overflow: visible; position: relative;">   
                                    <div class="dropdown"> 
                                        <a data-toggle="dropdown" class="btn btn-sm btn-clean btn-icon btn-icon-lg cursor-pointer"> <i class="flaticon-more-1 text-brand"></i> </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="kt-nav">
                                                '.$action.'
                                            </ul>
                                        </div>
                                    </div>
                                </span>';
        
        
                    $row    = array();
                    if (permission('product-bulk-action-delete')){
                    $row[]  = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid"><input type="checkbox" name="did[]" value="' . $value->id . '" class="select_data select_item_' . $value->id . '" onchange="select_single_item(' . $value->id . ')">&nbsp;<span></span></label> ';
                    }
                    $row[]  = $no;
                    $row[]  = "<img src='storage/".PRODUCT.$value->product_image."' alt='".$value->product_name."' style='width:50px;'/>";
                    $row[]  = $value->product_name;
                    $row[]  = $value->brand->brand_name;
                    $row[]  = $value->category->category_name;
                    $row[]  = BUTTON_STATUS[$value->status];
                    $row[]  = $btngroup;
                    $data[] = $row;
        
                }
                $output = $this->dataTableDraw($request->input('draw'),$this->model->count_all(),$this->model->count_filtered(), $data);
                echo json_encode($output);
            }
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()){
            if (permission('product-add') || permission('product-edit')){
                $rules = $this->model::VALIDATION_RULES;
                $message = $this->model::MESSAGE;
                if(!empty($request->update_id)){
                    $rules['product_name'][2]  = 'unique:products,product_name,'.$request->update_id;
                    $rules['product_image'][0] = 'nullable';
                }
                $validator = Validator::make($request->all(), $rules, $message);
                if ($validator->fails()) {
                    $output = array(
                        'errors' => $validator->errors()
                    );
                } else {
                    
                    $collection = collect($request->all())->only(['brand_id','category_id','product_name',
                    'description','status']);
                    $product_image = $request->old_product_image;
                    if($request->hasFile('product_image')){
                        $product_image = $this->upload_file($request->file('product_image'),PRODUCT);
                        if(!empty($request->old_product_image)){
                            $this->delete_file($request->old_product_image, PRODUCT);
                        }
                    }
                    $created_at = $updated_at = DATETIME;
                    $collection = $collection->merge(compact('product_image','updated_at'));
                    if(empty($request->update_id)){
                        $collection = $collection->merge(compact('created_at'));
                    }
                    $result = $this->model->updateOrInsert(['id' => $request->update_id],$collection->all());
                    if($result){
                        $output = $this->success_status();
                    }else{
                        if($request->hasFile('product_image')){
                            if($product_image != $request->old_product_image){
                                $this->delete_file($product_image, PRODUCT);
                            }
                        }
                        $output = $this->error_status();
                    }
                }
                return response()->json($output);
            }
        }
    }

    public function show(Request $request){
        if($request->ajax()){
            if (permission('product-view')){
                $product = $this->model->with(['brand:id,brand_name','category:id,category_name'])->find($request->id);
                if($product){
                    $output['product'] = view('backend::product.details',compact('product'))->render();
                    $output['product_name'] = $product->product_name;
                }else{
                    $output = $this->error_status();
                }
                return response()->json($output);
            }
        }
    }

    public function edit(Request $request){
        if($request->ajax()){
            if (permission('product-edit')){
                $result = $this->model->with(['brand:id,brand_name','category:id,category_name'])->find($request->id);
                if($result){
                    $output['product'] = $result;
                }else{
                    $output = $this->error_status();
                }
                return response()->json($output);
            }
        }
    }

    public function destroy(Request $request)
    {
        if($request->ajax()){
            if (permission('product-delete')){
                $result = $this->model->find($request->id);
                if($result->product_image){
                    $this->delete_file($request->product_image, PRODUCT);
                }
                if($result->delete()){
                    $output = $this->success_status();
                }else{
                    $output = $this->error_status();
                }
                return response()->json($output);
        }
        }
    }

    public function bulk_action_delete(Request $request)
    {
        if($request->ajax()){
            if (permission('product-bulk-action-delete')){
                try {
                    $products = $this->model->toBase()->select('product_image')->whereIn('id',$request->id)->get();
                    $result = $this->model->destroy($request->id);
                    if($result){
                        if(!empty($products)){
                            foreach ($products as $product) {                   
                                if($product->product_image != null)
                                {
                                    $this->delete_file($product->product_image,PRODUCT);    
                                }
                            }
                        }
                        $output = $this->success_status();
                    }else{
                        $output = $this->error_status();
                    }
                } catch (\Throwable $e) {
                    $output = ['status' => 'error','message'=> $e->getMessage()];
                }
                return response()->json($output);
            }
        }
    }
}

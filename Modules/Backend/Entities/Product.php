<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['brand_id','category_id','product_name','product_image','description','status'];

    /*******************************
    * ! Begin :: Validation Rules ! 
    ********************************/
    public const VALIDATION_RULES = [
        'brand_id'      => ['nullable','integer'],
        'category_id'   => ['required','integer'],
        'product_name'  => ['required','string','unique:products,product_name'],
        'product_image' => ['required','image','mimes:svg,png,jpg,jpeg'],
        'description'   => ['nullable','string'],
        'status'        => ['required','integer']
    ];
    public const MESSAGE = [
        'brand_id.required'    => 'The brand name field is required',
        'brand_id.integer'     => 'The brand name field must be brand id',
        'category_id.required' => 'The category name field is required',
        'category_id.integer'  => 'The category name field must be category id',
    ];
    /*******************************
    * ! End :: Validation Rules ! 
    ********************************/

    /**************************************
    * ?  Begin :: Model Relationship  ? 
    ***************************************/
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /************************************
    * ?   End :: Model Relationship   ? 
    *************************************/

    /**********************************
    * *   Begin :: Datatable Data   * *
    ***********************************/

    private $order = array('products.id' => 'desc'); //set column order by
    private $column_order; //set data table column sorting key
    

    //Start :: Custom Property
    private $brandID;
    private $categoryID;
    private $productName;
    private $status;
    //End :: Custom Property

    //Start :: Default Property
    private $orderValue;
    private $dirValue;
    private $startValue;
    private $lengthValue;
    //End :: Default Property

    //Start :: Set custom properties value methods 
    public function setBrandID($brandID)
    {
        $this->brandID = $brandID;
    }
    public function setCategoryID($categoryID)
    {
        $this->categoryID = $categoryID;
    }
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    //Start :: Set custom properties value methods

    //Start :: Set default properties value methods [Do Not Touch This Section]
    public function setOrderValue($orderValue)
    {
        $this->orderValue = $orderValue;
    }
    public function setDirValue($dirValue)
    {
        $this->dirValue = $dirValue;
    }
    public function setLengthValue($lengthValue)
    {
        $this->lengthValue = $lengthValue;
    }
    public function setStartValue($startValue)
    {
        $this->startValue = $startValue;
    }
    //End :: Set default properties value methods


    private function _get_datatables_query()
    {
        if (permission('product-bulk-action-delete')){
            $this->column_order = array('','products.id', '', 'products.product_name', 'products.brand_id',
            'products.category_id','products.status', '');
        }else{
            $this->column_order = array('products.id', '', 'products.product_name', 'products.brand_id',
            'products.category_id','products.status', '');
        }
        
        $query = self::with(['brand:id,brand_name','category:id,category_name']);

        if (!empty($this->brandID)) {
            $query->where('products.brand_id', $this->brandID);
        }
        if (!empty($this->categoryID)) {
            $query->where('products.category_id', $this->categoryID);
        }
        if (!empty($this->productName)) {
            $query->where('products.product_name', 'like','%'.$this->productName.'%');
        }
        if (!empty($this->status)) {
            $query->where('products.status', $this->status);
        }

        //Do Not Touch This Block Section
        /********************************/
        if (isset($this->orderValue) && isset($this->dirValue)){ 
            // here order processing
            $query->orderBy($this->column_order[$this->orderValue], $this->dirValue);
        } else if (isset($this->order)) {
            $order = $this->order;
            $query->orderBy(key($order), $order[key($order)]);
        }
        /********************************/

        return $query;

    }

    public function getList()
    {
        $query = $this->_get_datatables_query();
        if ($this->lengthValue != -1)
            $query->offset($this->startValue)->limit($this->lengthValue);
        return $query = $query->get();

    }

    public function count_filtered()
    {
        $query = $this->_get_datatables_query();
        return $query->get()->count();
    }

    public function count_all()
    {
        return self::toBase()->select('id')->get()->count();
    }
    /********************************
    * *   End :: Datatable Data   * *
    *********************************/



}

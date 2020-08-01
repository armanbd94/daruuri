<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Phone extends Model
{
    protected $fillable = ['brand_id','phone_name','status'];

    /*******************************
    * ! Begin :: Validation Rules ! 
    ********************************/
    public const VALIDATION_RULES = [
        'brand_id'     => ['required','integer'],
        'phone_name'   => ['required','string','unique:phones,phone_name'],
        'status'       => ['required','integer']
    ];
    public const MESSAGE = [
        'brand_id.required' => 'The brand name field is required',
        'brand_id.integer'  => 'The brand name field must be brand id',
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
    public function services()
    {
        return $this->belongsToMany(Service::class)->withTimestamps()->withPivot('price');
    }
    /************************************
    * ?   End :: Model Relationship   ? 
    *************************************/

    /**********************************
    * *   Begin :: Datatable Data   * *
    ***********************************/

    private $order = array('phones.id' => 'desc'); //set column order by
    private $column_order; //set data table column sorting key
    

    //Start :: Custom Property
    private $brandID;
    private $phoneName;
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
        $this->brandID    = $brandID;
    }
    public function setPhoneName($phoneName)
    {
        $this->phoneName  = $phoneName;
    }
    public function setStatus($status)
    {
        $this->status     = $status;
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

        $this->column_order = array('','phones.id', 'phones.brand_id', 'phones.phone_name','phones.status', '');
        $query = self::with('brand:id,brand_name');

        if (!empty($this->brandID)) {
            $query->where('phones.brand_id', 'like','%'.$this->brandID.'%');
        }
        if (!empty($this->phoneName)) {
            $query->where('phones.phone_name', 'like','%'.$this->phoneName.'%');
        }
        if (!empty($this->status)) {
            $query->where('phones.status', $this->status);
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
        return self::with('brand:id,brand_name')->get()->count();
    }
    /********************************
    * *   End :: Datatable Data   * *
    *********************************/

    /*********************************************
    * TODO =  Begin :: Custom Search Data = TODO *
    **********************************************/

    public static function brandWisePhone(int $brand_id){
        return self::toBase()->select('id','phone_name')
                            ->where(['brand_id' => $brand_id,'status'=> 1])
                            ->orderBy('name','asc')->get();
    }
    /*******************************************
    * TODO =  End :: Custom Search Data = TODO *
    ********************************************/
}

<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Service extends Model
{
    protected $fillable = ['service_name','service_icon','status'];

    protected const CACHE_NAME    = '_services';

    /*******************************
    * ! Begin :: Validation Rules ! 
    ********************************/
    public const VALIDATION_RULES = [
        'service_name' => ['required','string','unique:services,service_name'],
        'service_icon' => ['required','image','mimes:svg,png'],
        'status'       => ['required','integer']
    ];
    /*******************************
    * ! End :: Validation Rules ! 
    ********************************/

    /**************************************
    * ?  Begin :: Model Relationship  ? 
    ***************************************/
    public function phones()
    {
        return $this->belongsToMany(Phone::class)->withTimestamps()->withPivot('price');
    }

    /************************************
    * ?   End :: Model Relationship   ? 
    *************************************/

    /**********************************
    * *   Begin :: Datatable Data   * *
    ***********************************/

    private $order = array('id' => 'desc'); //set column order by
    private $column_order; //set data table column sorting key
    

    //Start :: Custom Property
    private $serviceName;
    private $status;
    //End :: Custom Property

    //Start :: Default Property
    private $orderValue;
    private $dirValue;
    private $startValue;
    private $lengthValue;
    //End :: Default Property

    //Start :: Set custom properties value methods 
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;
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

        $this->column_order = array('','id', '', 'service_name', 'status', '');
        $query = self::toBase()->select('id','service_name', 'service_icon','status');

        if (!empty($this->serviceName)) {
            $query->where('service_name', 'like','%'.$this->serviceName.'%');
        }
        if (!empty($this->status)) {
            $query->where('status', $this->status);
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
        return self::toBase()->select('id','service_name', 'service_icon','status')->get()->count();
    }
    /********************************
    * *   End :: Datatable Data   * *
    *********************************/

    /*************************************
    * TODO =  Begin :: Cache Data = TODO *
    **************************************/

    public static function allServices(){
        return Cache::rememberForever(self::CACHE_NAME, function () {
            return self::toBase()->select('id','service_name')->where('status',1)->orderBy('service_name','asc')->get();
        });
    }

    public static function flushCache(){
        Cache::forget(self::CACHE_NAME);
    }

    public static function boot(){
        parent::boot();

        static::updated(function () {
            self::flushCache();
        });

        static::created(function() {
            self::flushCache();
        });

        static::deleted(function() {
            self::flushCache();
        });
    }
    /***********************************
    * TODO =  End :: Cache Data = TODO *
    ************************************/
}

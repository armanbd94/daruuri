<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
class HighlightedService extends Model
{
    protected $fillable = ['service_name','image','description','sorting'];

    /*******************************
    * ! Begin :: Validation Rules ! 
    ********************************/
    public const VALIDATION_RULES = [
        'service_name'=> ['required','string','unique:highlighted_services,service_name'],
        'image'       => ['required','image','mimes:svg,png,jpg,jpeg,webp'],
        'description' => ['nullable','string'],
        'sorting'     => ['required','integer']
    ];
    /*******************************
    * ! End :: Validation Rules ! 
    ********************************/

    /**********************************
    * *   Begin :: Datatable Data   * *
    ***********************************/

    private $order = array('id' => 'desc'); //set column order by
    private $column_order; //set data table column sorting key
    

    //Start :: Custom Property
    private $service_name;
    //End :: Custom Property

    //Start :: Default Property
    private $orderValue;
    private $dirValue;
    private $startValue;
    private $lengthValue;
    //End :: Default Property

    //Start :: Set custom properties value methods 
    public function setServiceName($service_name)
    {
        $this->service_name = $service_name;
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
        if (permission('highlighted-service-bulk-action-delete')) {
            $this->column_order = array('','id', '', 'service_name','description','sorting', '');
        } else {
            $this->column_order = array('id', '', 'service_name','description','sorting', '');
        }
        
        $query = self::toBase()->select('id','service_name', 'image','description','sorting');

        if (!empty($this->service_name)) {
            $query->where('service_name', 'like','%'.$this->service_name.'%');
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
        return self::toBase()->get()->count();
    }
    /********************************
    * *   End :: Datatable Data   * *
    *********************************/


    /*************************************
    * TODO =  Begin :: Cache Data = TODO *
    **************************************/
    protected const CACHE_NAME    = '_highlighted_services';
    
    public static function allHighlightedServices(){
        return Cache::rememberForever(self::CACHE_NAME, function () {
            return self::toBase()->select('id','service_name','image','description','sorting')->orderBy('sorting','asc')->get();
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

<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Slider extends Model
{
    protected $fillable = ['title','sub_title','image','button_link','sorting'];

    /*******************************
    * ! Begin :: Validation Rules ! 
    ********************************/
    public const VALIDATION_RULES = [
        'title'       => ['required','string'],
        'sub_title'   => ['required','string'],
        'image'       => ['required','image','mimes:svg,png,jpg,jpeg'],
        'button_link' => ['nullable','string'],
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
    private $title;
    //End :: Custom Property

    //Start :: Default Property
    private $orderValue;
    private $dirValue;
    private $startValue;
    private $lengthValue;
    //End :: Default Property

    //Start :: Set custom properties value methods 
    public function setTitle($title)
    {
        $this->title = $title;
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

        $this->column_order = array('','id', '', 'title', 'sub_title','button_link','sorting', '');

        $query = self::toBase()->select('id','title','sub_title','image','button_link','sorting');

        if (!empty($this->title)) {
            $query->where('title', 'like','%'.$this->title.'%');
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
    protected const CACHE_NAME    = '_sliders';
    
    public static function allSliderImages(){
        return Cache::rememberForever(self::CACHE_NAME, function () {
            return self::toBase()->select('id','title','sub_title','image','button_link','sorting')->orderBy('sorting','asc')->get();
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

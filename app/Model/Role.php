<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Role extends Model
{
    protected $fillable = ['role'];

    protected const CACHE_NAME    = '_roles';

    /*******************************
    * ! Begin :: Validation Rules ! 
    ********************************/
    public const VALIDATION_RULES = [
        'role' => ['required','string','unique:roles,role']
    ];
    /*******************************
    * ! End :: Validation Rules ! 
    ********************************/

    public function users() {
        return $this->hasMany(User::class);
    }

    public function roleModulePermission() {
        return $this->hasMany('Modules\Backend\Entities\RoleModulePermission');
    }
    public function roleMethodPermission() {
        return $this->hasMany('Modules\Backend\Entities\RoleMethodPermission');
    }
    /***********************************************
     * ==== Start :: DataTable Server Side ==== *
     **********************************************/
    
    private $order = array('id' => 'desc'); //set column order by
    private $column_order; //set data table column sorting key

    //Start :: Custom Property
    private $_roleName;

    //End :: Custom Property

    //Start :: Default Property
    private $_orderValue;
    private $_dirValue;
    private $_startValue;
    private $_lengthValue;
    //End :: Default Property

    //Start :: Set custom properties value methods 
    public function setRoleName($roleName)
    {
        $this->_roleName = $roleName;
    }
    //Start :: Set custom properties value methods

    //Start :: Set default properties value methods [Do Not Touch This Section]
    public function setOrderValue($orderValue)
    {
        $this->_orderValue = $orderValue;
    }
    public function setDirValue($dirValue)
    {
        $this->_dirValue = $dirValue;
    }
    public function setLengthValue($lengthValue)
    {
        $this->_lengthValue = $lengthValue;
    }
    public function setStartValue($startValue)
    {
        $this->_startValue = $startValue;
    }
    //End :: Set default properties value methods


    private function _get_datatables_query()
    {

            $this->column_order = array('','id', 'role', '');
        $query = self::toBase()->where('id','!=',1);

        if (!empty($this->_roleName)) {
            $query->where('role', 'like','%'.$this->_roleName.'%');
        }

        //Do Not Touch This Block Section
        /********************************/
        if (isset($this->_orderValue) && isset($this->_dirValue)) // here order processing
        {
            $query->orderBy($this->column_order[$this->_orderValue], $this->_dirValue);

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
        if ($this->_lengthValue != -1)
            $query->offset($this->_startValue)->limit($this->_lengthValue);
        return $query = $query->get();

    }

    public function count_filtered()
    {
        $query = $this->_get_datatables_query();
        $query = $query->get();
        return $query->count();
    }

    public function count_all()
    {
        $query = self::toBase()->where('id','!=',1)->get()->count();
        return $query;
    }
    /***********************************************
     * ==== End :: DataTable Server Side ==== *
     **********************************************/

      /*************************************
    * TODO =  Begin :: Cache Data = TODO *
    **************************************/

    public static function allRoles(){
        return Cache::rememberForever(self::CACHE_NAME, function () {
            return self::toBase()->select('id','role')->where('id','!=',1)->orderBy('id','asc')->get();
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

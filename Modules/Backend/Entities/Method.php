<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    protected $fillable = [
        'module_id','method_name','method_slug'
    ];

    public const VALIDATION_RULES = [
        'method_name'     => ['required','string'],
        'module_id'       => ['required','integer'],
        'method_slug'     => ['required','string','unique:methods,method_slug'], 
    ];

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function roleMethodPermission() {
        return $this->hasMany(RoleMethodPermission::class);
    }

    /***********************************************
     * ==== Start :: DataTable Server Side ==== *
     **********************************************/
    private $order = array('methods.id' => 'desc'); //set column order by
    private $column_order; //set data table column sorting key

    //Start :: Custom Property
    private $_methodName;
    private $_moduleID;

    //End :: Custom Property

    //Start :: Default Property
    private $_orderValue;
    private $_dirValue;
    private $_startValue;
    private $_lengthValue;
    //End :: Default Property

    //Start :: Set custom properties value methods 
    public function setMethodName($methodName)
    {
        $this->_methodName = $methodName;
    }
    public function setModuleID($moduleID)
    {
        $this->_moduleID = $moduleID;
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
        
            $this->column_order = array('','methods.id', 'methods.method_name', 'methods.method_slug','methods.module_id','');

        $query = self::with('module:id,module_name,module_icon');

        if (!empty($this->_methodName)) {
            $query->where('methods.method_name', 'like','%'.$this->_methodName.'%');
        }
        if (!empty($this->_moduleID)) {
            $query->where('methods.module_id',$this->_moduleID);
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
        return self::toBase()->get()->count();
    }
    /***********************************************
     * ==== End :: DataTable Server Side ==== *
     **********************************************/
}

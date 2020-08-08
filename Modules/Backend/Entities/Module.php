<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\NestableTrait;

class Module extends Model
{
    use NestableTrait;

    protected $fillable = [
        'module_name','module_link','module_icon','module_sequence','parent_id'
    ];

    public const VALIDATION_RULES = [
        'module_name'     => ['required','string'],
        'module_link'     => ['required','string'],
        'module_icon'     => ['required','string'], 
        'module_sequence' => ['required','integer'],
        'parent_id'       => ['numeric','nullable'],
    ];

    public function method() {
        return $this->hasMany(Method::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Module::class, 'parent_id','id')->orderBy('module_sequence', 'asc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Module::class, 'parent_id','id');
    }

    public function roleModulePermission() {
        return $this->hasMany(RoleModulePermission::class);
    }

    /***********************************************
     * ==== Start :: DataTable Server Side ==== *
     **********************************************/
    private $order = array('id' => 'desc'); //set column order by
    private $column_order; //set data table column sorting key

    //Start :: Custom Property
    private $_moduleName;

    //End :: Custom Property

    //Start :: Default Property
    private $_orderValue;
    private $_dirValue;
    private $_startValue;
    private $_lengthValue;
    //End :: Default Property

    //Start :: Set custom properties value methods 
    public function setModuleName($moduleName)
    {
        $this->_moduleName = $moduleName;
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

        $this->column_order = array('','id', 'module_name', 'module_link', 'module_icon','parent_id','module_sequence','');

        $query = self::toBase();

        if (!empty($this->_moduleName)) {
            $query->where('module_name', 'like','%'.$this->_moduleName.'%');
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
        $query = self::toBase()->get()->count();
        return $query;
    }
    /***********************************************
     * ==== End :: DataTable Server Side ==== *
     **********************************************/

     public function parent_name($parent_id){
        $parent_name = self::toBase()->where('id',$parent_id)->value('module_name');
        if(!empty($parent_name)){
            return $parent_name;
        }else{
            return '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">No Parent</span>';
        }
     }
}

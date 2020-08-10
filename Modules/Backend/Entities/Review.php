<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name','phone_no','email','description',
    'daruuri_rating','communication_rating','stuff_rating','service_rating','referal_rating'];

       /**********************************
    * *   Begin :: Datatable Data   * *
    ***********************************/

    private $order = array('id' => 'desc'); //set column order by
    private $column_order; //set data table column sorting key
    

    //Start :: Custom Property
    private $from_date;
    private $to_date;
    private $daruuri_rating;
    //End :: Custom Property

    //Start :: Default Property
    private $orderValue;
    private $dirValue;
    private $startValue;
    private $lengthValue;
    //End :: Default Property

    //Start :: Set custom properties value methods 
    public function setFromDate($from_date)
    {
        $this->from_date = $from_date;
    }
    public function setToDate($to_date)
    {
        $this->to_date = $to_date;
    }
    public function setDaruuriRating($daruuri_rating)
    {
        $this->daruuri_rating = $daruuri_rating;
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
        if (permission('brand-bulk-action-delete')) {
            $this->column_order = array('','id','name','phone_no','email','daruuri_rating','communication_rating',
            'stuff_rating','service_rating','referal_rating','description','created_at', '');
        }else{
            $this->column_order = array('id', 'name','phone_no','email','daruuri_rating','communication_rating',
            'stuff_rating','service_rating','referal_rating','description','created_at',  '');
        }
        $query = self::toBase();

        if (!empty($this->from_date)) {
            $query->where('created_at', '>=', $this->from_date.' 00:00:00');
        }
        if (!empty($this->to_date)) {
            $query->where('created_at', '<=', $this->to_date.' 11:59:59');
        }
        if (!empty($this->daruuri_rating)) {
            $query->where('daruuri_rating', $this->daruuri_rating);
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
}

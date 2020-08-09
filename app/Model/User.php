<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'email', 'password', 'avatar', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*******************************
    * ! Begin :: Validation Rules ! 
    ********************************/
    public const VALIDATION_RULES = [
        'role_id' => ['required','integer'],
        'name'    => ['required','string'],
        'email'   => ['required','string','unique:users,email'],
        'avatar'  => ['nullable','image','mimes:svg,png,jpg,jpeg'],
        'status'  => ['required','integer']
    ];
    public const MESSAGE = [
        'role_id.required'     => 'The role name field is required',
        'role_id.integer'      => 'The role name field must be integer',
    ];
    /*******************************
    * ! End :: Validation Rules ! 
    ********************************/

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public function role() {
        return $this->belongsTo(Role::class);
    }

     /*********DataTable Server Side Begin************/
     private $order = array('users.id' => 'desc'); //set column order by
     private $column_order; //set data table column sorting key
 
     private $name;
     private $email;
     private $role_id;
     private $status;
 
     private $_orderValue;
     private $_dirValue;
     private $_startValue;
     private $_lengthValue;
 
 
     public function setName($name)
     {
         $this->name = $name;
     }
     public function setEmail($email)
     {
         $this->email = $email;
     }
     public function setRoleID($role_id)
     {
         $this->role_id = $role_id;
     }
     public function setStatus($status)
     {
         $this->status = $status;
     }
 
     //set datatable eliments
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
 
 
     private function _get_datatables_query()
     {

        $this->column_order = array('', 'users.id','users.id', 'users.name', 'users.email','users.mobile','users.status','');
 
         $query = self::with('role:id,role')
         ->where('users.id','!=',1);
 
 
         if (!empty($this->name)) {
             $query->where('users.name', 'like','%'.$this->name.'%');
         }
         if (!empty($this->email)) {
             $query->where('users.email', 'like','%'.$this->email.'%');
         }
         if (!empty($this->role_id)) {
             $query->where('users.role_id', $this->role_id);
         }
         if (!empty($this->status)) {
             $query->where('users.status', $this->status);
         }
 
         if (isset($this->_orderValue) && isset($this->_dirValue)) // here order processing
         {
             $query->orderBy($this->column_order[$this->_orderValue], $this->_dirValue);
 
         } else if (isset($this->order)) {
 
             $order = $this->order;
             $query->orderBy(key($order), $order[key($order)]);
         }
 
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
         $query = self::toBase()->where('id','!=',1)->get();
         return $query->count();
     }
     /*********DataTable Server Side End************/
 


}

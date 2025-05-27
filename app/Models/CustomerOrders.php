<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Helper;

class CustomerOrders extends Model
{
    use SoftDeletes;
    protected $table = 'customer_orders';
    protected $primaryKey = 'customer_order_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'customer_id','user_id', 'type', 'date', 'vehicle', 'order_by','deleted_user_id', 'address', 'sr_no', 'from', 'transporter','additional_charge','notes'];

    protected $dates = [ 'date' ];

    /**
     * Get the created at.
     *
     * @param  timestamp  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Helper::DateFormat($value);
    }
    
    /**
     * Get the updated at.
     *
     * @param  timestamp  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Helper::DateFormat($value);
    }

    /**
     * Get the Inward Date.
     *
     * @param  timestamp  $value
     * @return string
     */
    public function getDateAttribute($value)
    {
        return Helper::DateFormat($value,config('constant.DATE_FORMAT_SHORT'));
    }

    /**
     * Set the Date.
     *
     * @param  timestamp  $value
     * @return string
     */
    public function setDateAttribute($value)
    {    
        if(empty($value)){
            $this->attributes['date'] = null;
        }
        else{
            //$this->attributes['date'] = Helper::convertDateFormat($value,"!m/d/Y");
            $this->attributes['date'] = Helper::convertDateFormat($value,config('constant.DATE_FORMAT_SHORT'));
        }
    }

    /**
     * Get the Company name.
     * @return {companyname}
     */
    public function getFullNameAttribute() 
    {
        return "{$this->companyname}";        
    }

    /**
     * Get the Additional Charge.
     *
     * @param  number  $value
     * @return number
     */
    public function getAdditionalChargeAttribute($value)
    {
        return empty($value) ? '0.00' : $value;
    }
    
}

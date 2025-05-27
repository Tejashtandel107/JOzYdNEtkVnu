<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;
use Helper;

class Customer extends Model
{
    use SoftDeletes;
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'companyname', 'address', 'gstnumber' , 'contact_person' ,'phone', 'photo', 'isactive','last_invoice_date','invoice_limit' ];

    /**
     * Set the Last Invoice Date.
     *
     * @param  timestamp  $value
     * @return string
     */
    public function setLastInvoiceDateAttribute($value)
    {    
        if(empty($value)){
            $this->attributes['last_invoice_date'] = null;
        }
        else{
            //$this->attributes['date'] = Helper::convertDateFormat($value,"!m/d/Y");
            $this->attributes['last_invoice_date'] = Helper::convertDateFormat($value,config('constant.DATE_FORMAT_SHORT'));
        }
    }
     /**
     * Get the Last Invoice Date.
     *
     * @param  timestamp  $value
     * @return string
     */
    public function getLastInvoiceDateAttribute($value)
    {
        return Helper::DateFormat($value,config('constant.DATE_FORMAT_SHORT'));
    }

    /**
     * Scope a query to only include active items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * 
     */
    public function scopeActive($query) 
    {
        return $query->where('isactive',config('constant.status.active'));
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
     * Get the user's photo.
     *
     * @param  string  $value
     * @return string
     */
    public static function getPhotoAttribute($value) 
    {
        return Helper::getProfileImg($value);
    }

    /**
     * Delete File from storage
     *     
     */
    public function deleteFile($file="") 
    {
        if (Storage::exists($file)) {
            return Storage::delete($file);
        }

        // Optional: return false or throw exception if file not found
        return false;
    }
}

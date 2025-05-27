<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Helper;
use Auth;

class Marka extends Model
{
    /**
     * Defien table name in database
     */
    use SoftDeletes;
    protected $table = 'marka';

    protected $primaryKey = 'marka_id';

    /**
     * Get the item's created at.
     *
     * @param  timestamp  $value
     * @return string
     */
    public function getCreatedAtAttribute($value) 
    {
        return Helper::DateFormat($value);
    }

    /**
     * Get the item's updated at.
     *
     * @param  timestamp  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value) 
    {
        return Helper::DateFormat($value);
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['item_id','name'];

    public function addMarka($request_arr) 
    {
        $result = false;
        $item_id = !empty($request_arr['item_id_by_weight']) ? $request_arr['item_id_by_weight'] : array() ;        
        
        if(count($item_id)>0) {
            $now = Carbon::now();
            $item_price = $request_arr['price_by_weight'];
            for ($i = 0; $i < count($item_id); $i++) {
                $item_price_obj = $this->where('price_date',$request_arr['fishing_date'])->where('item_id',$item_id[$i])->first();
                if(!$item_price_obj){
                    $item_price_arr[] = array('item_id'=> $item_id[$i],
                        'price' => $item_price[$i],
                        'price_date'=> $request_arr['fishing_date'],
                        'created_at' => $now,
                        'updated_at' => $now
                    );
                }
                if(isset($item_price_arr) && count($item_price_arr) > 0){
                    $result = Marka::insert($item_price_arr);
                }
                $item_price_arr = null;
            }

           if($result){
              return $result;
           }
        }
        return $result;
    }
    public function getMarkaByItemId($id){
        if(is_array($id)){
            return Marka::withTrashed()->whereIn('item_id',$id)->orderBy('name','asc')->get();
        }
        else if($id>0){
            return Marka::withTrashed()->where('item_id',$id)->orderBy('name','asc')->get();
        }
        else{
            return false;
        }
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class AllTransaction extends Model
{

    protected $table = 'wb_all_transactions';
    protected $fillable = array('wb_order_id', 'transaction_status','user_id', 'type', 'amount', 'payment_gateway','payment_gateway_id','created_at','updated_at');
    public $timestamps = false;

    public static function all_transaction_data()
    {
	    	$transation_data = DB::select(DB::raw("SELECT a.id, b.transaction_id, a.wb_order_id, a.campaign_id, a.user_id, a.type, a.amount, a.payment_gateway, a.payment_gateway_id, a.status,a.settlement_status, a.created_on,a.modified_on,b.meta_key, b.meta_value
				FROM wb_transactions a, wb_transaction_meta b
				WHERE a.id = b.transaction_id AND a.type = 2 limit 200
				")); 

           return $transation_data;

    }



}

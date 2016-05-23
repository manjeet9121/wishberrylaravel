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
				WHERE a.id = b.transaction_id and a.type = 2 and (date(a.created_on) between '2016-03-01' and '2016-03-31') order by a.id desc
				")); 

           return $transation_data;
    }



    public static function all_success_trans_data()
    {
            $transation_data = DB::select(DB::raw("SELECT a.id, b.transaction_id,a.campaign_id,a.type, a.amount, a.payment_gateway, a.payment_gateway_id, a.status,a.created_on,b.meta_key, b.meta_value,c.post_title
                FROM wb_transactions a, wb_transaction_meta b,wp_posts c
                WHERE a.id = b.transaction_id and a.campaign_id = 8407 and c.id = 8407 and a.type =2 and a.status=4 order by a.id desc
                ")); 

           return $transation_data;
    }


    public static function  post_data()
    {
        $post_data = DB::select(DB::raw("SELECT * FROM `wp_postmeta` WHERE `post_id` =8407
                                AND `meta_key` LIKE 'total_contribution'
                                UNION
                                SELECT * FROM `wp_postmeta` WHERE `post_id` =8407
                                AND `meta_key` LIKE '%target%'
                                "));

        return $post_data;
    }


    public static function  old_data()
    {
        $old_data = DB::select(DB::raw("SELECT a.*,b.post_title FROM wb_transactions a, wp_posts b
                                    WHERE TYPE =2 and a.campaign_id = b.id AND date( `created_on` )
                                    BETWEEN '2016-03-01' AND '2016-03-31' ORDER BY id DESC "));

        return $old_data;
    }

    public static function old_tansaction_data()
    {
        $old_tansaction_data =  DB::select(DB::raw("SELECT a.id, b.transaction_id, a.wb_order_id, a.campaign_id, a.user_id, a.payment_gateway_id, a.status, a.created_on,b.meta_key, b.meta_value,c.post_title
                FROM wb_transactions a, wb_transaction_meta b,wp_posts c
                WHERE a.id = b.transaction_id and a.type = 2 and a.campaign_id = c.id  and (date(a.created_on) between '2016-03-01' and '2016-03-31') order by a.id desc
                ")); 

           return $old_tansaction_data;

    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AllTransaction;
use Input;

use App\Http\Requests;

class User extends Controller
{
    
    public function tansaction_data()
    {
    	$tansaction_data = AllTransaction::all_transaction_data();

    	$data = array();
    	$allarr = array();
    	$i=0;
    	foreach ($tansaction_data as $key => $value) 
    	{
    		$value = (array) $value;

    		$data[$i]['id'] = $value['id'];
    		$data[$i]['transaction_id'] = $value['transaction_id'];
    		$data[$i]['campaign_id'] = $value['campaign_id'];
    		$data[$i]['user_id'] = $value['user_id'];
    		$data[$i]['type'] = $value['type'];
    		$data[$i]['amount']= $value['amount'];
    		$data[$i]['payment_gateway'] = $value['payment_gateway'];
    		$data[$i]['payment_gateway_id'] = $value['payment_gateway_id'];
    		$data[$i]['status'] = $value['status'];
    		$data[$i]['settlement_status'] = $value['settlement_status'];
    		$data[$i]['created_on'] = $value['created_on'];
    		$data[$i]['modified_on'] = $value['modified_on'];

    		if(strpos($value['meta_key'], 'shipping') !== false)
    		{
    			$data[$i]['shipping_info'][$key] = $value['meta_key'].':'. $value['meta_value'] ;
    		}
    		if(strpos($value['meta_key'],'anonymous')!== false)
    		{
    			$data[$i]['anonymous'] = $value['meta_value'];
    		}
    		if (strpos($value['meta_key'],'where_did_you_hear')!== false) {
    			$data[$i]['where_did_you_hear'] = $value['meta_value'];
    		}
    		if (strpos($value['meta_key'],'known')!== false) {
    			$data[$i]['known'] = $value['meta_value'];
    		}
    		if (strpos($value['meta_key'],'international')!== false) {
    			$data[$i]['international'] = $value['meta_value'];
    		}
    		if (strpos($value['meta_key'],'transaction_status')!== false) {
    			$data[$i]['transaction_status'] = $value['meta_value'];
    		}
    		if (strpos($value['meta_key'],'payment_type')!== false) {
    			$data[$i]['payment_type'] = $value['meta_value'];
    		}
    		if (strpos($value['meta_key'],'service_tax')!== false) {
    			$data[$i]['service_tax'] = $value['meta_value'];
    		}
    		if (strpos($value['meta_key'],'commission')!== false) {
    			$data[$i]['commission'] = $value['meta_key'];
    		}
    		if (strpos($value['meta_key'],'total_cost')!== false) {
    			$data[$i]['total_cost'] = $value['meta_value'];
    		}
    		if (strpos($value['meta_key'],'reward_id')!== false) {
    			$data[$i]['reward_id'] = $value['meta_value'];
    		}
    		$i++;
    	}
    		//echo "<pre>";print_r($data);die;

    		/*foreach ($data as $value_new) {
    			//echo "<pre>";print_r($value_new);die;
				  if($value_new['id'] = $value_new['id'])
				  {
				  	$allarr[$value_new['id']][] = $value_new;
				  }
				  echo "<pre>";print_r($allarr);
			}
			echo "asdfg" ; die;
			echo "<pre>";print_r($allarr);die;*/

    	/*$finaldata = array();
    	foreach ($data as  $transvalue) {
    		//echo "<pre>";print_r($transvalue);
            $finaldata[] = array('campaign_id' => $transvalue['campaign_id'],'user_id' => $transvalue['user_id'],
            	'type' => $transvalue['type'],'amount' => $transvalue['amount'],'payment_gateway' => $transvalue['payment_gateway'],'status' => $transvalue['status'],'settlement_status' => $transvalue['settlement_status']?$transvalue['settlement_status'] : null,'shipping_info' => json_encode(array_values(array_unique($transvalue['shipping_info']))),'anonymous' => $transvalue['anonymous'],'where_did_you_hear' => $transvalue['where_did_you_hear'],'known' => $transvalue['known'],'international' => $transvalue['international'],'payment_gateway_transaction_status' => $transvalue['transaction_status'],'payment_type' => $transvalue['payment_type'] , 'service_tax' => $transvalue['service_tax'],'commission'=> $transvalue['commission'],'total_cost' => $transvalue['total_cost'],'created_on' => $transvalue['created_on'] ,'modified_on' =>  $transvalue['modified_on']


            	);
        }

        AllTransaction::insert($finaldata);*/
        //echo "<pre>";print_r($data);die;
       /* echo "lalalal";die;*/
		$result = new AllTransaction;
		if(count($data) > 0 )
		{
		foreach ($data as $key => $value) 
		{
			/*echo "<pre>";print_r(isset($value['reward_id'])?$value['reward_id']:'000');die;*/
			//echo "<pre>";print_r(isset($value['user_id'])?$value['user_id']:'null');die;
			//echo "<pre>";print_r(!empty($data['shipping_info'])? $data['shipping_info']:[]);die;

			$reward_id = isset($value['reward_id'])?$value['reward_id']:'000';
			$shipping_info = json_encode(array_values(array_unique(isset($value['shipping_info'])?$value['shipping_info']:[])));
			$user_id = isset($value['user_id'])?$value['user_id']:'null';
			$campaign_id = isset($value['campaign_id'])?$value['campaign_id']:'null';

			$result->wb_order_id = 'wbf_'.$user_id.'_'.$campaign_id.'_'.$reward_id.'_'.$value['transaction_id'];
			$result->campaign_id = $campaign_id;
	    	$result->user_id = $user_id;
	    	$result->type = isset($value['type'])?$value['type']:'null';
	    	$result->amount = isset($value['amount'])?$value['amount']:'null';
	    	$result->payment_gateway = isset($value['payment_gateway'])?$value['payment_gateway']:'null';
	    	$result->payment_gateway_id = isset($value['payment_gateway_id'])?$value['payment_gateway_id']:'null';
	    	$result->status = isset($value['status'])?$value['status']:'null';
	    	$result->settlement_status = isset($value['settlement_status'])?$value['settlement_status'] :'null' ;
	    	$result->shipping_info = $shipping_info;
	    	$result->anonymous = isset($value['anonymous'])?$value['anonymous']:'null';
	    	$result->where_did_you_hear = isset($value['where_did_you_hear'])?$value['where_did_you_hear']:'null';
	    	$result->known = isset($value['known'])?$value['known']:'null';
	    	$result->international =isset($value['international'])?$value['international']:'null';
	    	$result->payment_gateway_transaction_status = isset($value['transaction_status'])?$value['transaction_status']:'null';
	    	$result->payment_type = isset($value['payment_type'])?$value['payment_type']:'null';
	    	$result->service_tax = isset($value['service_tax'])?$value['service_tax']:'null';
	    	$result->commission = isset($value['commission'])?$value['commission']:'null';
	    	$result->total_cost = isset($value['total_cost'])?$value['total_cost']:'null';
	    	$result->created_on = isset($value['created_on'])?$value['created_on']:'null';
	    	$result->modified_on = isset($value['modified_on'])?$value['modified_on']:'null';
	    	//echo "<pre>";print_r($result);die;
	    	$result->save();
	    }
		}
    	echo "Success Done";
    }
}
 
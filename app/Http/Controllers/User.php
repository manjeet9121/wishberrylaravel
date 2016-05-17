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
    	
    	$indexkey = [];
    	$data = [];
    	$finaldata = [];

    	foreach ($tansaction_data as $key => $value) 
    	{
    		$value = (array) $value;
    		$indexkey[$value['id']][] = $value;
    		foreach ($indexkey as $key1 => $value1) 
    		{

    			if($key1 = $value['id'])
    			{
			    		$data[$key1]['id'] = $value['id'];
			    		$data[$key1]['transaction_id'] = $value['transaction_id'];
			    		$data[$key1]['campaign_id'] = $value['campaign_id'];
			    		$data[$key1]['user_id'] = $value['user_id'];
			    		$data[$key1]['type'] = $value['type'];
			    		$data[$key1]['amount']= $value['amount'];
			    		$data[$key1]['payment_gateway'] = $value['payment_gateway'];
			    		$data[$key1]['payment_gateway_id'] = $value['payment_gateway_id'];
			    		$data[$key1]['status'] = $value['status'];
			    		$data[$key1]['settlement_status'] = $value['settlement_status'];
			    		$data[$key1]['created_on'] = $value['created_on'];
			    		$data[$key1]['modified_on'] = $value['modified_on'];
						
			    		if(strpos($value['meta_key'], 'shipping') !== false)
			    		{
			    			$data[$key1]['shipping_info'][$key] = array($value['meta_key'] => $value['meta_value'] );
			    		}
			    		if(strpos($value['meta_key'],'anonymous')!== false)
			    		{
			    			
			    			  $data[$key1]['anonymous'] = $value['meta_value'];
			    			
			    		}
			    		if (strpos($value['meta_key'],'where_did_you_hear')!== false) {
			    			 $data[$key1]['where_did_you_hear'] = $value['meta_value'];
			    			
			    		}
			    		if (strpos($value['meta_key'],'known')!== false) {
			    			
			    			  $data[$key1]['known'] = $value['meta_value'];
			    			
			    		}
			    		if (strpos($value['meta_key'],'international')!== false) {
			    			$data[$key1]['international'] = $value['meta_value'];
			    			
			    		}
			    		if (strpos($value['meta_key'],'transaction_status')!== false) {
			    			$data[$key1]['transaction_status'] = $value['meta_value'];
			    			
			    		}
			    		if (strpos($value['meta_key'],'payment_type')!== false) {
			    			$data[$key1]['payment_type'] = $value['meta_value'];
			    			
			    		}
			    		if (strpos($value['meta_key'],'service_tax')!== false) {
			    			$data[$key1]['service_tax'] = $value['meta_value'];
			    			
			    		}
			    		if (strpos($value['meta_key'],'commission')!== false) {
			    			$data[$key1]['commission'] = $value['meta_key'];
			    			
			    		}
			    		if (strpos($value['meta_key'],'total_cost')!== false) {
			    			$data[$key1]['total_cost'] = $value['meta_value'];
			    			
			    		}
			    		if (strpos($value['meta_key'],'reward_id')!== false) {
			    			$data[$key1]['reward_id'] = $value['meta_value'];
			    		}
			    }
    		}

    	}

    	
    	foreach ($data as  $key2 => $transvalue) 
    	{
    		
    		if($key2 = $transvalue['id'])
    		{

    			if(!in_array('reward_id', $transvalue))
	    		{
	    			$transvalue['reward_id'][$key2] = '000';
	    			
	    		}
	    		elseif(in_array('reward_id', $transvalue))
	    		{
	    			$transvalue['reward_id'][$key2] = $transvalue['reward_id'];
	    			
	    		}


	    		if(!in_array('anonymous', $transvalue))
	    		{
	    			$transvalue['anonymous'][$key2] = 'null';
	    		}elseif (in_array('anonymous', $transvalue)) {
	    			$transvalue['anonymous'][$key2] = $transvalue['anonymous'];
	    		}

	    		if(!in_array('where_did_you_hear', $transvalue))
	    		{
	    			$transvalue['where_did_you_hear'][$key2] = 'null';
	    		}elseif (in_array('where_did_you_hear', $transvalue)) {
	    			$transvalue['where_did_you_hear'][$key2] = $transvalue['where_did_you_hear'];
	    		}


	    		if(!in_array('known', $transvalue))
	    		{
	    			$transvalue['known'][$key2] = 'null';
	    		}elseif (in_array('known', $transvalue)) {
	    			$transvalue['known'][$key2] = $transvalue['known'];
	    		}

	    		if(!in_array('international', $transvalue))
	    		{
	    			$transvalue['international'][$key2] = 'null';
	    		}elseif (in_array('international', $transvalue)) {
	    			$transvalue['international'][$key2] = $transvalue['international'];
	    		}

	    		if(!in_array('transaction_status', $transvalue))
	    		{
	    			$transvalue['transaction_status'][$key2] = 'null';
	    		}elseif (in_array('transaction_status', $transvalue)) {
	    			$transvalue['transaction_status'][$key2] = $transvalue['transaction_status'];
	    		}

	    		if(!in_array('payment_type', $transvalue))
	    		{
	    			$transvalue['payment_type'][$key2] = 'null';
	    		}elseif (in_array('payment_type', $transvalue)) {
	    			$transvalue['payment_type'][$key2] = $transvalue['payment_type'];
	    		}

	    		if(!in_array('service_tax', $transvalue))
	    		{
	    			$transvalue['service_tax'][$key2] = 'null';
	    		}elseif (in_array('service_tax', $transvalue)) {
	    			$transvalue['service_tax'][$key2] = $transvalue['service_tax'];
	    		}

	    		
	    		if(!in_array('commission', $transvalue))
	    		{
	    			$transvalue['commission'][$key2] = 'null';
	    		}elseif (in_array('commission', $transvalue)) {
	    			$transvalue['commission'][$key2] = $transvalue['commission'];
	    		}

	    		if(!in_array('total_cost', $transvalue))
	    		{
	    			$transvalue['total_cost'][$key2] = 'null';
	    		}elseif (in_array('total_cost', $transvalue)) {
	    			$transvalue['total_cost'][$key2] = $transvalue['total_cost'];
	    		}

    			

			    		$transaction_id = $transvalue['transaction_id'];
			    		$shipping_info = json_encode(array_values(isset($transvalue['shipping_info']) ? $transvalue['shipping_info'] : ['null']));
			    		$reward_id = is_array($transvalue['reward_id']) ? $transvalue['reward_id'][$key2] : $transvalue['reward_id'];
			    		
			    		$web_order_id = "wbf_".$transvalue['user_id']."_".$transvalue['campaign_id']."_".intval($reward_id)."_".$transaction_id;
			    		
			    		$anonymous = is_array($transvalue['anonymous']) ? $transvalue['anonymous'][$key2] : $transvalue['anonymous'];
			    		$where_did_you_hear = is_array($transvalue['where_did_you_hear']) ? $transvalue['where_did_you_hear'][$key2] : $transvalue['where_did_you_hear'];
			    		$known = is_array($transvalue['known']) ? $transvalue['known'][$key2] : $transvalue['known'];
			    		$international = is_array($transvalue['international']) ? $transvalue['international'][$key2] : $transvalue['international'];
			    		$transaction_status = is_array($transvalue['transaction_status']) ? $transvalue['transaction_status'][$key2] : $transvalue['transaction_status'];
			    		$payment_type = is_array($transvalue['payment_type']) ? $transvalue['payment_type'][$key2] : $transvalue['payment_type'];
			    		$service_tax = is_array($transvalue['service_tax']) ? $transvalue['service_tax'][$key2] : $transvalue['service_tax'];
			    		$commission = is_array($transvalue['commission']) ? $transvalue['commission'][$key2] : $transvalue['commission'];
			    		$total_cost = is_array($transvalue['total_cost']) ? $transvalue['total_cost'][$key2] : $transvalue['total_cost']; 

    		
    		
    		
						$finaldata[] = array('wb_order_id' =>$web_order_id,'campaign_id' => $transvalue['campaign_id'],'user_id' => $transvalue['user_id'],
            				'type' => $transvalue['type'],'amount' => $transvalue['amount'],'payment_gateway' => $transvalue['payment_gateway'],'status' => $transvalue['status'],'settlement_status' => $transvalue['settlement_status']?$transvalue['settlement_status'] : 'null','shipping_info' => $shipping_info,'anonymous' => $anonymous,'where_did_you_hear' => $where_did_you_hear,'known' => $known,'international' => $international,'payment_gateway_transaction_status' => $transaction_status,'payment_type' => $payment_type , 'service_tax' => $service_tax,'commission'=> $commission,'total_cost' => $total_cost,'created_on' => $transvalue['created_on'] ,'modified_on' =>  $transvalue['modified_on']);
		    		
    		
    		}
        }

      

        AllTransaction::insert($finaldata);

		echo "Success Done";
	}
    
}
 
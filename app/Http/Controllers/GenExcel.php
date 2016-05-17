<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AllTransaction;
//use Maatwebsite\Excel\Excel;
use Input;

use App\Http\Requests;

class GenExcel extends Controller
{
     public function generate_excel()
    {
    	//echo "HIHIHI";die;

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
			    		$data[$key1]['post_title'] = $value['post_title'];
						
			    		if(strpos($value['meta_key'], 'shipping') !== false)
			    		{
			    				$data[$key1]['shipping_info'][$key] = array($value['meta_key'] => $value['meta_value']);
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
			    			$data[$key1]['commission'] = $value['meta_value'];
			    			
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

    	//echo "<pre>";print_r($data);die;

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
	    	}
	    	
	    	$backer_name = array_unique(array_column($transvalue['shipping_info'],'shipping_name'));
	    	
	    	echo "<pre>";print_r($backer_name);
	    	echo "<pre>";print_r($transvalue);

	    }





	    echo "HIII";die;
    	//echo "<pre>";print_r($transvalue);

    	/*\Excel::create('transactiondata', function($excel) 
    	{
	        // Set the title
	        $excel->setTitle('no title');
	        $excel->setCreator('no no creator')->setCompany('no company');
	        $excel->setDescription('report file');

	        $excel->sheet('sheet1', function($sheet) {
		            $data = array(
		                array('Transaction date', 'WB ID','PG ID','PG name','Amount','Campaign name','Campaign ID','Backer name','Backer ID','First time backer (y/n)','Personally know (y/n)','Where did you hear','Anonymous (y/n)','Backer email','Backer phone','Backer city','Backer country','International? (yes/no)','Method of payment','WB transaction status','PG trans status','Wishberry commission Rs. (=commission% * pledge amount)','PG Costs','Service Tax on PG Cost','Total PG cost Rs. (=pg cost + service tax on pg cost)'),
		                array('data1', 'data2', 300, 400, 500, 0, 100),
		                array('data1', 'data2', 300, 400, 500, 0, 100),
		                array('data1', 'data2', 300, 400, 500, 0, 100),
		                array('data1', 'data2', 300, 400, 500, 0, 100),
		                array('data1', 'data2', 300, 400, 500, 0, 100),
		                array('data1', 'data2', 300, 400, 500, 0, 100)
		            );
		            $sheet->fromArray($data, null, 'A1', false, false);
		            $sheet->cells('A1:G1', function($cells) {
		            $cells->setBackground('#AAAAFF');

		            });
	        	});
    	})->download('xlsx');*/

    }
}

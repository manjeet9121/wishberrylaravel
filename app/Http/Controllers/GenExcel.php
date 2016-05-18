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
    	$exceldata = [] ;

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
    	$wishberry_commision = '';
    	$i=0;
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
	    	


	    	$exceldata[$key2]['Transaction Date'] =$transvalue['created_on'];
	    	$reward_id = is_array($transvalue['reward_id']) ? $transvalue['reward_id'][$key2] : intval($transvalue['reward_id']);
	    	$exceldata[$key2]['WB ID'] ="wbf_".$transvalue['user_id']."_".$transvalue['campaign_id']."_".$reward_id."_".$transvalue['transaction_id'];
	    	$exceldata[$key2]['PG ID'] =isset($transvalue['payment_gateway_id']) ? $transvalue['payment_gateway_id'] : 'null';
	    	$exceldata[$key2]['PG name'] =isset($transvalue['payment_gateway']) ? $transvalue['payment_gateway'] : 'null';
	    	if($exceldata[$key2]['PG name'] == 1)
	    	{
	    		$exceldata[$key2]['PG name'] ='CCAvenue';
	    	}
	    	if($exceldata[$key2]['PG name'] == 2)
	    	{
	    		$exceldata[$key2]['PG name'] ='ECollectors';
	    	}
	    	if($exceldata[$key2]['PG name'] == 3)
	    	{
	    		$exceldata[$key2]['PG name'] ='PayU';
	    	}
	    	if($exceldata[$key2]['PG name'] == 5)
	    	{
	    		$exceldata[$key2]['PG name'] ='PAYTM';
	    	}
	    	if($exceldata[$key2]['PG name'] == 6)
	    	{
	    		$exceldata[$key2]['PG name'] ='DELHIVERY';
	    	}
	    	if($exceldata[$key2]['PG name'] == 10)
	    	{
	    		$exceldata[$key2]['PG name'] ='MANUAL UPDATE';
	    	}

	    	$exceldata[$key2]['Amount'] =isset($transvalue['amount']) ? intval($transvalue['amount']): 'null';
	    	
	    	$exceldata[$key2]['Campaign name'] =isset($transvalue['post_title']) ? $transvalue['post_title']: 'null';
	    	$exceldata[$key2]['Campaign ID'] =$transvalue['campaign_id'];

	    	$exceldata[$key2]['Backer name'] = array_unique(array_column($transvalue['shipping_info'],'shipping_name'));
	    	$exceldata[$key2]['Backer name']  = !empty($exceldata[$key2]['Backer name']) ? $exceldata[$key2]['Backer name'][0] : 'null';

	    	$exceldata[$key2]['Backer ID'] =$transvalue['user_id']; 
	    	$exceldata[$key2]['First time backer (y/n)'] ='yes';
			$exceldata[$key2]['Personally know (y/n)'] =is_array($transvalue['known']) ? $transvalue['known'][$key2] : intval($transvalue['known']);
	    	
	    	if($exceldata[$key2]['Personally know (y/n)'] == '0')
	    	{
	    		$exceldata[$key2]['Personally know (y/n)'] = 'No';
	    	}
	    	if ($exceldata[$key2]['Personally know (y/n)'] == '1') {
	    		$exceldata[$key2]['Personally know (y/n)'] ='Yes';
	    	}

	    	$exceldata[$key2]['Where did you hear'] = is_array($transvalue['where_did_you_hear']) ? $transvalue['where_did_you_hear'][$key2] : $transvalue['where_did_you_hear'];

	    	$exceldata[$key2]['Anonymous (y/n)'] = is_array($transvalue['anonymous']) ? $transvalue['anonymous'][$key2] : $transvalue['anonymous'];

	    	$exceldata[$key2]['Backer email'] = array_unique(array_column($transvalue['shipping_info'],'shipping_email')); 
	    	$exceldata[$key2]['Backer email'] = !empty($exceldata[$key2]['Backer email']) ? $exceldata[$key2]['Backer email'][0] : 'null'; 

	    	$exceldata[$key2]['Backer phone'] = array_unique(array_column($transvalue['shipping_info'],'shipping_phone')); 
	    	$exceldata[$key2]['Backer phone'] = !empty($exceldata[$key2]['Backer phone']) ? $exceldata[$key2]['Backer phone'][0] : 'null'; 

	    	$backer_city = array_unique(array_column($transvalue['shipping_info'],'shipping_city'));
	    	$exceldata[$key2]['Backer city'] = !empty($backer_city) ? $backer_city : 'null';  	

	    	$exceldata[$key2]['Backer country'] = array_unique(array_column($transvalue['shipping_info'],'shipping_country'));
	    	$exceldata[$key2]['Backer country'] = !empty($exceldata[$key2]['Backer country']) ? $exceldata[$key2]['Backer country'][0] : 'null'; 

	    	$exceldata[$key2]['International? (yes/no)'] = is_array($transvalue['international']) ? $transvalue['international'][$key2] : $transvalue['international']; 	
	    	$exceldata[$key2]['Method of payment'] = is_array($transvalue['payment_type']) ? $transvalue['payment_type'][$key2] : $transvalue['payment_type'];
	    	$exceldata[$key2]['WB transaction status'] = is_array($transvalue['status']) ? $transvalue['status'][$key2] : $transvalue['status'];

	    	if($exceldata[$key2]['WB transaction status'] == 1)
	    	{
	    		$exceldata[$key2]['WB transaction status'] = 'Initiated';
	    	}

	    	if($exceldata[$key2]['WB transaction status'] == 2)
	    	{
	    		$exceldata[$key2]['WB transaction status'] = 'Submitted';
	    	}
	    	
	    	if($exceldata[$key2]['WB transaction status'] == 3)
	    	{
	    		$exceldata[$key2]['WB transaction status'] = 'Pending';
	    	}
	    	
	    	if($exceldata[$key2]['WB transaction status'] == 4)
	    	{
	    		$exceldata[$key2]['WB transaction status'] = 'Successful';
	    	}
	    	
	    	if($exceldata[$key2]['WB transaction status'] == 5)
	    	{
	    		$exceldata[$key2]['WB transaction status'] = 'Failed';
	    	}
	    	
	    	if($exceldata[$key2]['WB transaction status'] == 6)
	    	{
	    		$exceldata[$key2]['WB transaction status'] = 'Deleted';
	    	}
	    	
	    	if($exceldata[$key2]['WB transaction status'] == 7)
	    	{
	    		$exceldata[$key2]['WB transaction status'] = 'Cancelled';
	    	}
	    	
	    	if($exceldata[$key2]['WB transaction status'] == 8)
	    	{
	    		$exceldata[$key2]['WB transaction status'] = 'On the Way';
	    	}
	    	
	    	if($exceldata[$key2]['WB transaction status'] == 9)
	    	{
	    		$exceldata[$key2]['WB transaction status'] = 'Deferred by Customer';
	    	}
	    	

	    	$exceldata[$key2]['PG trans status'] = is_array($transvalue['transaction_status']) ? $transvalue['transaction_status'][$key2] : $transvalue['transaction_status'];

	    	if(is_string($exceldata[$key2]['Amount']))
	    	{
	    		$exceldata[$key2]['Wishberry commission Rs. (=commission% * pledge amount)'] = 'null' ;
	    		$exceldata[$key2]['PG Costs'] = 'null';
	    		$exceldata[$key2]['Service Tax on PG Cost'] = 'null';
	    		$exceldata[$key2]['Total PG cost Rs. (=pg cost + service tax on pg cost)'] = 'null';
	    	}else{
	    		$exceldata[$key2]['Wishberry commission Rs. (=commission% * pledge amount)'] = 10/100 * $exceldata[$key2]['Amount'] ;
	    		$exceldata[$key2]['PG Costs'] = 2/100 * $exceldata[$key2]['Amount'];
	    		$exceldata[$key2]['Service Tax on PG Cost'] = 14.5/100 * $exceldata[$key2]['PG Costs'];
	    		$exceldata[$key2]['Total PG cost Rs. (=pg cost + service tax on pg cost)'] = $exceldata[$key2]['Service Tax on PG Cost'] + $exceldata[$key2]['PG Costs'];
	    	}

	    	}

	    }
	    	//echo "<pre>";print_r($exceldata);die;

	    	$filename = 'All transactions';
	    	\Excel::create($filename, function($excel) use ($filename, $exceldata) {

			        // Set the title
			        $excel->setTitle($filename);

			        // Chain the setters
			        $excel->setCreator('Damilola Ogunmoye');

			        $excel->sheet('SHEETNAME', function($sheet) use ($exceldata) {


			            $sheet->fromArray($exceldata);

			        });

			    })->download('xls');
	    

	}
}

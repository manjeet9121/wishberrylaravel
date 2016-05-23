<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Transaction;
use App\Model\AllTransaction;
use App\Helpers\Helpers;

use App\Http\Requests;

class OldData extends Controller
{
    
public function wb_get_contributions()
    {
    	
    	$exceldata = [] ;
    	$indexkey_old = [];
    	$tansaction_data = Helpers::object2array(AllTransaction::old_tansaction_data());
    	//echo "<pre>";print_r($tansaction_data);die;
    	$OldData = Helpers::object2array(AllTransaction::old_data());
    	
    	$new1 = array();
		foreach ($OldData as $value){
		    $new1[] = $value['id'];
		}
		
		$new2 = array();
		foreach ($tansaction_data as $value){
		    $new2[] = $value['id'];
		}
		$new2 = array_unique($new2);
		$tes = array_diff($new1, $new2);
		
		$diff = array();
		foreach ($tes as $key => $v1){
				foreach ($OldData as $v2){
					if($v1 == $v2['id'])
			    		$diff[] = $v2;
			}
		}
		//echo "<pre>";print_r($diff);

		foreach ($diff as $k3 => $v3) {
			$indexkey_old[$v3['id']][] = $v3;
    		foreach ($indexkey_old as $k4 => $v4) 
    		{
    			if($k4 = $v3['id'])
    			{
					$exceldata[$k4]['Date'] =$v3['created_on'];
					$old_reward_id = '000';
					$exceldata[$k4]['Order no'] ="wbf_".$v3['user_id']."_".$v3['campaign_id']."_".$old_reward_id."_".$v3['id'];
					$exceldata[$k4]['Payment gateway order no'] =isset($v3['payment_gateway_id']) ? $v3['payment_gateway_id'] : '';
					$exceldata[$k4]['Status'] = is_array($v3['status']) ? $v3['status'][$k4] : $v3['status'];

				    	if($exceldata[$k4]['Status'] == 1)
				    	{
				    		$exceldata[$k4]['Status'] = 'Initiated';
				    	}

				    	if($exceldata[$k4]['Status'] == 2)
				    	{
				    		$exceldata[$k4]['Status'] = 'Submitted';
				    	}
				    	
				    	if($exceldata[$k4]['Status'] == 3)
				    	{
				    		$exceldata[$k4]['Status'] = 'Pending';
				    	}
				    	
				    	if($exceldata[$k4]['Status'] == 4)
				    	{
				    		$exceldata[$k4]['Status'] = 'Successful';
				    	}
				    	
				    	if($exceldata[$k4]['Status'] == 5)
				    	{
				    		$exceldata[$k4]['Status'] = 'Failed';
				    	}
				    	
				    	if($exceldata[$k4]['Status'] == 6)
				    	{
				    		$exceldata[$k4]['Status'] = 'Deleted';
				    	}
				    	
				    	if($exceldata[$k4]['Status'] == 7)
				    	{
				    		$exceldata[$k4]['Status'] = 'Cancelled';
				    	}
				    	
				    	if($exceldata[$k4]['Status'] == 8)
				    	{
				    		$exceldata[$k4]['Status'] = 'On the Way';
				    	}
				    	
				    	if($exceldata[$k4]['Status'] == 9)
				    	{
				    		$exceldata[$k4]['Status'] = 'Deferred by Customer';
				    	}
				    	$exceldata[$k4]['Campaign name'] = $v3['post_title'];
			    		$exceldata[$k4]['User ID'] = $v3['user_id'];
				    	$exceldata[$k4]['Reward'] = '' ;
				    	$exceldata[$k4]['Shipping country'] = '';
				    	$exceldata[$k4]['Shipping city'] = '';
				    	$exceldata[$k4]['Shipping code'] = '';

			    }
			}

		}
		//echo "<pre>";print_r($exceldata);die;
		


    	
    	$data = [];
    	$finaldata = [];
    	$indexkey =[];

    	foreach ($tansaction_data as $key => $value) 
    	{
    		$indexkey[$value['id']][] = $value;
    		foreach ($indexkey as $key1 => $value1) 
    		{


    			if($key1 = $value['id'])
    			{
    				
			    		$data[$key1]['id'] = $value['id'];
			    		$data[$key1]['transaction_id'] = $value['transaction_id'];
			    		$data[$key1]['campaign_id'] = $value['campaign_id'];
			    		$data[$key1]['user_id'] = $value['user_id'];
			    		$data[$key1]['payment_gateway_id'] = isset($value['payment_gateway_id'])?$value['payment_gateway_id']:'null';
			    		$data[$key1]['status'] = $value['status'];
			    		$data[$key1]['created_on'] = $value['created_on'];
			    		$data[$key1]['post_title'] = $value['post_title'];
						
			    		if(strpos($value['meta_key'], 'shipping') !== false)
			    		{
			    				$data[$key1]['shipping_info'][$key] = array($value['meta_key'] => $value['meta_value']);
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
	    			$transvalue['reward_id'][$key2] = isset($transvalue['reward_id'])?$transvalue['reward_id']:'';
	    			
	    		}

	    	
				$exceldata[$key2]['Date'] =$transvalue['created_on'];
	    		$reward_id = is_array($transvalue['reward_id']) ? $transvalue['reward_id'][$key2] : intval($transvalue['reward_id']);

	    		$exceldata[$key2]['Order no'] ="wbf_".$transvalue['user_id']."_".$transvalue['campaign_id']."_".$reward_id."_".$transvalue['transaction_id'];
	    		$exceldata[$key2]['Payment gateway order no'] =isset($transvalue['payment_gateway_id']) ? $transvalue['payment_gateway_id'] : '';
	    		$exceldata[$key2]['Status'] = is_array($transvalue['status']) ? $transvalue['status'][$key2] : $transvalue['status'];

		    	if($exceldata[$key2]['Status'] == 1)
		    	{
		    		$exceldata[$key2]['Status'] = 'Initiated';
		    	}

		    	if($exceldata[$key2]['Status'] == 2)
		    	{
		    		$exceldata[$key2]['Status'] = 'Submitted';
		    	}
		    	
		    	if($exceldata[$key2]['Status'] == 3)
		    	{
		    		$exceldata[$key2]['Status'] = 'Pending';
		    	}
		    	
		    	if($exceldata[$key2]['Status'] == 4)
		    	{
		    		$exceldata[$key2]['Status'] = 'Successful';
		    	}
		    	
		    	if($exceldata[$key2]['Status'] == 5)
		    	{
		    		$exceldata[$key2]['Status'] = 'Failed';
		    	}
		    	
		    	if($exceldata[$key2]['Status'] == 6)
		    	{
		    		$exceldata[$key2]['Status'] = 'Deleted';
		    	}
		    	
		    	if($exceldata[$key2]['Status'] == 7)
		    	{
		    		$exceldata[$key2]['Status'] = 'Cancelled';
		    	}
		    	
		    	if($exceldata[$key2]['Status'] == 8)
		    	{
		    		$exceldata[$key2]['Status'] = 'On the Way';
		    	}
		    	
		    	if($exceldata[$key2]['Status'] == 9)
		    	{
		    		$exceldata[$key2]['Status'] = 'Deferred by Customer';
		    	}

	    		$exceldata[$key2]['Campaign name'] =$transvalue['post_title'];
	    		$exceldata[$key2]['User ID'] = $transvalue['user_id'];
		    	$exceldata[$key2]['Reward'] = $reward_id ;

	    		if(isset($transvalue['shipping_info'])){
	    		$exceldata[$key2]['Shipping country'] = array_unique(array_column($transvalue['shipping_info'],'shipping_country'));
		    	$exceldata[$key2]['Shipping country'] = !empty($exceldata[$key2]['Shipping country']) ? $exceldata[$key2]['Shipping country'][0] : ''; 
		    	$shipping_city = array_unique(array_column($transvalue['shipping_info'],'shipping_city'));
		    	$exceldata[$key2]['Shipping city'] = !empty($shipping_city) ? $shipping_city[0] : '';
		    	$exceldata[$key2]['Shipping code'] = array_unique(array_column($transvalue['shipping_info'],'shipping_pin'));
		    	$exceldata[$key2]['Shipping code']  = !empty($exceldata[$key2]['Shipping code']) ? $exceldata[$key2]['Shipping code'][0] : ''; 
		    	}

		    }

	    }

			krsort($exceldata);
			$sorted_data_excel = array();
			foreach($exceldata as $k=>$v) {
				$sorted_data_excel[$k] = $v;
			}

	    
	    	/*echo "<pre>";print_r($sorted_data_excel);die;*/

	    	$filename = 'All transactions old data';
	    	\Excel::create($filename, function($excel) use ($filename, $sorted_data_excel) {

			        // Set the title
			        $excel->setTitle($filename);

			        // Chain the setters
			        $excel->setCreator('Damilola Ogunmoye');

			        $excel->sheet('SHEETNAME', function($sheet) use ($sorted_data_excel) {


			            $sheet->fromArray($sorted_data_excel);

			        });

				})->download('xls');
	    

	}


}

<?php

namespace App\Http\Controllers;

use App\Model\AllTransaction;
//use Maatwebsite\Excel\Excel;
use Input;

use Illuminate\Http\Request;

use App\Http\Requests;

class SuccessGenExcel extends Controller
{
     public function generate_excel_success()
    {
    	$tansaction_data = AllTransaction::all_success_trans_data();
    	
    	$post_report = [];
    	$postindexkey = [];
    	$post_data = AllTransaction::post_data();

    	foreach ($post_data as $key4 => $value4) {
    		$value4 = (array) $value4;
    		$postindexkey[$value4['post_id']][] = $value4;
    		foreach ($postindexkey as $key5 => $value5) 
    		{

    			if($key1 = $value4['post_id'])
    			{

		    		if(strpos($value4['meta_key'],'total_contribution')!== false)
		    		{
		    			
		    			  $post_report['total_contribution'] = $value4['meta_value'];
		    			
		    		}
		    		if(strpos($value4['meta_key'],'target')!== false)
		    		{
		    			
		    			  $post_report['target'] = $value4['meta_value'];
		    			
		    		}
				}
			}
    	}


    	if($post_report['total_contribution'] >= $post_report['target'])
    	{
    		
    	
    	
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
				    		$data[$key1]['type'] = $value['type'];
				    		$data[$key1]['amount']= $value['amount'];
				    		$data[$key1]['payment_gateway'] = $value['payment_gateway'];
				    		$data[$key1]['payment_gateway_id'] = $value['payment_gateway_id'];
				    		$data[$key1]['status'] = $value['status'];
				    		$data[$key1]['created_on'] = $value['created_on'];
				    		$data[$key1]['post_title'] = $value['post_title'];
							
				    		
				    		if (strpos($value['meta_key'],'service_tax')!== false) {
				    			$data[$key1]['service_tax'] = $value['meta_value'];
				    			
				    		}
				    		if (strpos($value['meta_key'],'commission')!== false) {
				    			$data[$key1]['commission'] = $value['meta_value'];
				    			
				    		}
				    		if (strpos($value['meta_key'],'total_cost')!== false) {
				    			$data[$key1]['total_cost'] = $value['meta_value'];
				    			
				    		}
				    		
				    }
	    		}

	    	}

    	
	    	$wishberry_commision = '';
	    	$i=0;
	    	foreach ($data as  $key2 => $transvalue) 
	    	{
	    		
	    		if($key2 = $transvalue['id'])
	    		{
	    			
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
		    	

		    	$exceldata[$key2]['Transaction Date'] = $transvalue['created_on'];
		    	$exceldata[$key2]['Transaction ID'] = $transvalue['transaction_id'];
		    	
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
		    	
		    	if(is_string($exceldata[$key2]['Amount']))
		    	{
		    		$exceldata[$key2]['Commissions'] = 'null' ;
		    		$exceldata[$key2]['Service tax on commissions'] = 'null' ;
		    		$exceldata[$key2]['PG costs excluding service tax'] = 'null';
		    		$exceldata[$key2]['Service Tax on PG Cost'] = 'null';
		    		$exceldata[$key2]['Margins (=commissions - PG costs)'] = 'null';
		    		$exceldata[$key2]['Net amount to transfer (=amount - margins)'] = 'null';
		    		$exceldata[$key2]['PG UTR'] = 'null';
		    	}else{
		    		$exceldata[$key2]['Commissions'] = 10/100 * $exceldata[$key2]['Amount'] ;
		    		$exceldata[$key2]['Service tax on commissions'] = 14.5/100 * $exceldata[$key2]['Commissions'] ;
		    		$exceldata[$key2]['PG costs excluding service tax'] = 2/100 * $exceldata[$key2]['Amount'] -(14.5/100) ;
		    		$exceldata[$key2]['Service Tax on PG Cost'] = 14.5/100 * (2/100 * $exceldata[$key2]['Amount']);
		    		$exceldata[$key2]['Margins (=commissions - PG costs)'] = $exceldata[$key2]['Commissions'] - (2/100 * $exceldata[$key2]['Amount']) ;
		    		$exceldata[$key2]['Net amount to transfer (=amount - margins)'] = $exceldata[$key2]['Amount'] -$exceldata[$key2]['Margins (=commissions - PG costs)'];
		    		$exceldata[$key2]['PG UTR'] = 'null';
		    	}

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AllPost;
use Input;

use App\Http\Requests;

class Post extends Controller
{
     public function post_data()
    {
    	$post_data = AllPost::all_post_data();
    	$data = [];
    	
    	foreach ($post_data as $key => $value) 
    	{
    	

    		$value = (array) $value;
    		
    		$data['post_author'] = $value['post_author'];
    		$data['post_date'] = $value['post_date'];
    		$data['post_date_gmt'] = $value['post_date_gmt'];
    		$data['post_content'] = $value['post_content'];
    		$data['post_title'] = $value['post_title'];
    		$data['ping_status'] = $value['ping_status'];
    		$data['post_name'] = $value['post_name'];
    		$data['post_type'] = $value['post_type'];

    		if(strpos($value['meta_key'], 'contributor_message') !== false)
    		{
    			
    			  $data['contributor_message'][$key] = $value['meta_key'].':'. $value['meta_value'] ;
    			
    			
    		}
    		if(strpos($value['meta_key'],'description_')!== false)
    		{
    			
    			  $data['description'][$key] = $value['meta_key'].':'. $value['meta_value'] ;
    			
    		}
    		if (strpos($value['meta_key'],'target')!== false) {
    			 $data['target'] = $value['meta_value'];
    			
    		}
    		if (strpos($value['meta_key'],'budget')!== false) {
    			
    			  $data['budget'] = $value['meta_value'];
    			
    		}
    		if (strpos($value['meta_key'],'launch_status')!== false) {
    			$data['launch_status'] = $value['meta_value'];
    			
    		}
    		if (strpos($value['meta_key'],'launch_status_date')!== false) {
    			$data['launch_status_date'] = $value['meta_value'];
    			
    		}
    		if (strpos($value['meta_key'],'payment_type')!== false) {
    			$data['payment_type'] = $value['meta_value'];
    			
    		}
    		if (strpos($value['meta_key'],'facebook_')!== false || strpos($value['meta_key'],'twitter_')!== false || strpos($value['meta_key'],'fb_')!== false) {
    				$data['social_media_data'][$key] = $value['meta_key'].':'. $value['meta_value'] ;
    				
    		}
    		if (strpos($value['meta_key'],'team_')!== false) {
    			$data['team'][$key] = $value['meta_key'].':'. $value['meta_value'] ;
    			
    		}
    		if (strpos($value['meta_key'],'faq')!== false) {
    			$data['faq'][$key] = $value['meta_key'].':'. $value['meta_value'] ;
    			
    		}
    		if (strpos($value['meta_key'],'campaign_foreign')!== false) {
    			$data['campaign_foreign'][$key] = $value['meta_value'];
    			
    		}
    		if (strpos($value['meta_key'],'video')!== false) {
    			$data['video'][$key] = $value['meta_key'].':'. $value['meta_value'] ;
    			
    		}
    	}
    	
    			$result = array();
    			$result = new AllPost();
				$result->post_author = $data['post_author'];
				$result->post_date = $data['post_date'];
				$result->post_date_gmt = $data['post_date_gmt'];
				$result->post_content = $data['post_content'];
				$result->post_title = $data['post_title'];
				$result->ping_status = $data['ping_status'];
				$result->post_name = $data['post_name'];
				$result->post_type = $data['post_type'];
				$result->contributor_message = json_encode(array_values(array_unique($data['contributor_message'])));
				$result->target = $data['target'];
				$result->launch_status = $data['launch_status'];
				$result->launch_status_date = $data['launch_status_date'];
				$result->social_media_data = json_encode(array_values(array_unique($data['social_media_data'])));
				$result->description = json_encode(array_values(array_unique($data['description'])));
				$result->budget = $data['budget'];
				$result->team = json_encode(array_values(array_unique($data['team'])));
				$result->faq = json_encode(array_values(array_unique($data['faq'])));
				$result->campaign_foreign = json_encode(array_values(array_unique($data['campaign_foreign'])));
				$result->video = json_encode(array_values(array_unique($data['video'])));
				


		    	$result->save();
    }

}

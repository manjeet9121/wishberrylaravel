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

    	

    	$indexkey = [];
    	$data = [];
    	$result = [];
    	
    	foreach ($post_data as $key => $value) 
    	{
    	
    		$value = (array) $value;
    		$indexkey[$value['id']][] = $value;

			foreach ($indexkey as $key1 => $value1) 
    		{
				if($key1 = $value['id'])
    			{
    				$data[$key1]['post_id'] = $value['id'];
    				$data[$key1]['post_author'] = $value['post_author'];
		    		$data[$key1]['post_date'] = $value['post_date'];
		    		$data[$key1]['post_date_gmt'] = $value['post_date_gmt'];
		    		$data[$key1]['post_content'] = $value['post_content'];
		    		$data[$key1]['post_title'] = $value['post_title'];
		    		$data[$key1]['ping_status'] = $value['ping_status'];
		    		$data[$key1]['post_name'] = $value['post_name'];
		    		$data[$key1]['post_type'] = $value['post_type'];
		    		

		    		if(strpos($value['meta_key'], 'contributor_message') !== false){
			    		$data[$key1]['contributor_message'][$key] = array($value['meta_key'] => $value['meta_value']);
			    		}
			    	if(strpos($value['meta_key'],'description_')!== false){
			    			$data[$key1]['description'][$key] = array($value['meta_key'] => $value['meta_value']) ;
			    		}
			    	if (strpos($value['meta_key'],'target')!== false){
			    			 $data[$key1]['target'] = $value['meta_value'];
			    		}
			    	if (strpos($value['meta_key'],'budget')!== false) {
			    			$data[$key1]['budget'] = $value['meta_value'];
			    		}
			    	if (strpos($value['meta_key'],'launch_status')!== false) {
			    			$data[$key1]['launch_status'] = $value['meta_value'];
			    		}
			    	if (strpos($value['meta_key'],'launch_status_date')!== false) {
			    			$data[$key1]['launch_status_date'] = $value['meta_value'];
			    		}
			    	if (strpos($value['meta_key'],'payment_type')!== false) {
			    			$data[$key1]['payment_type'] = $value['meta_value'];
			    		}
			    	if (strpos($value['meta_key'],'facebook_')!== false || strpos($value['meta_key'],'twitter_')!== false || strpos($value['meta_key'],'fb_')!== false ) 
			    		{
			    				if(strpos($value['meta_key'], "description_") === false and strpos($value['meta_key'], "team_") === false )
			    				{
			    					$data[$key1]['social_media_data'][$key] = array($value['meta_key'] => $value['meta_value']) ;
			    				}
			    				
			    		}
			    	if (strpos($value['meta_key'],'team_')!== false) {
			    			$data[$key1]['team'][$key] = array($value['meta_key'] => $value['meta_value']) ;
			    			
			    		}
			    	if (strpos($value['meta_key'],'faq')!== false) {
			    			$data[$key1]['faq'][$key] = array($value['meta_key'] => $value['meta_value']) ;
			    		}
			    	if (strpos($value['meta_key'],'campaign_foreign')!== false) {
			    			$data[$key1]['campaign_foreign'][$key] =  array($value['meta_key'] => $value['meta_value']);
			    	}
			    	if (strpos($value['meta_key'],'video')!== false) {
			    			$data[$key1]['video'][$key] = array($value['meta_key'] => $value['meta_value']) ;
			    	}
		    	}

			}
		}	
    	 	
    	
    	foreach ($data as $key2 => $value2) 
	 	{
	 		
	 		$contributor_message = json_encode(array_values(isset($value2['contributor_message']) ? $value2['contributor_message'] : ['null']));
	 		
	 		$social_media_data = json_encode(array_values(isset($value2['social_media_data']) ? $value2['social_media_data'] : ['null']));

	 		$description = json_encode(array_values(isset($value2['description']) ? $value2['description'] : ['null']));

			$team = json_encode(array_values(isset($value2['team']) ? $value2['team'] : ['null']));
			$faq = json_encode(array_values(isset($value2['faq']) ? $value2['faq'] : ['null']));
			$campaign_foreign = json_encode(array_values(isset($value2['campaign_foreign']) ? $value2['campaign_foreign'] : ['null']));
			$video = json_encode(array_values(isset($value2['video']) ? $value2['video'] : ['null']));

			
	 		$result[] = array('post_id' => $value2['post_id'],'post_author' => isset($value2['post_author']) ? $value2['post_author'] : 'null',
							  'post_date' => $value2['post_date'],'post_date_gmt' => $value2['post_date_gmt'],'post_content' => $value2['post_content'],'post_title' => $value2['post_title'],'ping_status' => $value2['ping_status'],'post_name' => $value2['post_name'],'post_type' => $value2['post_type'],'contributor_message' => $contributor_message,'target' => $value2['target'],'launch_status' => $value2['launch_status'],'launch_status_date' => $value2['launch_status_date'],'social_media_data' => $social_media_data,'description' => $description,'budget' => isset($value2['budget']) ? $value2['budget'] : 'null','team' => $team,'faq' => $faq,'campaign_foreign' => $campaign_foreign,'video' => $video);


	 	}

	 	AllPost::insert($result);

		echo "Success Done";
	}
}

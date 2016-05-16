<?php

namespace App\Model;
use DB;

use Illuminate\Database\Eloquent\Model;

class AllPost extends Model
{
	public $timestamps = false;
    protected $table = 'wp_all_post';
    protected $fillable = array('post_author', 'post_date','post_date_gmt', 'post_content', 'post_title', 'ping_status','post_name','post_type','contributor_message','target','launch_status','launch_status_date','budget','campaign_foreign','faq','team','description','social_media_data','video');
    

    public static function all_post_data()
    {
	    	$transation_data = DB::select(DB::raw("select a.id,a.post_author,a.post_date,a.post_date_gmt,a.post_content,a.post_title,a.ping_status,a.post_name,
a.post_type,b.* from wp_posts a ,wp_postmeta b where a.id = 19826 and b.post_id = 19826 and a.post_type like '%campaign%'
				"));

           return $transation_data;

    }



}

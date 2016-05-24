<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*Route::get('/', function(){
   echo "sdfsdkfsdjkfhjf";die;
});
*/

 Route::get('phpinfo', function() {
 echo phpinfo();
});


Route::get('/', function () {
    return view('welcome');
});


Route::get('/datamigration', 'User@tansaction_data');

Route::get('/postdatamigration', 'Post@post_data');


Route::get('/excelgen','GenExcel@generate_excel');


Route::get('/successexcelgen','SuccessGenExcel@generate_excel_success');



Route::get('/olddata','OldData@wb_get_contributions');


Route::get('/queuetrans','Queuetrans@queue_contributions');


Route::get('/checkqueue',function()
{
	$queue = Queue::push('LogMessage',array('message'=>'Time'.time()));
	//echo "<pre>";print_r($queue);die;
	return $queue;
});

Class LogMessage {

	public function fire($job,$data)
	{
		//echo "<pre>";print_r($job);die;
		echo $data['message'];
		File::append(app_path().'/queue.txt',$data['message'].PHP_EOL);
		$job->delete();
	}
}


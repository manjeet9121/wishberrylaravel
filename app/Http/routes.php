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


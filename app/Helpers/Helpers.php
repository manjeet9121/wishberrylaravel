<?php

namespace App\Helpers;

class Helpers {


	/*public static function getCurlRes($url) {
		$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	$re = curl_exec($ch);
    	curl_close($ch);

    	return $re;
	}*/


	

	/*
	 * postCurlRes
	 *
	 */

	/*public static function postCurlRes($url, $postdata, $header = '') {
		$crl = curl_init();
		curl_setopt($crl, CURLOPT_URL, $url);
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($crl, CURLOPT_VERBOSE, 0);
		curl_setopt($crl, CURLOPT_POST, 1);
		curl_setopt($crl, CURLOPT_POSTFIELDS,$postdata);
		curl_setopt($crl, CURLOPT_TIMEOUT, 5);
		if($header != ''){
			curl_setopt($crl, CURLOPT_HTTPHEADER. $header);
		}
		$resp = curl_exec($crl);
		if ($resp === false) {
			error_log('Curl error: ' . curl_error($crl));
		}
		curl_close($crl);
		return $resp;
	}*/

	/*public static function youtubeIdFromUrl($url) {
		$pattern = '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x'
		;
		$result = preg_match($pattern, $url, $matches);
		if ((false !== $result) && (0 != $result)) {
			return $matches[1];
		}
		return false;
	}*/

	

	/*
	 * object2array
	 */

	public static function object2array($object) {
		return @json_decode(@json_encode($object), 1);
	}

   



}

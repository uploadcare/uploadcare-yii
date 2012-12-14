<?php

include dirname(__FILE__).'/uploadcare-php/uploadcare/lib/5.2/Uploadcare.php';

class CUploadcare
{
	/**
	 * @var Uploadcare_Api
	 **/
	static $api = null;
	
	public static function api()
	{
		if (!self::$api) {
			$config = Yii::app()->params->uploadcare;
			self::$api = new Uploadcare_Api($config['public_key'], $config['secret_key']);
		}
		return self::$api;		
	}
}
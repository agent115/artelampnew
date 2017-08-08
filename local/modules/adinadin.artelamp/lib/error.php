<?php
/**
 * Created by PhpStorm.
 * User: Vampiref92
 * Date: 02.11.2015
 * Time: 9:47
 */

namespace AdinAdin\Artelamp;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

Class Errors
{
	protected $error;
	protected $obError;
	protected $Application;
	private static $_instance = null;

	public function __construct(){
		$this->error = false;
		$this->Application = $GLOBALS['APPLICATION'];
		$this->obError = new \CAdminException(array());
	}

	public static function getInstance(){
		if(is_null(self::$_instance))
		{
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	public function setError ($msg)
	{
		$this->error = true;
		$this->obError->AddMessage(
				array(
						"text" => $msg
				)
		);
	}

	/**
	 * @param bool $bShowError
	 * @return bool
	 */
	public function setErrors ($bShowError = false)
	{
		if ($this->error && !empty($this->obError)) {
			$this->Application->ThrowException($this->obError);
			if ($bShowError && $err = $this->Application->GetException())
				ShowError($err->GetString());

			return false;
		}

		return true;
	}

	public function clear(){
		$this->error = false;
		$this->obError = new \CAdminException(array());
	}

	public function clearErrors(){
		$this->error = false;
		$this->obError = new \CAdminException(array());
	}

	/**
	 * @return boolean
	 */
	public function isError ()
	{
		return $this->error;
	}
	public function getErrors(){
		return $this->obError->GetMessages();
	}
}
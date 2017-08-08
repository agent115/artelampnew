<?php

/**
 * Created by PhpStorm.
 * User: Vampiref92
 * Date: 05.10.2015
 * Time: 16:40
 */

namespace AdinAdin\Artelamp;

use \Bitrix\Main\Loader;

class Auth
{
	protected static $errors;

	public function OnBeforeUserAddHandler(&$arArgs){
		self::initErrors();

		if (empty($arArgs['EMAIL'])) {
			self::$errors->setError('Не указан email');
		} else {
			if (false !== strpos($arArgs['EMAIL'], '@')) {
				$arArgs['LOGIN'] = $arArgs['EMAIL'];
			} else {
				self::$errors->setError('Не верно указан email');
			}
		}

		$user_group_id = 9;

		/*if($_POST['USER_TYPE'] == 'retail')
			$user_group_id = 9;
		elseif($_POST['USER_TYPE'] == 'opt')
			$user_group_id = 10;*/

		if (!empty($arArgs['GROUP_ID'])){
			if (!is_array($arArgs['GROUP_ID'])){
				$tmp_group = $arArgs['GROUP_ID'];
				$arArgs['GROUP_ID'] = array($tmp_group);
				unset($tmp_group);
			}
		}
		else{
			$arArgs['GROUP_ID'] = array();
		}

		$arArgs['GROUP_ID'] = array_merge($arArgs['GROUP_ID'], array($user_group_id));
	}

	/**
	 * @param $arArgs
	 * @return bool
	 */
	public function OnBeforeUserRegisterHandler (&$arArgs)
	{
		self::initErrors();

		$arArgs['PERSONAL_PHONE'] = preg_replace('#[^0-9]#', '', $_REQUEST['USER_PERSONAL_PHONE']);
		$arArgs['SECOND_NAME'] = $_REQUEST['USER_SECOND_NAME'];

		if (!isset($_REQUEST['ConfirmLicense']) || empty($_REQUEST['ConfirmLicense'])) {
			self::$errors->setError('Для регистрации необходимо подтвердить дееспособность и дать согласие на обработку персональных данных');
		}

		if (empty($arArgs['EMAIL'])) {
			self::$errors->setError('Не указан email');
		} else {
			if (false !== strpos($arArgs['EMAIL'], '@')) {
				$arArgs['LOGIN'] = $arArgs['EMAIL'];
			} else {
				self::$errors->setError('Не верно указан email');
			}
		}

		if (empty($arArgs['PERSONAL_PHONE'])) {
			self::$errors->setError('Не указан мобильный телефон или указан неверно');
		}

		$bPasswordOK = true;
		if (empty($arArgs['PASSWORD'])) {
			$bPasswordOK = false;
			self::$errors->setError('Не указан пароль');
		}

		if (empty($arArgs['CONFIRM_PASSWORD'])) {
			$bPasswordOK = false;
			self::$errors->setError('Не указано подтверждение пароля');
		}

		if ($bPasswordOK && $arArgs['CONFIRM_PASSWORD'] !== $arArgs['PASSWORD']) {
			self::$errors->setError('Пароли не совпадают');
		}

		$arArgs['PERSONAL_BIRTHDAY'] = $_REQUEST['USER_PERSONAL_BIRTHDAY'];

		if (!empty($_POST['USER_TYPE'])){
			$user_group_id = 9;

			if($_POST['USER_TYPE'] == 'retail')
				$user_group_id = 9;
			elseif($_POST['USER_TYPE'] == 'opt')
				$user_group_id = 10;

			if (!empty($arArgs['GROUP_ID'])){
				if (!is_array($arArgs['GROUP_ID'])){
					$tmp_group = $arArgs['GROUP_ID'];
					$arArgs['GROUP_ID'] = array($tmp_group);
					unset($tmp_group);
				}
			}
			else{
				$arArgs['GROUP_ID'] = array();
			}

			$arArgs['GROUP_ID'] = array_merge($arArgs['GROUP_ID'], array($user_group_id));
		}
		else {
			self::$errors->setError('Не выбран тип покупателя');
		}

		if (self::$errors->setErrors() === false)
			return false;

		return $arArgs;
	}

	public function OnAfterUserAddHandler (&$arFields)
	{
		if($arFields["ID"]>0){
			if (Loader::includeModule('sale')) {
				$arUserResult["PROFILE_ID"] = false;
				$arUserResult["PROFILE_NAME"] = false;
				$arUserResult["PERSON_TYPE_ID"] = intval($_REQUEST['PERSON_TYPE']);
				$arUserResult["ORDER_PROP"] = array();
				/*$sAddress = '';
				foreach ($_POST as $key => $val) {
					if (false !== strpos($key, 'PROFILE_ADDRESS_')) {
						$sAddress += $val + ' ';
						unset($_POST[$key]);
					}
				}
				$_POST['PROFILE_ADDRESS'] = trim($sAddress);*/
				foreach ($_POST as $key => $val) {
					if (false !== strpos($key, 'PROFILE_')) {
						$formated_key = str_replace('PROFILE_', '', $key);
						$arUserResult["ORDER_PROP"][$formated_key] = $val;
					}
				}
				$arResult["ERROR"] = false;

				$dbOrderProperties = \CSaleOrderProps::GetList(
						array(),
						array("PERSON_TYPE_ID" => $arUserResult["PERSON_TYPE_ID"], "ACTIVE" => "Y", "UTIL" => "N", "USER_PROPS" => "Y"),
						false,
						false,
						array("ID", "TYPE", "NAME", "CODE")
				);
				$arNewOrderProps = array();
				while ($arOrderProperty = $dbOrderProperties->Fetch())
				{
					$arNewOrderProps[$arOrderProperty['ID']] = $arUserResult["ORDER_PROP"][$arOrderProperty['CODE']];
				}
				$arUserResult["ORDER_PROP"] = $arNewOrderProps;
				//add profile
				\CSaleOrderUserProps::DoSaveUserProfile(
						$arFields["ID"],
						$arUserResult["PROFILE_ID"],
						$arUserResult["PROFILE_NAME"],
						$arUserResult["PERSON_TYPE_ID"],
						$arUserResult["ORDER_PROP"],
						$error
				);
			}

			if (Loader::includeModule('sender')) {
				$mailingIdList = array();
				foreach ($_POST as $key => $val) {
					if (false !== strpos($key, 'Subscribe_')) {
						$mailingIdList[] = $val;
						unset($_POST[$key]);
					}
				}
				AddMessage2Log($mailingIdList, 'mailingIdList');
				\Bitrix\Sender\Subscription::add($_POST["USER_EMAIL"], $mailingIdList, SITE_ID);
			}
		}
	}

	public function OnBeforeUserLoginHandler(&$arFields)
	{
		if (isset($_POST['USER_LOGIN']))
		{
			$e = strpos($_POST['USER_LOGIN'], "@");
			if ((int)$e > 0)
			{
				self::initErrors();
				$filter = Array( "EMAIL" => $_POST['USER_LOGIN']);
				$rsUsers = \CUser::GetList(($by="id"), ($order="desc"), $filter);
				if($res = $rsUsers->Fetch()){
					$arFields["LOGIN"]=$res['LOGIN'];
				}
				else {
					self::$errors->setError('Не найден email');
				}
			}
		}
	}

	/**
	 * @param mixed $errors
	 */
	protected static function initErrors ()
	{
		if(Loader::includeModule('adinadin.growup')){
			self::$errors = \AdinAdin\Artelamp\Errors::getInstance();
			self::$errors->clearErrors();
		}
	}
}
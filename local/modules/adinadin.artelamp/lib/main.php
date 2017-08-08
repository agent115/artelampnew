<?php
/**
 * Created by PhpStorm.
 * User: Vampiref92
 * Date: 16.10.2015
 * Time: 15:25
 */

namespace AdinAdin\Artelamp;

Class Main {
	protected static $instance;

	public static function getInstance()
	{
		if (!isset(self::$instance))
		{
			$c = __CLASS__;
			self::$instance = new $c;
		}

		return self::$instance;
	}

	/**
	 *
	 */
	public function setPageLangValues(){
		global $arCurLanguage, $APPLICATION;

		if ($arCurLanguage['IS_NONE_RU']){
			$arLanguageProps = array(
				'description'.$arCurLanguage['POSTFIX_ORIGINAL'] => '',
				'keywords'.$arCurLanguage['POSTFIX_ORIGINAL'] => '',
				'title'.$arCurLanguage['POSTFIX_ORIGINAL'] => '',
				'keywords_inner'.$arCurLanguage['POSTFIX_ORIGINAL'] => '',
				'main_title'.$arCurLanguage['POSTFIX_ORIGINAL'] => ''
			);

			foreach ($arLanguageProps as $prop_id => $val){
				$val = $APPLICATION->GetDirProperty($prop_id);
				$base_prop_id = str_replace($arCurLanguage['POSTFIX_ORIGINAL'], '', $prop_id);
				if (!empty($val)){
					if ($base_prop_id == 'main_title'){
						$APPLICATION->SetTitle($val);
					}
					else {
						$APPLICATION->SetDirProperty($base_prop_id, $val);
					}
					$arLanguageProps[$prop_id] = $val;
				}

				$val = $APPLICATION->GetPageProperty($prop_id);
				if (!empty($val)){
					if ($base_prop_id == 'main_title'){
						$APPLICATION->SetTitle($val);
					}
					else {
						$APPLICATION->SetPageProperty($base_prop_id, $val);
					}
					$arLanguageProps[$prop_id] = $val;
				}
			}
		}
	}

	public function setCurrentPage($arAdditional = false){
		global $arCurPage, $APPLICATION;

		$arCurPage['DIR'] = $APPLICATION->GetCurDir();
		$arCurPage['PAGE'] = $APPLICATION->GetCurPage();
		$arCurPage['PAGE_INDEX'] = $APPLICATION->GetCurPage(true);
		$arCurPage['IS_INDEX'] = false;
		if ($arCurPage['PAGE'] == SITE_DIR && $arCurPage['PAGE_INDEX'] == SITE_DIR . 'index.php')
			$arCurPage['IS_INDEX'] = true;

		if($arAdditional != false && is_array($arAdditional) && !empty($arAdditional)){
			foreach($arAdditional as $arPath){
				$arCurPage[$arPath['NAME']] = false;
				$arCurPage[$arPath['NAME'].'_INDEX'] = false;
				if (false !== strpos($arCurPage['PAGE'], $arPath['PATH'])) {
					$arCurPage[$arPath['NAME']] = true;
					if (false !== strpos($arCurPage['PAGE_INDEX'], $arPath['PATH'] . 'index.php'))
						$arCurPage[$arPath['NAME'].'_INDEX'] = true;
					//echo '<pre>',var_dump($arCurPage['PAGE_INDEX']),'</pre>';
				}
			}
		}
	}

	public function setLanguageVars(){
		global $arCurLanguage;

		$arCurLanguage['IS_NONE_RU'] = false;
		$arCurLanguage['POSTFIX'] = '';
		if (LANGUAGE_ID != 'ru') {
			$arCurLanguage['IS_NONE_RU'] = true;
			$arCurLanguage['POSTFIX'] = '_' . toUpper(LANGUAGE_ID);
			$arCurLanguage['POSTFIX_ORIGINAL'] = '_' . LANGUAGE_ID;
			$arCurLanguage['POSTFIX_MINI'] = '_' . toLower(LANGUAGE_ID);
		}
	}

	public function setCurrentUser($arGroups = false, $bAddUserGroups = false){
		global $arCurUser, $USER;
		$arCurUser = array();
		$arCurUser['AUTH'] = $USER->IsAuthorized();
		if($arCurUser['AUTH']) {
			$arCurUser['ID'] = $USER->GetID();
			$arCurUser['FULL_NAME'] = $USER->GetFullName();
			$arCurUser['LAST_NAME'] = $USER->GetLastName();
			$arCurUser['NAME'] = $USER->GetFirstName();
			$arCurUser['LOGIN'] = $USER->GetLogin();
			if (!empty($arCurUser['LAST_NAME'])){
				$arCurUser['FULL_NAME_MINI'] = $arCurUser['LAST_NAME'];
				if (!empty($arCurUser['NAME']))
					$arCurUser['FULL_NAME_MINI'] .= ' '.substr($arCurUser['NAME'], 0, 1).'.';
			}
			else {
				$arCurUser['FULL_NAME_MINI'] = $arCurUser['LOGIN'];
			}
		}
		//pp($arCurUser);
		if($arGroups != false && is_array($arGroups) && !empty($arGroups)) {
			if ($arCurUser['AUTH']) {
				$user_groups = $USER->GetUserGroupArray();
				if ($bAddUserGroups){
					$arCurUser['GROUPS'] = $user_groups;
				}
				foreach($arGroups as $arGroup) {
					$arCurUser[$arGroup['NAME']] = false;
					if (in_array($arGroup['ID'], $user_groups)) {
						$arCurUser[$arGroup['NAME']] = true;
					}
				}
			} else {
				foreach($arGroups as $arGroup) {
					if ($arGroup['DEFAULT'] == 'Y'){
						$arCurUser[$arGroup['NAME']] = true;
						break;
					}
				}
			}
		}
	}

	public static function pluralForm ($n, $forms)
	{
		return $n % 10 == 1 && $n % 100 != 11 ? $forms[0] : ($n % 10 >= 2 && $n % 10 <= 4 && ($n % 100 < 10 || $n % 100 >= 20) ? $forms[1] : $forms[2]);
	}
}
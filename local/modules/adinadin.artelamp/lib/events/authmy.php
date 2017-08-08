<?php

/**
 * Created by PhpStorm.
 * User: Vampiref92
 * Date: 05.10.2015
 * Time: 16:40
 */

namespace AdinAdin\Artelamp\Events;



use \Bitrix\Main\Loader;

class Authmy
{


	public function OnBeforeUserAddHandler(&$arArgs){


		if (!empty($arArgs['EMAIL'])) {
			if (false !== strpos($arArgs['EMAIL'], '@')) {
				$arArgs['LOGIN'] = $arArgs['EMAIL'];
			}
		}
		return $arArgs;
	}

	/**
	 * @param $arArgs
	 * @return bool
	 */

}
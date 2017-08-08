<? namespace AdinAdin\Artelamp;

use Bitrix\Main\Loader;

if (!Loader::includeModule('highloadblock')){
	global $APPLICATION;
	$APPLICATION->ThrowException('Не подключени модуль Highload блока');
}

use Bitrix\Main;
use Bitrix\Main\Entity;

//$eventManager->registerEventHandler();

class HLEvents{
	protected static $instance;

	/**
	 * @return mixed
	 */
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
	 * @param Entity\Event $event
	 */
	public function onAfterChangeItem(Entity\Event $event){
		$arParams = $event->getParameters();

		AddMessage2Log(print_r($arParams, true), 'arParams => ');

		global $CACHE_MANAGER;
		$CACHE_MANAGER->ClearByTag('hl_block_'.$arParams['HLBLOCK_ID']);
	}

	/**
	 * @param Entity\Event $event
	 */
	public function onAfterChangeColumn(Entity\Event $event){
		$arParams = $event->getParameters();

		global $CACHE_MANAGER;
		$CACHE_MANAGER->ClearByTag('hl_block_'.$arParams['IBLOCK_ID'].'_fields');
	}
}
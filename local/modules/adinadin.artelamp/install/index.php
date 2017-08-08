<?use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

global $server, $context;
$context = \Bitrix\Main\Application::getInstance()->getContext();
$server = $context->getServer();

if (class_exists('adinadin_artelamp'))
	return;

Class adinadin_artelamp extends CModule
{
	var $MODULE_ID = 'adinadin.artelamp';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $PARTNER_NAME;
	var $PARTNER_URI;
	var $PARTNER_CODE = 'adinadin';
	var $WIZARD_NAME = 'aretlamp';
	var $strError = '';

	/**
	 *
	 */
	function adinadin_artelamp()
	{
		$this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
		$this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESC');

		$this->PARTNER_NAME = GetMessage('PARTNER_NAME');
		$this->PARTNER_URI = GetMessage('PARTNER_URI');

		$arModuleVersion = array();
		include(dirname(__FILE__) . '/version.php');

		if (isset($arModuleVersion) && is_array($arModuleVersion) && !empty($arModuleVersion)) {
			$this->MODULE_VERSION = $arModuleVersion['VERSION'];
			$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		}
	}

	/**
	 * @param array $arParams
	 *
	 * @return bool
	 */
	function InstallDB($arParams = array())
	{
		\Bitrix\Main\ModuleManager::registerModule($this->MODULE_ID);
		return true;
	}

	/**
	 * @param array $arParams
	 *
	 * @return bool
	 */
	function UnInstallDB($arParams = array())
	{
		\Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
		return true;
	}


	/**
	 *
	 */
	function DoInstall()
	{
		global $USER, $APPLICATION, $step;

		if ($APPLICATION->GetGroupRight('main') < 'W' || !$USER->IsAdmin())
			return;

		if (!IsModuleInstalled($this->MODULE_ID))
		{
			$this->InstallDB();
		}
	}

	/**
	 *
	 */
	function DoUninstall()
	{
		global $APPLICATION, $USER;
		
		if ($APPLICATION->GetGroupRight('main') < 'W' || !$USER->IsAdmin())
			return;

		if (IsModuleInstalled($this->MODULE_ID))
		{
			$this->UnInstallDB();
		}
	}
}
?>
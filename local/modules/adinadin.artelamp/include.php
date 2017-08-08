<?
use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
	"adinadin.artelamp",
	array(
		"AdinAdin\\Artelamp\\HLAdditional" => "lib/hl.php",
		"AdinAdin\\Artelamp\\Main" => "lib/main.php",
		"AdinAdin\\Artelamp\\Errors" => "lib/error.php",
		"AdinAdin\\Artelamp\\CheckResources" => "lib/checkResources.php",
		"AdinAdin\\Artelamp\\CreateMultiLvlArray" => "lib/createMultiLvlArray.php",
	)
);
?>
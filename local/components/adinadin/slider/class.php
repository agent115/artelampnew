<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 06.04.2015
 * Time: 20:44
 */

use Bitrix\Main\Loader;
use AdinAdin\Artelamp\HLAdditional;

if (!Loader::includeModule('adinadin.artelamp'))
	die();

class CSliderComponent extends CBitrixComponent
{
	public function onPrepareComponentParams($arParams)
	{
		$arParams['IMG_WIDTH'] = intval($arParams['IMG_WIDTH']);
		$arParams['BLOCK_ID'] = intval($arParams['BLOCK_ID']);
		$arParams['IMG_HEIGHT'] = intval($arParams['IMG_HEIGHT']);
		$arParams['IMG_JPG_QUANTITY'] = intval($arParams['IMG_JPG_QUANTITY']);
		$arParams['COUNT_ON_PAGE'] = (!empty($arParams['COUNT_ON_PAGE'])) ? intval($arParams['COUNT_ON_PAGE']) : false;
		return $arParams;
	}

	public function executeComponent()
	{
		$this->arResult = false;

		/*************************************************************************
		Work with cache
		 *************************************************************************/
		if($this->StartResultCache(false, array(false)))
		{
			$resultCacheKeys = array(
				"BLOCK_ID",
				"ID"
			);

			$this->arResult['ITEMS'] = $this->getItems();
			if ($this->arResult['ITEMS'] !== false && is_array($this->arResult['ITEMS']) && count($this->arResult['ITEMS']) > 0)
			{
				$this->bUseResize = false;
				if ($this->arParams['IMG_WIDTH'] != 0 || $this->arParams['IMG_HEIGHT'] != 0)
					$this->bUseResize = true;
				if (!isset($this->arResult['ITEMS'][0]))
					$this->arResult['ITEMS'] = array($this->arResult['ITEMS']);
				foreach($this->arResult['ITEMS'] as $key => $arItem) {
					$this->setItemPicture($arItem, $key);
				}
			}
			$this->arResult['BLOCK_ID'] = $this->arParams['BLOCK_ID'];

			$this->SetResultCacheKeys($resultCacheKeys);
			$this->IncludeComponentTemplate();
		}
	}

	protected function getItems() {
		$hlAddtional = HLAdditional::getInstance();
		$arSelect = false;
		if (count ($this->arParams['FIELDS']) > 0){
			foreach ($this->arParams['FIELDS'] as $field) {
				if (!empty($field)) {
					$arSelect[] = $field;
					$resultCacheKeys[] = $field;
				}
			}
		}

		$arFilter = array('UF_ACTIVE' => true);

		global ${$this->arParams['FILTER_NAME']};
		$arrFilter = ${$this->arParams['FILTER_NAME']};
		if (count($arrFilter) > 0)
			$arFilter = array_merge($arFilter, $arrFilter);

		$params = array(
			'HL_ID' => $this->arParams['BLOCK_ID'],
			'filter' => $arFilter,
			'select' => $arSelect
		);
		if ($this->arParams['COUNT_ON_PAGE'] != false){
			$params['navigation'] = array('nPageTop' => $this->arParams['COUNT_ON_PAGE']);
		}
		$arItems = $hlAddtional->getList($params);

		return $arItems;
	}

	protected function setItemPicture(&$arItem, $key) {
		if ($this->bUseResize) {
			$arFileTmp = CFile::ResizeImageGet(
				$arItem[$this->arParams["IMAGE_FIELD"]],
				array("width" => $this->arParams['IMG_WIDTH'], "height" =>  $this->arParams['IMG_HEIGHT']),
				intval($this->arParams['IMG_RESIZE_METHOD']),
				true,
				false,
				false,
				intval($this->arParams['IMG_JPG_QUANTITY'])
			);
			$this->arResult['ITEMS'][$key][$this->arParams["IMAGE_FIELD"]] = array(
				'SRC' => $arFileTmp['src'],
				'WIDTH' => $arFileTmp['width'],
				'HEIGHT' => $arFileTmp['height']
			);
		}
		else {
			$arFile = CFile::GetFileArray($arItem[$this->arParams["IMAGE_FIELD"]]);
			$this->arResult['ITEMS'][$key][$this->arParams["IMAGE_FIELD"]] = array(
				'SRC' => $arFile['SRC'],
				'WIDTH' => $arFile['WIDTH'],
				'HEIGHT' => $arFile['HEIGHT']
			);
		}
	}
}
?>
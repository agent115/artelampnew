<?php
/**
 * Created by PhpStorm.
 * User: Vampiref92
 * Date: 02.12.2015
 * Time: 16:44
 */

namespace Adinadin\Artelamp;


Class CreateMultiLvlArray {
	protected $lastKey;
	protected $countSubArrayItems;
	protected $arSubArrayItems;
	protected $childrenSectionsName;
	protected $depthLvlName;
	
	public function get($array, $childrenSectionsName = 'SECTIONS', $depthLvlName = 'DEPTH_LEVEL'){
		$this->childrenSectionsName = $childrenSectionsName;
		$this->depthLvlName = $depthLvlName;
		$this->lastKey = 0;
		$this->arSubArrayItems = $array;
		$this->countSubArrayItems = count($this->arSubArrayItems);
		return $this->returnSubArray();
	}

	protected function returnSubArray ()
	{
		$k = $this->lastKey;
		$arSubMenu = array();

		while ($this->countSubArrayItems > $k) {
			if (!empty($arSubMenu) && count($arSubMenu) != 0 && $arSubMenu[0][$this->depthLvlName] < $this->arSubArrayItems[$k][$this->depthLvlName]) {
				$this->lastKey = $k;
				$arSubMenu[count($arSubMenu) - 1][$this->childrenSectionsName] = $this->returnSubArray();
				$k += $this->countMultiArray($arSubMenu[count($arSubMenu) - 1][$this->childrenSectionsName]);
				continue;
			} elseif (!empty($arSubMenu) && count($arSubMenu) != 0 && $arSubMenu[0][$this->depthLvlName] > $this->arSubArrayItems[$k][$this->depthLvlName]) {
				return $arSubMenu;
			} else {
				$arSubMenu[] = $this->arSubArrayItems[$k];
			}
			$k++;
		}
		return $arSubMenu;
	}

	public function countMultiArray($array){
		$count = 0;
		foreach($array as $arItem){
			if (isset($arItem[$this->childrenSectionsName]) && !empty($arItem[$this->childrenSectionsName])){
				$count += $this->countMultiArray($arItem[$this->childrenSectionsName]);
			}
			$count++;
		}
		return $count;
	}
}
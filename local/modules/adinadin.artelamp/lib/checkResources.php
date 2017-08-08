<?php
/**
 * Created by PhpStorm.
 * User: Vampiref92
 * Date: 13.11.2015
 * Time: 17:02
 */

namespace Adinadin\Artelamp;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class CheckResources
{
	protected $step = 1;
	protected $arResources;
	protected $arFormatedResources;
	protected $bUse;
	private static $_instance = null;

	public static function getInstance(){
		if(is_null(self::$_instance))
		{
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function setStep ()
	{
		if ($this->bUse) {
			if (!isset($this->arResources['START'])) {
				$this->init();
			} else {
				$memory_value = memory_get_usage();
				$time = time();
				$used_memory = $memory_value - $this->arResources['START']['MEMORY']['CURRENT'];
				$this->arResources['STEP-' . $this->step] = array(
						'TIME' => array(
								'CURRENT' => $time,
						),
						'MEMORY' => array(
								'CURRENT' => $memory_value,
								'USED' => $used_memory,
						)
				);
				$this->arFormatedResources['STEP-' . $this->step] = array(
						'TIME' => array(
								'USED' => intval($time - $this->arResources['START']['TIME']['CURRENT']) . ' ' . Loc::getMessage('SEC')
						),
						'MEMORY' => array(
								'CURRENT' => \CFile::FormatSize($memory_value),
								'USED' => \CFile::FormatSize($used_memory)
						)
				);
				if ($this->step > 1) {
					$lastStep = $this->step - 1;
					$this->arFormatedResources['STEP-' . $this->step]['TIME']['USED_INTERVAL_STEP'] =
							intval($time - $this->arResources['STEP-' . $lastStep]['TIME']['CURRENT']) . ' ' . Loc::getMessage('SEC');
					$this->arFormatedResources['STEP-' . $this->step]['MEMORY']['USED_INTERVAL_STEP'] =
							\CFile::FormatSize($memory_value - $this->arResources['STEP-' . $lastStep]['MEMORY']['CURRENT']);
				}
				$this->step++;
			}
		}
	}

	public function init ()
	{
		if ($this->bUse) {
			if (!isset($this->arResources['START'])) {
				$memory_value = memory_get_usage();
				$time = time();
				$this->arResources['START'] = array(
						'TIME' => array(
								'CURRENT' => $time,
						),
						'MEMORY' => array(
								'CURRENT' => $memory_value
						)
				);
				$this->arFormatedResources['START'] = array(
						'TIME' => array(
								'USED' => strval(0) . ' ' . Loc::getMessage('SEC')
						),
						'MEMORY' => array(
								'CURRENT' => \CFile::FormatSize($memory_value)
						)
				);
			}
		}
	}

	public function show ($expand = true)
	{
		if ($this->bUse) {
			if (function_exists('pp')) {
				pp($this->arFormatedResources, $expand);
			} else {
				echo '<pre>';
				print_r($this->arFormatedResources);
				echo '</pre>';
			}
		}
	}

	public function get ()
	{
		if ($this->bUse)
			return $this->arFormatedResources;
		return false;
	}

	public function setUse($bUse = true){
		$this->bUse = $bUse;
	}
}
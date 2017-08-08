<?
$_SERVER['DOCUMENT_ROOT']  = __DIR__;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

global $USER;
if ($USER->IsAdmin()) {
    IMPORTFAMDECO::Import_Fandeco();
}

?>
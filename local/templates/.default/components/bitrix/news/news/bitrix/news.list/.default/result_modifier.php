<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$cp= $this->__component;

foreach ($arResult['ITEMS'] as $ITEM) {
    $arResult["DATE"]=$ITEM["ACTIVE_FROM"];
}
$cp->setResultCacheKeys('DATE');
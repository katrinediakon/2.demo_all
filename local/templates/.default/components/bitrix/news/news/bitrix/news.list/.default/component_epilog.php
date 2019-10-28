<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arParams["SPECAILDATE"]==Y) {
    $APPLICATION->SetPageProperty("SPECIALDATE", $arResult["DATE"]);
}
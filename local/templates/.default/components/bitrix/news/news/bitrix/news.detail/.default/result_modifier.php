<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$cp= $this->__component;

$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID"=>$arParams["CANONICAL"], 'PROPERTY_NEWS' => $arResult["ID"],"ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
$ob = $res->GetNext();
$arResult['CANONICAL'] = $ob["NAME"];
$cp->setResultCacheKeys('CANONICAL');
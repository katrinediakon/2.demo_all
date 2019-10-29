<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

CModule::IncludeModule("iblock");
if ($arParams["PRODUCTS_IBLOCK_ID"] && $arParams["NEWS_IBLOCK_ID"] && $arParams["CODE"]) {
    if ($this->StartResultCache()) {
        $arResult = array();
        $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
        $arFilter = Array("IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNext()) {
            $arResult['ITEM'][$ob["ID"]]["NAME"] = $ob["NAME"];
            $arResult['ITEM'][$ob["ID"]]["DATE"] = $ob["DATE_ACTIVE_FROM"];
        }
        $arFilter = array('IBLOCK_ID' => $arParams["PRODUCTS_IBLOCK_ID"]); // выберет потомков без учета активности
        $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter, false, array("ID", "NAME", $arParams["CODE"]));
        while ($arSect = $rsSect->GetNext()) {
            foreach ($arSect[$arParams["CODE"]] as $news) {
                if ($arResult['ITEM'][$news]) {
                    $arResult['ITEM'][$news]["CATALOG"][$arSect["ID"]] = $arSect["NAME"];
                }
            }
        }
        $count = 0;
        $arSelect = Array("ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_PRICE", "PROPERTY_ARTNUMBER", "PROPERTY_MATERIAL");
        $arFilter = Array("IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNext()) {
            foreach ($arResult['ITEM'] as $key => $item) {
                if ($item["CATALOG"][$ob["IBLOCK_SECTION_ID"]]) {
                    $count++;
                    $arResult['ITEM'][$key]["ITEM"][] = $ob;
                }
            }
        }
        $arResult["COUNT"]=$count;
        $this->SetResultCacheKeys("COUNT");
        $this->includeComponentTemplate();
    }
}
?>
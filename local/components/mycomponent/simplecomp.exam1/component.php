<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

CModule::IncludeModule("iblock");
$arNavigation = CDBResult::GetNavParams($arNavParams);
global $CACHE_MANAGER;
if ($arParams["PRODUCTS_IBLOCK_ID"] && $arParams["NEWS_IBLOCK_ID"] && $arParams["CODE"]) {

    if ($this->StartResultCache(false, array($arNavigation,$_GET["F"]))) {

        $arResult = array();
        $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
        $arNavParams = array(
            "nPageSize" => $arParams["COUNT"],
            "bDescPageNumbering" => 'Описание',
            "bShowAll" => 'Y',
        );
        $arFilter = Array("IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, $arNavParams, $arSelect);
        $arResult["NAV_STRING"] = $res->GetPageNavStringEx($navComponentObject, "", $arParams["PAGER_TEMPLATE"]);
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
        if($_GET["F"]) {
            $arFilter = Array("IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y",
                array(
                    "LOGIC" => "OR",
                    array("<=PROPERTY_PRICE" => 1700, "=PROPERTY_MATERIAL" => "Дерево, ткань"),
                    array("<=PROPERTY_PRICE" => 1500, "=PROPERTY_MATERIAL" => "Металл, пластик"),
                ),);
        } else {
            $arFilter = Array("IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        }
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNext()) {
            foreach ($arResult['ITEM'] as $key => $item) {
                if ($item["CATALOG"][$ob["IBLOCK_SECTION_ID"]]) {
                    $count++;
                    if($arResult["MIN"]>$ob["PROPERTY_PRICE_VALUE"] || !$arResult["MIN"]) {
                        $arResult["MIN"] = $ob["PROPERTY_PRICE_VALUE"];
                    }
                    if($arResult["MAX"]<$ob["PROPERTY_PRICE_VALUE"] || !$arResult["MAX"]) {
                        $arResult["MAX"] = $ob["PROPERTY_PRICE_VALUE"];
                    }
                    $arResult['ITEM'][$key]["ITEM"][] = $ob;
                }
            }
        }

           $arResult["COUNT"]=$count;

        $this->SetResultCacheKeys("COUNT","MIN", "MAX");
        $this->includeComponentTemplate();
        $APPLICATION->SetTitle("Элементов - " . $arResult["COUNT"]);
    }
}
?>
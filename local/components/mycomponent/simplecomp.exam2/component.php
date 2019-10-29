<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

CModule::IncludeModule("iblock");
if ($arParams["PRODUCTS_IBLOCK_ID"] && $arParams["FIRM_IBLOCK_ID"] && $arParams["CODE"]) {
    if ($this->StartResultCache()) {
        $arResult = array();
        $firm = array();
        $count = 0;
        $arSelect = Array("ID", "NAME");
        $arFilter = Array("IBLOCK_ID" => $arParams["FIRM_IBLOCK_ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNext()) {
            $count++;
            $arResult['ITEM'][$ob["ID"]]["NAME"] = $ob["NAME"];
            $firm[] = $ob["ID"];
        }


        $arSelect = Array("ID", "NAME", "PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_" . $arParams["CODE"]);
        $arFilter = Array("IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"], "PROPERTY_" . $arParams["CODE"] => $firm, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNext()) {
            if ($arResult["ITEM"][$ob["PROPERTY_" . $arParams["CODE"] . "_VALUE"]]) {
                $arResult["ITEM"][$ob["PROPERTY_" . $arParams["CODE"] . "_VALUE"]]["CATALOG"][] = $ob;
            }
        }
        $arResult["COUNT"] = $count;
        $this->SetResultCacheKeys("COUNT");
        $this->includeComponentTemplate();
    }
}
?>
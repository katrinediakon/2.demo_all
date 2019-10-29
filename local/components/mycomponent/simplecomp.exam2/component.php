<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

CModule::IncludeModule("iblock");
$this->AddIncludeAreaIcon(
    array(
        'URL'   => '/bitrix/admin/iblock_element_admin.php?IBLOCK_ID='.$arParams["FIRM_IBLOCK_ID"].'&type=news&lang=ru&apply_filter=Y&back_url_pub=%2F',
        'TITLE' => "ИБ в админке",
        "IN_PARAMS_MENU" => true, //показать в контекстном меню
    )
);
global $CACHE_MANAGER;
if ($arParams["PRODUCTS_IBLOCK_ID"] && $arParams["FIRM_IBLOCK_ID"] && $arParams["CODE"]) {
    if ($this->StartResultCache()) {
        echo time();
        $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["PRODUCTS_IBLOCK_ID"]);
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


        $arSelect = Array("ID", "NAME", "IBLOCK_SECTION_ID","PROPERTY_PRICE", "PROPERTY_MATERIAL", "PROPERTY_" . $arParams["CODE"],  "CODE");
        $arFilter = Array("IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"], "PROPERTY_" . $arParams["CODE"] => $firm, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array("NAME"=>"ASC", "SORT"=>"ASC"), $arFilter, false, Array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNext()) {
            $arButtons = CIBlock::GetPanelButtons(
                $arParams["PRODUCTS_IBLOCK_ID"],
                $ob["ID"],
                0,
                array("SECTION_BUTTONS"=>false, "SESSID"=>false)
            );
            $ob["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
            $ob["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
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
<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader,
    Bitrix\Iblock;

CModule::IncludeModule("iblock");
if ($USER->GetID()) {
    if ($arParams["NEWS_IBLOCK_ID"] && $arParams["CODE_AUTHOR"] && $arParams["CODE_TYPE"]) {
        if ($this->StartResultCache($USER->GetID())) {
            $arResult = array();
            $userBy = "id";
            $userOrder = "desc";

            $userFilter = array(
                'ID' => $USER->GetID(),
                'ACTIVE' => 'Y'
            );

            $userParams = array(
                'SELECT' => array($arParams["CODE_TYPE"]),

            );

            $rsUser = CUser::GetList(
                $userBy,
                $userOrder,
                $userFilter,
                $userParams
            );

            if ($ob['USER'] = $rsUser->Fetch()) {
                $group = $ob['USER'][$arParams["CODE_TYPE"]];
            }

            $userBy = "id";
            $userOrder = "desc";

            $userFilter = array(
                'ACTIVE' => 'Y',
                $arParams["CODE_TYPE"] => $group
            );

            $rsUser = CUser::GetList(
                $userBy,
                $userOrder,
                $userFilter
            );
            $user = array();
            while ($ob = $rsUser->GetNext()) {
                $arResult["USERS"][$ob["ID"]]["LOGIN"] = $ob["LOGIN"];
                $user[] = $ob["ID"];
            }
            $news = array();
            $arSelect = Array("ID", "NAME", "PROPERTY_" . $arParams["CODE_AUTHOR"]);
            $arFilter = Array("IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"], "PROPERTY_" . $arParams["CODE_AUTHOR"] => $user, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
            while ($ob = $res->GetNext()) {
                if ($ob["PROPERTY_" . $arParams["CODE_AUTHOR"] . "_VALUE"] == $USER->GetID()) {
                    $news[] = $ob['NAME'];
                }
                if ($arResult["USERS"][$ob["PROPERTY_" . $arParams["CODE_AUTHOR"] . "_VALUE"]]) {
                    $arResult["USERS"][$ob["PROPERTY_" . $arParams["CODE_AUTHOR"] . "_VALUE"]]["NEWS"][] = $ob;
                }
            }
            $id=0;
            $arNews = array();
            foreach ($arResult["USERS"] as $user => $news_user) {
                if ($user != $USER->GetID()) {
                    foreach ($news_user["NEWS"] as $key_news => $new) {
                        if (in_array($new["NAME"], $news)) {
                            unset($arResult["USERS"][$user]["NEWS"][$key_news]);
                        }
                    }
                }
                if(!array_search($arResult["USERS"][$user]["NEWS"][$key_news], $arNews))
                {
                    $arNews[] = $arResult["USERS"][$user]["NEWS"]["NAME"];
                }
            }
            unset($arResult["USERS"][$USER->GetID()]);
            $arResult["COUNT"] = count($arNews);
            $this->SetResultCacheKeys("COUNT");
            $this->includeComponentTemplate();
            $APPLICATION->SetTitle("ВЫБРАННЫХ НОВОСТЕЙ - " . $arResult["COUNT"]);
        }
    }
}
?>
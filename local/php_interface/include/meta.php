<?
AddEventHandler('main', 'OnEpilog', 'META', 1);

function META()
{
    if (CModule::IncludeModule('iblock')) {
        global $APPLICATION;
        $arSelect = Array("ID", "NAME", "PROPERTY_TITLE", "PROPERTY_DESCRIPTION");
        $arFilter = Array("IBLOCK_ID" => 6, "NAME" => $APPLICATION->GetCurPage(), "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
        while ($ob = $res->GetNext()) {
            $APPLICATION->SetTitle($ob["PROPERTY_TITLE_VALUE"]);
            $APPLICATION->SetPageProperty("description", $ob["PROPERTY_DESCRIPTION_VALUE"]);
        }
    }
}
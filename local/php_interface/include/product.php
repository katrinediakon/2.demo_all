<? // регистрируем обработчик
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("MyClass", "OnBeforeIBlockElementUpdateHandler"));

class MyClass
{
    // создаем обработчик события "OnBeforeIBlockElementUpdate"
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {

        if ($arFields["IBLOCK_ID"] == 2 && $arFields["ACTIVE"] == 'N') {
            global $APPLICATION;
            $arSelect = Array("SHOW_COUNTER");
            $arFilter = Array("ID" => $arFields["ID"]);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
            while ($ob = $res->GetNext()) {
                $count = $ob['SHOW_COUNTER'];
            }
            if ($count >= 2) {
                $APPLICATION->throwException("Товар невозможно деактивировать, у него " . $count . " просмотров");
                return false;
            }
        }
    }
}

?>
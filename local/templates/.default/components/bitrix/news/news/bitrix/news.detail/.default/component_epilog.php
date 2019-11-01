<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if($arParams["CANONICAL"]) {
    $APPLICATION->SetPageProperty("CANONICAL",  $arResult['CANONICAL']);
}


if($_GET["VOTE"]) {
    echo "<script>  document.getElementById('complaint').firstChild.data = 'Ваше мнение учтено, '+" . $_GET["VOTE"] . "; </script>";
}

if ($arParams["COMPLAINT_AJAX"] == "Y" || $arParams["COMPLAINT"] == "Y") {
    $el = new CIBlockElement;
    //return json_encode($templateData["id"]);
    if (!$USER->GetLogin())
        $login = "Не авторизован";
    else {
        $login = $USER->GetLogin();
    }
    $PROP = array();
    $PROP[18] = date("d.m.Y");  // свойству с кодом 12 присваиваем значение "Белый"
    $PROP[19] = $USER->GetID();
    $PROP[20] = $login;
    $PROP[16] = $USER->GetFullName();
    $PROP[27] = $templateData["id"];
    $arLoadProductArray = Array(
        "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
        "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
        "IBLOCK_ID" => 8,
        "PROPERTY_VALUES" => $PROP,
        "NAME" => "Жалоба от " . $USER->GetFullName(),
        "ACTIVE" => "Y",            // активен
    );
    $PRODUCT_ID = $el->Add($arLoadProductArray);

    if ($arParams["COMPLAINT_AJAX"] ) {
        $GLOBALS['APPLICATION']->RestartBuffer();
        echo $PRODUCT_ID;
        die();
    } else {
        LocalRedirect($APPLICATION->GetCurPage()."?VOTE=".$PRODUCT_ID);
    }

}
?>
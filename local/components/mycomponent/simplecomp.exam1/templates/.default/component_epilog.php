<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetTitle("Элементов - " . $arResult["COUNT"]);
$APPLICATION->AddViewContent("PRICE", "МИНИМАЛЬНАЯ ЦЕНА:".$arResult["MIN"]."</br>МАКСИМАЛЬНАЯ ЦЕНА:".$arResult["MAX"]);

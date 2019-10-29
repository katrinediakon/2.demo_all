<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент 1");
?><?$APPLICATION->IncludeComponent(
	"mycomponent:simplecomp.exam1",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CAT_IBLOCK_ID" => "",
		"CODE" => "UF_NEWS_LINK",
		"COUNT" => "2",
		"NEWS_IBLOCK_ID" => "1",
		"PRODUCTS_IBLOCK_ID" => "2"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
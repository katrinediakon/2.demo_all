<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент 3");
?><?$APPLICATION->IncludeComponent(
	"mycomponent:simplecomp.exam3",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CODE" => "",
		"CODE_AUTHOR" => "GROUP_USER",
		"CODE_TYPE" => "UF_AUTHOR_TYPE",
		"FIRM_IBLOCK_ID" => "",
		"NEWS_IBLOCK_ID" => "1",
		"PRODUCTS_IBLOCK_ID" => "",
		"TEMPLETE" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
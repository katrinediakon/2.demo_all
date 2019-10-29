<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент2");
?><div>
 <br>
</div>
<div>
	 <?$APPLICATION->IncludeComponent(
	"mycomponent:simplecomp.exam2",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CODE" => "FIRM",
		"FIRM_IBLOCK_ID" => "7",
		"PRODUCTS_IBLOCK_ID" => "2",
		"TEMPLETE" => "catalog_exam/#SECTION_ID#/#ELEMENT_CODE#"
	)
);?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
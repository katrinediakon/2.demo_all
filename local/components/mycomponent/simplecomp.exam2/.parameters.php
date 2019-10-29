<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => array(
			"NAME" => GetMessage("CAT_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
        "FIRM_IBLOCK_ID" => array(
            "NAME" => GetMessage("FIRM_IBLOCK_ID"),
            "TYPE" => "STRING",
        ),
        "CODE" => array(
            "NAME" => GetMessage("CODE"),
            "TYPE" => "STRING",
        ),
        "TEMPLETE" => array(
            "NAME" => GetMessage("TEMPLETE"),
            "TYPE" => "STRING",
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
	),
);
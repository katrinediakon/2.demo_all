<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => array(
			"NAME" => GetMessage("CAT_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
        "NEWS_IBLOCK_ID" => array(
            "NAME" => GetMessage("NEWS_IBLOCK_ID"),
            "TYPE" => "STRING",
        ),
        "CODE" => array(
            "NAME" => GetMessage("CODE"),
            "TYPE" => "STRING",
        ),
        "COUNT" => array(
            "NAME" => GetMessage("COUNT"),
            "TYPE" => "STRING",
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
	),
);
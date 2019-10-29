<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"NEWS_IBLOCK_ID" => array(
			"NAME" => GetMessage("NEWS_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
        "CODE_AUTHOR" => array(
            "NAME" => GetMessage("CODE_AUTHOR"),
            "TYPE" => "STRING",
        ),
        "CODE_TYPE" => array(
            "NAME" => GetMessage("CODE_TYPE"),
            "TYPE" => "STRING",
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
	),
);
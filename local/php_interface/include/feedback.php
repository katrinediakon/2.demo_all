<?php
AddEventHandler("main", "OnBeforeEventAdd", "OnBeforeEventAddHandler");


function OnBeforeEventAddHandler(&$event, &$lid, &$arFields)
{
    if ($event == "FEEDBACK_FORM") {
        global $USER;

        if ($USER->GetID()) {
            $arFields["AUTHOR"] = "Пользователь авторизован:" . $USER->GetID(). "(".$USER->GetLogin().")". $USER->GetFullName() .", данные из формы: " . $arFields["AUTHOR"];
            CEventLog::Add(array(
                "SEVERITY" => "INFO",
                "AUDIT_TYPE_ID" => "FEEDBACK_FORM",
                "MODULE_ID" => "main",
                "ITEM_ID" => 123,
                "DESCRIPTION" => "Замена данных в отсылаемом письме – " . $arFields["AUTHOR"]
            ));
        } else {
            $arFields["AUTHOR"] = "Пользователь не авторизован, данные из формы: " . $arFields["AUTHOR"];
        }
    }
}

<?
AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);


function _Check404Error()
{
    global $APPLICATION;
    echo $APPLICATION->GetCurPage();
    if (defined('ERROR_404') && ERROR_404 == 'Y' || CHTTP::GetLastStatus() == "404 Not Found") {
        CEventLog::Add(array(
            "SEVERITY" => "INFO",
            "AUDIT_TYPE_ID" => "ERROR_404",
            "MODULE_ID" => "main",
            "ITEM_ID" => 123,
            "DESCRIPTION" => $APPLICATION->GetCurPage(),
        ));
    }
}

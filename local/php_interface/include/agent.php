<?
function AgentChekUsers()
{
    global $DB;
    if(CModule::IncludeModule("iblock"))
    {
        $date=$default_group = COption::GetOptionString("main", "date", "");
        if($date=="")
        {
            $arFilter = array(
                "DATE_REGISTER_1" => date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), strtotime('-1 day')),
            );
        }
        else {
            $arFilter = array(
                "DATE_REGISTER_1" => date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), mktime($date)),
            );
        }
        $order = array('sort' => 'asc');
        $tmp = 'sort';
        $rsUsers = CUser::GetList($by , $order, $arFilter);
        while($arItemCat = $rsUsers->GetNext())
        {
            print_r($arItemCat);
        }
        COption::SetOptionString("main","date",date(H,i,s,d,m,Y));
        $arItems = array();
        while($arItemCat = $rsUsers->GetNext())
        {
            $arItems[] = $arItemCat;
        }
        $arFilter = Array(
            "GROUPS_ID" => Array(1)
        );
        $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $arFilter);
        $arEmail = array();
        while($arResUser = $rsUsers->GetNext())
        {
            $arEmail[] = $arResUser["EMAIL"];
        }
        if(count($arEmail) > 0)
        {
            $arEventFields = array(
                "TEXT" => "на сайте зарегистрировано ".count($arItems)." пользователей за ".strtotime ((date(d.m.Y, $date))-strtotime (date(d.m.Y)))/(60*60*24)." дней",
                "EMAIL" => implode(", ", $arEmail),
            );
            CEvent::Send("INFO_USERS", "s1", $arEventFields);
        }
    }
    return "AgentChekUsers();";
}
?>
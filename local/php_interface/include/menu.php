<?php
AddEventHandler("main", "OnBuildGlobalMenu", "MyOnBuildGlobalMenu");


function MyOnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
{
    // Убрать "Рабочий стол"
    unset($aGlobalMenu["global_menu_desktop"]);
    unset($aGlobalMenu["global_menu_services"]);
    unset($aGlobalMenu["global_menu_marketplace"]);
    unset($aGlobalMenu["global_menu_settings"]);
    foreach ($aModuleMenu as $menu) {
        if ($menu["text"] == "Новости") {
            $aModuleMenu = null;
            $aModuleMenu[0] = $menu;
        }
    }
}
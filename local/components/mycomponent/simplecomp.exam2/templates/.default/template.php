<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<p><b><?= GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?>:</b></p>

<ul>
    <? foreach ($arResult['ITEM'] as $news): ?>
        <li><h5><?= $news["NAME"] ?></h5>
            <ul>
                <? foreach ($news['CATALOG'] as $item): ?>
                <li><?= $item['NAME'] ?> - <?= $item['PROPERTY_PRICE_VALUE'] ?>
                    - <?= $item['PROPERTY_MATERIAL_VALUE'] ?>
                    <? if ($arParams['TEMPLETE']):
                    $link = str_ireplace("#SECTION_ID#", $item["IBLOCK_SECTION_ID"], $arParams['TEMPLETE']);
                        $link = str_ireplace("#ELEMENT_CODE#", $item["CODE"].".php", $link);
                    endif ?>
                    (<?=$link?>)
                    <? endforeach; ?>
            </ul>
        </li>
    <? endforeach; ?>
</ul>

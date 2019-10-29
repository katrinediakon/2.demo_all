<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<p><b><?= GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?>:</b></p>

    <p>Фильтр: <a href="/ex2/simplecomp/simplecomp1.php?F=Y">/ex2/simplecomp/simplecomp1.php?F=Y</a></p>

<ul>
    <? foreach ($arResult['ITEM'] as $news): ?>
        <li><h5><?= $news["NAME"] ?> - <?= $news['DATE'] ?></h5>
            <? $catalog = "" ?>
            <? foreach ($news['CATALOG'] as $elcatalog): ?>
                <? if (!is_array($elcatalog)): ?>
                    <? $catalog .= $elcatalog . "," ?>
                <? endif; ?>
            <? endforeach; ?>
            (<?= substr($catalog, 0, -1) ?>)
            <ul>
                <? foreach ($news['ITEM'] as $item): ?>
                    <li><?= $item['NAME'] ?> - <?= $item['PROPERTY_PRICE_VALUE'] ?>
                        - <?= $item['PROPERTY_MATERIAL_VALUE'] ?>
                        - <?= $item['PROPERTY_ARTNUMBER_VALUE'] ?></li>
                <? endforeach; ?>
            </ul>
        </li>
    <? endforeach; ?>
</ul>

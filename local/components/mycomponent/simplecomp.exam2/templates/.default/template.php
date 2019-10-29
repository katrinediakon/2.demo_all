<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<p><b><?= GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?>:</b></p>

<ul>
    <? foreach ($arResult['ITEM'] as $news): ?>
        <li><h5><?= $news["NAME"] ?></h5>
            <ul>
                <? foreach ($news['CATALOG'] as $item): ?>
                    <li><?= $item['NAME'] ?> - <?= $item['PROPERTY_PRICE_VALUE'] ?>
                        - <?= $item['PROPERTY_MATERIAL_VALUE'] ?>
                <?endforeach;?>
            </ul>
        </li>
    <? endforeach; ?>
</ul>

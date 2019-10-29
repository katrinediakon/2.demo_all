<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<p><b><?= GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?>:</b></p>

<ul>
    <? foreach ($arResult['USERS'] as $news): ?>
        <li><h5><?= $news["LOGIN"] ?> </h5>
            <ul>
                <? foreach ($news['NEWS'] as $item): ?>
                    <li><?= $item['NAME'] ?>
                <?endforeach;?>
            </ul>
        </li>
    <? endforeach; ?>
</ul>

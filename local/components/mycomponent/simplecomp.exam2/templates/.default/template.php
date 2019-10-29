<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<p><b><?= GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?>:</b></p>

<ul>
    <? foreach ($arResult['ITEM'] as $news): ?>
        <li><h5><?= $news["NAME"] ?></h5>
            <ul>
                <? foreach ($news['CATALOG'] as $key=>$item): ?>
                <?
                $this->AddEditAction($item["ID"], $item['EDIT_LINK'], CIBlock::GetArrayByID($arParams["PRODUCTS_IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item["ID"], $item['DELETE_LINK'], CIBlock::GetArrayByID($arParams["PRODUCTS_IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div id="<?=$this->GetEditAreaId($item["ID"]);?>">
                <li><?= $item['NAME'] ?> - <?= $item['PROPERTY_PRICE_VALUE'] ?>
                    - <?= $item['PROPERTY_MATERIAL_VALUE'] ?>
                    <? if ($arParams['TEMPLETE']):
                    $link = str_ireplace("#SECTION_ID#", $item["IBLOCK_SECTION_ID"], $arParams['TEMPLETE']);
                        $link = str_ireplace("#ELEMENT_CODE#", $item["CODE"].".php", $link);
                    endif ?>
                    (<?=$link?>)</li>
                </div>
                    <? endforeach; ?>
            </ul>
        </li>
    <? endforeach; ?>
</ul>

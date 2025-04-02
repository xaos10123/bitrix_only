<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="article-card">


    <div class="article-card__title">
        <? if ($arParams["DISPLAY_NAME"] != "N" && $arResult["NAME"]): ?>
            <h3><?= $arResult["NAME"] ?></h3>
        <? endif; ?>
    </div>
    <div class="article-card__date">
        <? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
            <span class="news-date-time"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span>
        <? endif; ?>
    </div>
    <div class="article-card__content">
        <div class="article-card__image sticky">
            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
                <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="" data-object-fit="cover"/>
            <? endif ?>
        </div>
        <div class="article-card__text">
            <div class="block-content" data-anim="anim-3">
                <? if ($arResult["DETAIL_TEXT"] <> ''): ?>
                    <? echo $arResult["DETAIL_TEXT"]; ?>
                <? else: ?>
                    <? echo $arResult["PREVIEW_TEXT"]; ?>
                <? endif ?>
            </div>
            <a class="article-card__button" href="<?= $arResult["LIST_PAGE_URL"] ?>">Назад к новостям</a>
        </div>
    </div>
</div>

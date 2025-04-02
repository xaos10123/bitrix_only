<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arResult
 */

if ($arResult["isFormErrors"] == "Y"):?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>
<? if ($arResult["isFormNote"] != "Y") {
    ?>

    <div class="contact-form">

    <?
    if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y") {
        ?>
        <div class="contact-form__head">
            <?
            if ($arResult["isFormTitle"]) {
                ?>
                <div class="contact-form__head-title"><?= $arResult["FORM_TITLE"] ?></div>
                <?
            }
            ?>
            <div class="contact-form__head-text"><?= $arResult["FORM_DESCRIPTION"] ?></div>
        </div>
        <?
    }
    ?>

    <?= $arResult["FORM_HEADER"] ?>
    <div class="contact-form__form-inputs">
        <?
        foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
            if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
                echo $arQuestion["HTML_CODE"];
            } else {
                ?>

                <?= $arQuestion["HTML_CODE"] ?>

                <?
            }
        }
        ?>
        <div class="contact-form__bottom">
            <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
                ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных
                данных&raquo;.
            </div>
            <button class="form-button contact-form__bottom-button" data-success="Отправлено"
                    data-error="Ошибка отправки" name="web_form_submit" type="submit"
                    value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?>">
                <div class="form-button__title">Оставить заявку</div>
            </button>

        </div>

        <?= $arResult["FORM_FOOTER"] ?>
    </div>
    <?
}
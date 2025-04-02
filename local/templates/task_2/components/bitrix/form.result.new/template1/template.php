<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arResult
 * <?= $arResult["FORM_TITLE"] ?> - Название формы
 * <?= $arResult["FORM_DESCRIPTION"] ?> - Описание
 * <?= $arQuestion["CAPTION"] ?> - Подпись лейбла
 * <?= $arResult["REQUIRED_SIGN"]; ?>
 * <?= $arQuestion["HTML_CODE"] ?>
 *
 *
 */

?>

<pre>
    <? print_r($arResult) ?>
</pre>

<div class="contact-form">
    <div class="contact-form__head">
        <div class="contact-form__head-title"><?= $arResult["FORM_TITLE"] ?></div>
        <div class="contact-form__head-text"><?= $arResult["FORM_DESCRIPTION"] ?></div>
    </div>

    <form class="contact-form__form" action="/" method="POST">
        <div class="contact-form__form-inputs">
            <?php
            foreach ($arResult["QUESTIONS"] as $key => $value) {
                if ($value["TAG"] !== 'message') {
                    ?>
                    <div class="input contact-form__input">
                        <label class="input__label" for="<?=$key;?>">
                            <div class="input__label-text"><?= $value["CAPTION"]; ?>

                                <?
                                if ($value["REQUIRED"]) {
                                    echo $arResult["REQUIRED_STAR"];
                                }
                                ?>
                            </div>
                            <input class="input__input" type="<?= $value["STRUCTURE"][0]["FIELD_TYPE"]; ?>"
                                   id="medicine_<?= $value["TAG"]; ?>" name="<?=$key;?>"
                                   value=""
                                <?
                                if ($value["REQUIRED"]) {
                                    echo "required";
                                }
                                ?>
                            >
                            <?
                            if ($value["ERROR_TEXT"]) {
                                ?>
                                <div class="input__notification"><?= $value["ERROR_TEXT"] ?></div>
                            <?
                            } ?>
                        </label>
                    </div>
                    <?
                }
            }
            ?>
        </div>


        <div class="contact-form__form-message">
            <div class="input"><label class="input__label" for="medicine_message">
                    <div class="input__label-text"><?= $QUESTION["CAPTION"]; ?></div>
                    <textarea class="input__input" type="text" id="medicine_message" name="medicine_message"
                              value=""></textarea>
                    <div class="input__notification"></div>
                </label></div>
        </div>


        <div class="contact-form__bottom">
            <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
                ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку
                персональных
                данных&raquo;.
            </div>
            <?= $arResult["SUBMIT_BUTTON"] ?>
        </div>
    </form>
</div>

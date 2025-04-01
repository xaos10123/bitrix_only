<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arResult
 */

?>
<div class="contact-form">
    <div class="contact-form__head">
        <div class="contact-form__head-title"><?= $arResult["FORM_TITLE"] ?></div>
        <div class="contact-form__head-text"><?= $arResult["FORM_DESCRIPTION"] ?></div>
    </div>

    <form class="contact-form__form" action="/" method="POST">
        <div class="contact-form__form-inputs">
            <?php
            foreach ($arResult["QUESTIONS"] as $QUESTION) {
                if ($QUESTION["TAG"] !== 'message') {
                    ?>
                    <div class="input contact-form__input">
                        <label class="input__label" for="medicine_<?= $QUESTION["TAG"]; ?>">
                            <div class="input__label-text"><?= $QUESTION["CAPTION"]; ?>
                                <?
                                if ($QUESTION["REQUIRED"]) {
                                    echo $arResult["REQUIRED_STAR"];
                                }
                                ?>
                            </div>
                            <input class="input__input" type="<?= $QUESTION["STRUCTURE"][0]["FIELD_TYPE"]; ?>"
                                   id="medicine_<?= $QUESTION["TAG"]; ?>" name="medicine_<?= $QUESTION["TAG"]; ?>"
                                   value=""
                                <?
                                if ($QUESTION["REQUIRED"]) {
                                    echo "required";
                                }
                                ?>
                            >
                            <div class="input__notification"><?= $QUESTION["ERROR_TEXT"] ?></div>
                        </label>
                    </div>
                    <?
                }
            }
            ?>
        </div>


        <div class="contact-form__form-message">
            <div class="input"><label class="input__label" for="medicine_message">
                    <div class="input__label-text"><?= $QUESTION["CAPTION"];?></div>
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

<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if ($arResult["QUESTIONS"]) {
    foreach ($arResult["QUESTIONS"] as $key => $item) {
        switch ($item["CAPTION"]) {
            case "Ваше имя":
                $arResult["QUESTIONS"][$key]["TAG"] = 'name';
                $arResult["QUESTIONS"][$key]["ERROR_TEXT"] = 'Поле должно содержать не менее 3-х символов';
                break;
            case "Компания/Должность":
                $arResult["QUESTIONS"][$key]["TAG"] = 'company';
                $arResult["QUESTIONS"][$key]["ERROR_TEXT"] = 'Поле должно содержать не менее 3-х символов';
                break;
            case "Email":
                $arResult["QUESTIONS"][$key]["TAG"] = 'email';
                $arResult["QUESTIONS"][$key]["ERROR_TEXT"] = 'Неверный формат почты';
                break;
            case "Номер телефона":
                $arResult["QUESTIONS"][$key]["TAG"] = 'phone';
                break;
            case "Сообщение":
                $arResult["QUESTIONS"][$key]["TAG"] = 'message';
                break;
        }
    }
}
$arResult["SUBMIT_BUTTON"] = '<button class="form-button contact-form__bottom-button" data-success="Отправлено"
                            data-error="Ошибка отправки">
                        <div class="form-button__title">Оставить заявку</div>
                    </button>';
$arResult["REQUIRED_STAR"] = '*';

?>
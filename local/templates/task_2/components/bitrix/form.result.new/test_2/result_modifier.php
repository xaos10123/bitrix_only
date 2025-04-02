<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

function createHtmlCodeForInput($struct, $caption, $reqSign, $type, $errMes)
{
    $sid = "form_" . $struct["FIELD_TYPE"] . "_" . $struct["ID"];
    return "<div class=\"input contact-form__input\">
                <label class=\"input__label\" for=\"{$sid}\">
                    <div class=\"input__label-text\">{$caption}{$reqSign}</div>
                        <input class=\"input__input\" type=\"{$type}\" id=\"{$sid}\" name=\"{$sid}\" required=\"\">
                    <div class=\"input__notification\">{$errMes}</div>
                </label>
            </div>";
}

$arResult["REQUIRED_SIGN"] = '*';

if ($arResult["QUESTIONS"]) {
    foreach ($arResult["QUESTIONS"] as $key => $item) {
        switch ($key) {
            case "medicine_name" || "medicine_company":
                $arResult["QUESTIONS"][$key]["ERROR_TEXT"] = 'Поле должно содержать не менее 3-х символов';
                break;
            case "medicine_email":
                $arResult["QUESTIONS"][$key]["ERROR_TEXT"] = 'Неверный формат почты';
                break;
            case "medicine_phone":
                $arResult["QUESTIONS"][$key]["TAG"] = 'phone';
                break;
            case "medicine_message":
                $arResult["QUESTIONS"][$key]["TAG"] = 'message';
                break;
        }
        if ($key !== "medicine_message") {
            $arResult["QUESTIONS"][$key]["HTML_CODE"] = createHtmlCodeForInput($arResult["QUESTIONS"][$key]['STRUCTURE'][0], $arResult["QUESTIONS"][$key]["CAPTION"], $arResult["QUESTIONS"][$key]["REQUIRED"] ? $arResult["REQUIRED_SIGN"] : '', $arResult["QUESTIONS"][$key]['STRUCTURE'][0]['FIELD_TYPE'], $arResult["QUESTIONS"][$key]["ERROR_TEXT"] ? $arResult["QUESTIONS"][$key]["ERROR_TEXT"] : '');
        } else {
            $sid = "form_" . $arResult["QUESTIONS"][$key]['STRUCTURE'][0]["FIELD_TYPE"] . "_" . $arResult["QUESTIONS"][$key]['STRUCTURE'][0]["ID"];
            $arResult["QUESTIONS"][$key]["HTML_CODE"] = '</div><div class="contact-form__form-message">
            <div class="input"><label class="input__label" for="medicine_message">
                <div class="input__label-text">Сообщение</div>
                <textarea class="input__input" type="text" id="medicine_message" name="' . $sid . '"></textarea>
                <div class="input__notification"></div>
            </label></div>
        </div>';
        }
    }
}

$arResult["FORM_HEADER"] = preg_replace("#<form#", "<form class='contact-form__form'", $arResult["FORM_HEADER"]);

?>
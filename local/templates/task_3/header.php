<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>
        <?php
        $APPLICATION->ShowTitle()
        ?>
    </title>
    <?php
    $APPLICATION->ShowHead();
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <?php
    use Bitrix\Main\Page\Asset;
    ?>
    <link rel="shortcut icon" href="images/favicon.604825ed.ico" type="image/x-icon">

    <?Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/common.css');?>
</head>
<body>
<?$APPLICATION->ShowPanel()?>

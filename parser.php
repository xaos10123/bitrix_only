<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("parser");

if (!$USER->IsAdmin()) {
    LocalRedirect('/');
}

\Bitrix\Main\Loader::includeModule('iblock');

$row = 1;
$IBLOCK_ID = 5;

$el = new CIBlockElement;
$arProps = [];

$rsElement = CIBlockElement::getList([], ['IBLOCK_ID' => 5],
    false, false, ['ID', 'NAME']);

while ($ob = $rsElement->GetNextElement()) {
    $arFields = $ob->GetFields();
    $key = str_replace(['»', '«', '(', ')'], '', $arFields['NAME']);
    $key = strtolower($key);
    $arKey = explode(' ', $key);
    $key = '';
    foreach ($arKey as $part) {
        if (strlen($part) > 2) {
            $key .= trim($part) . ' ';
        }
    }
    $key = trim($key);
    $arProps['OFFICE'][$key] = $arFields['ID'];

}


$rsProp = CIBlockPropertyEnum::GetList(
    ["SORT" => "ASC", "VALUE" => "ASC"],
    ['IBLOCK_ID' => $IBLOCK_ID]
);

while ($arProp = $rsProp->Fetch()) {
    $key = trim($arProp['VALUE']);
    $arProps[$arProp['PROPERTY_CODE']][$key] = $arProp['ID'];
}

//echo "<pre>";
//print_r($arProps);
//echo "</pre>";
//echo "<hr>";

$rsElements = CIBlockElement::GetList([], ['IBLOCK_ID' => $IBLOCK_ID], false, false, ['ID']);
while ($element = $rsElements->GetNext()) {
    CIBlockElement::Delete($element['ID']);
}


if (($handle = fopen("vacancy.csv", "r")) !== false) {
    while (($data = fgetcsv($handle, 1000)) !== false) {


//        echo "<pre> DATA";
//        print_r($data);
//        echo "</pre>";


        if ($row == 1) {
            $row++;
            continue;
        }
        $row++;

        $PROPERTY['ACTIVITY'] = $data[9];
        $PROPERTY['FIELD'] = $data[11];
        $PROPERTY['OFFICE'] = $data[1];
        $PROPERTY['LOCATION'] = $data[2];
        $PROPERTY['REQUIRE'] = $data[4];
        $PROPERTY['DUTY'] = $data[5];
        $PROPERTY['CONDITIONS'] = $data[6];
        $PROPERTY['EMAIL'] = $data[12];
        $PROPERTY['DATE'] = date('d.m.Y');
        $PROPERTY['TYPE'] = $data[8];
        $PROPERTY['SALARY_TYPE'] = '';
        $PROPERTY['SALARY_VALUE'] = $data[7];
        $PROPERTY['SCHEDULE'] = $data[10];


        foreach ($PROPERTY as $key => & $value) {
            $value = trim($value);
            $value = str_replace('\n', '', $value);

            if (stripos($value, '•') !== false) {
                $value = explode('•', $value);
                array_splice($value, 0, 1);

                foreach ($value as &$item) {
                    $item = trim($item);
                }
            } elseif ($arProps[$key]) {
                $arEquivalent = [];
                foreach ($arProps[$key] as $propKey => $propVal) {
                    if ($key == "OFFICE") {
                        $value = strtolower($value);
                        switch ($value) {
                            case "центральный офис":
                                $value .= 'свеза ' . $data[2];
                                break;
                            case "лесозаготовка":
                                $value = 'свеза ресурс ' . $value;
                                break;
                            case "свеза тюмень":
                                $value = 'свеза тюмени';
                                break;
                        }
                        $arEquivalent[similar_text($value, $propKey)] = $propVal;
                    }
                    if (stripos($propKey, $value) !== false) {
                        $value = $propVal;
                        break;
                    }
                    if (similar_text($propKey, $value) > 50) {
                        $value = $propVal;
                    }
                }

                if ($key == 'OFFICE' && !is_numeric($value)) {
                    ksort($arEquivalent);
                    $value = array_pop($arEquivalent);
                }
            }
        }

        switch ($PROPERTY["SALARY_VALUE"]) {
            case '-':
                $PROPERTY['SALARY_VALUE'] = '';
                break;
            case 'по договоренности':
                $PROPERTY["SALARY_VALUE"] = '';
                $PROPERTY["SALARY_TYPE"] = $arProps['SALARY_TYPE']['Договорная'];
            default:
                $arSalary = explode(' ', $PROPERTY['SALARY_VALUE']);
                if ($arSalary[0] == 'от' || $arSalary[0] == 'до') {
                    $PROPERTY['SALARY_TYPE'] = $arProps['SALARY_TYPE'][mb_strtoupper($arSalary[0])];
                    array_splice($arSalary, 0, 1);
                    $PROPERTY['SALARY_VALUE'] = implode(' ', $arSalary);
                } else {
                    $PROPERTY['SALARY_TYPE'] = $arProps['SALARY_TYPE']['='];
                }
        }

        $arLoadProductArray = [
            "MODIFIED_BY" => $USER->GetID(),
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID" => $IBLOCK_ID,
            "PROPERTY_VALUES" => $PROPERTY,
            "NAME" => $data[3],
            "ACTIVE" => end($data) ? 'Y' : 'N',
        ];

//        echo "<pre>";
//        print_r($PROPERTY);
//        echo "</pre>";
//        echo "<hr>";

        if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
            echo "Добавлен элемент с ID : " . $PRODUCT_ID . "<br>";
        } else {
            echo "Error: " . $el->LAST_ERROR . '<br>';
        }
    }
    fclose($handle);
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

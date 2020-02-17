<?php


$locales = GetPrefLocale();
$languagefile = dirname(__FILE__) . "/en.json";

$CurrentLocale = "en";
$lang = json_decode(file_get_contents($languagefile), true);
$languages['en'] = $lang;

$found = false;


if (isset($_REQUEST['lang']) && strlen($_REQUEST['lang']) < 5 && !preg_match('/[^a-zA-Z-]/', $_REQUEST['lang'])) {
    $languagefile = dirname(__FILE__) . "/" . $_REQUEST['lang'] . ".json";

    if (file_exists($languagefile)) {

        $CurrentLocale = $_REQUEST['lang'];
        $lang = json_decode(file_get_contents($languagefile), true);
        $info = pathinfo($languagefile);
        $languages[$_REQUEST['lang']] = $lang;
        $CurrentLocale = $_REQUEST['lang'];
        $found = true;
    }
} elseif (isset($data) && isset($data->lang) && $data->lang) {
    $languagefile = dirname(__FILE__) . "/" . $data->lang . ".json";
    if (file_exists($languagefile)) {

        $CurrentLocale = $data->lang;
        $lang = json_decode(file_get_contents($languagefile), true);
        $info = pathinfo($languagefile);
        $languages[$data->lang] = $lang;
        $CurrentLocale = $data->lang;
        $found = true;
    }
} else {
    foreach (array_keys($locales) as $locale) {
        $languagefile = dirname(__FILE__) . "/" . $locale . ".json";

        if (file_exists($languagefile)) {
            $lang = json_decode(file_get_contents($languagefile), true);
            $info = pathinfo($languagefile);
            $languages[$info['filename']] = $lang;
            $CurrentLocale = $locale;
            $found = true;
            break;
        }
    }


}
$CurrentLanguage = $languages[$CurrentLocale];

function T($str)
{
    global $CurrentLanguage, $CurrentLocale;
    if (isset($_REQUEST['strict-lang'])) {
        if (!isset($CurrentLanguage[$str]) || strlen(trim($CurrentLanguage[$str])) == 0) {


            ?>
            <h2> MISSING <?= $str; ?></h2>
            <?php
            exit;
        }
        return '';
    }
    return $CurrentLanguage[$str];
}

function GetPrefLocale()
{
    $prefLocales = array_reduce(
        explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']),
        function ($res, $el) {
            list($l, $q) = array_merge(explode(';q=', $el), [1]);
            $res[$l] = (float)$q;
            return $res;
        }, []);
    arsort($prefLocales);
    return $prefLocales;
}

?>


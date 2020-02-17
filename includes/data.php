<?php


$data = json_decode(file_get_contents(dirname(__FILE__) . '/config/data.json'));
$product = $data->products[0];
include_once(dirname(__FILE__) . '/../locale/languages.php');

function GetOrderItem($ksdk,$OrderUpsellId){

    $upsells = $ksdk->getUpsells();
    $upsellObject = null;
    foreach ($upsells as $upsell) {
        if ($OrderUpsellId == $upsell->productId) {
            $upsellObject = $upsell;
            break;
        }
    }
    if($upsellObject) {

        if ($order = $ksdk->getOrder()) {

            foreach ($order->items as $item) {

                if ($item->name == $upsellObject->name) {

                    return $item;
                    break;
                }
            }
        }
    }
    return null;
}
?>

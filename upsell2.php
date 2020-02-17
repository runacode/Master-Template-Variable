<?php

//This code must be included at the top of your script before any output is sent to the browser
//-even before <!DOCTYPE> declaration
require_once realpath(dirname(__FILE__) . "/resources/konnektiveSDK.php");
include_once(dirname(__FILE__) .'/includes/data.php');
$pageType = "upsellPage2"; //choose from: presalePage, leadPage, checkoutPage, upsellPage1, upsellPage2, upsellPage3, upsellPage4, thankyouPage
$deviceType = "ALL"; //choose from: DESKTOP, MOBILE, ALL
$ksdk = new KonnektiveSDK($pageType, $deviceType);

$productId = $ksdk->page->productId;
$upsell = $ksdk->getProduct((int)$productId);
 
$orderItem = GetOrderItem($ksdk, $data->upsell1ID);

?>
<!DOCTYPE html>
<html>
<head>
    <title>
        <?= T('FEG Serum - Eyelash Enhancer - Exclusive offer'); ?>
    </title>

    <meta name="viewport" content="width=device-width"/>
    <meta charset="utf-8"/>

    <?php
    //this line of code must go either inside the <head> </head> tags or inside the <body></body> tags
    $ksdk->echoJavascript();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <script>
        window.data = JSON.parse('<?php echo json_encode($data); ?>');
    </script>
    <script src="/resources/js/cart.min.js"></script>

    <link rel="stylesheet" type="text/css" href="resources/css/fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="resources/css/shopify.css">
    <link rel="stylesheet" type="text/css" href="resources/css/upsell.css">
    <link rel="stylesheet" type="text/css" href="resources/css/stamped-reviews.css">
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="page-upsell">
<header class="container-fluid p-0">
    <div class="text-center main-part">
        <div class="logo" style="background-color:white !important;">
            <img src="resources/images/feg-serum-logo.jpg"/>
        </div>
        <div class="upsell-present">
            <div class="d-flex">
                <div><img src="resources/images/present.jpg"/></div>
                <div><?= T('WOW'); ?></div>
                <div><img class="img-hor" src="resources/images/present.jpg"/></div>
            </div>
            <div><em><?= T('You have WON'); ?></em> <em><?= T('a Free'); ?></em><br>
                <?= T('FEG SERUM!'); ?></div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row main-product-block">
        <div class='col-lg-12'>
            <div class='ktemplate_userCopy'>
                <img class="img-fluid" src="resources/images/upsell2.jpg"/>
            </div>
        </div>
        <div class="col-lg-12 right-product-block">
            <div class="row">
                <div class="col-12">
                    <div class="gift-description">
                        <?= T('You are so important to us, so'); ?> <br> <?= T('we are sending you this gift!'); ?>
                        <div class="thank-you"><?= T('THANK YOU!'); ?></div>
                    </div>
                </div>
            </div>
            <div class="row add-to-order">
                <div class="col-12">
                    <form id="kform" onsubmit="return false">
                        <input type="hidden" name="productId" value="<?php echo $upsell->productId; ?>" noSaveFormValue
                               readonly>

                        <?php $ksdk->echoUpsaleCheckoutButton('Claim Now'); ?>

                    </form>
                    <div class="below-upsell-button"><?= T('ONLY PAY'); ?>&nbsp;<?php echo $data->currency . $upsell->price ?> <?= T('Shipping'); ?></div>
                </div>
            </div>
            <div class="row no-thanks">
                <div class="col-12">
                    <a href="<?php echo $ksdk->redirectsTo; ?>"> <?= T('NO, THANKS. I DON\'T WANT A FREE PRESENT'); ?> </a>
                </div>
            </div>


        </div>
    </div>
    <?php if(isset($data->Lo_Site_Id)) {
    ?>
        <script type='text/javascript'>
            window.__lo_site_id = <?php echo $data->Lo_Site_Id; ?>;

                (function () {
                    var wa = document.createElement('script');
                    wa.type = 'text/javascript';
                    wa.async = true;
                    wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(wa, s);
                })();
        </script>
        <?php
    }
    ?>
    <?php

    if ($orderItem) {

        $pageEvent = "Purchase";
        $Value = array("value" => $orderItem->price, 'currency' => $data->FaceBookCurrency);
        $qs = ["Event" => $pageEvent, "Value" => $Value];
        include_once('pixelcode/pixelhelper.php');

    } else {
        $PixelPage = "/upsell.html";

        include_once('pixelcode/pixelhelper.php');
    }

    ?>
</body>
</html>

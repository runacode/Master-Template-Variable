<?php
include 'includes/data.php';
//This code must be included at the top of your script before any output is sent to the browser
//-even before <!DOCTYPE> declaration
require_once realpath(dirname(__FILE__) . "/resources/konnektiveSDK.php");
$pageType = "thankyouPage"; //choose from: presalePage, leadPage, checkoutPage, upsellPage1, upsellPage2, upsellPage3, upsellPage4, thankyouPage
$deviceType = "ALL"; //choose from: DESKTOP, MOBILE, ALL
$ksdk = new KonnektiveSDK($pageType, $deviceType);

$orderItem=GetOrderItem($ksdk,$data->upsell3ID);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Your Order</title>

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
<body class="page-thankyou">

<?php
//pull the order information out of session
$orderId = $ksdk->getOrderId();
$customerName = $ksdk->getCustomerName();
$billingAddress = $ksdk->getBillingAddress();
$shippingAddress = $ksdk->getShippingAddress();
$phoneNumber = $ksdk->getPhoneNumber();
$emailAddress = $ksdk->getEmailAddress();
$itemsTable = $ksdk->getItemsTable();
$subTotal = $ksdk->getSubTotal();
$shipTotal = $ksdk->getShipTotal();
$taxTotal = $ksdk->getTaxTotal();
$surchargeTotal = $ksdk->getSurchargeTotal();
$insuranceTotal = $ksdk->getInsureTotal();
$discountTotal = $ksdk->getDiscountTotal();
$orderTotal = $ksdk->getOrderTotal();
$currency = $ksdk->currencySymbol;
?>

<div class="ktemplate_pageContainer">

    <header class="container-fluid p-0">
        <div class="text-center main-part">
            <div class="logo">
                <img src="resources/images/feg-serum-logo.jpg"/>
            </div>
        </div>
    </header>

    <div class="container thank-you-top">
        <div class="row justify-content-center">
            <div class="kthanks">
                <img class="img-fluid" src="resources/images/thank-you.png"/>
            </div>
        </div>
    </div>
    <div class="kthanks">

        <!-- remove this link if you do not want customers to be able to place a second order -->
        <a href="#" id="kthanks_reorderLink"><?= T('Place a new order'); ?></a>

        <h3 class="main-title mt-4">
            <?= T('Thank you'); ?> <?php echo $customerName ?>!<br>
            <?= T('Your order is confirmed'); ?> <br>
            <?= T('ORDER#'); ?>: <?php echo $orderId ?>
        </h3>

        <div class="below-thank-you mt-2"> <?= T('You’ll receive a confirmation email with your order number shortly'); ?></div>


        <div class="kthanks_box mt-4">
            <div class="kthanks_boxTitle">
                <?= T('Items Ordered'); ?>
            </div>
            <div class="kthanks_boxContent">

                <?php echo $itemsTable ?>

                <hr/>
                <div style="float:right">
                    <div class="kthanks_spacer">
                        <div class="kthanks_label">
                            <?= T('SubTotal'); ?>:
                        </div>
                        <?php echo $currency . $subTotal ?>
                    </div>
                    <div class="kthanks_spacer">
                        <div class="kthanks_label">
                            S &amp; H:
                        </div>
                        <?php echo $currency . $shipTotal ?>
                    </div>
                    <?php if ($taxTotal > 0) { ?>
                        <div class="kthanks_spacer">
                            <div class="kthanks_label">
                                <?= T('Tax'); ?>:
                            </div>
                            <?php echo $currency . $taxTotal ?>
                        </div>
                    <?php } ?>
                    <?php if ($insuranceTotal > 0) { ?>
                        <div class="kthanks_spacer">
                            <div class="kthanks_label">
                                <?= T('Insurance'); ?>:
                            </div>
                            <?php echo $currency . $insuranceTotal ?>
                        </div>
                    <?php } ?>
                    <?php if ($discountTotal > 0) { ?>
                        <div class="kthanks_spacer" style="color:green">
                            <div class="kthanks_label">
                                <?= T('Discount'); ?>:
                            </div>
                            <?php echo $currency . $discountTotal ?>
                        </div>
                    <?php } ?>
                    <div class="kthanks_spacer" style="border-top:1px solid #CCC">
                        <div class="kthanks_label">
                            <?= T('Grand Total'); ?>:
                        </div>
                        <?php echo $currency . $orderTotal ?>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>


        <div>

            <div class="kthanks_box">
                <div class="kthanks_boxTitle">
                    <?= T('Billing Information'); ?>
                </div>
                <div class="kthanks_boxContent">
                    <?php echo $billingAddress ?><br/>
                    <?php echo $emailAddress ?><br/>
                    <?php echo $phoneNumber ?><br/>
                </div>
            </div>

            <div class="kthanks_box d-none">
                <div class="kthanks_boxTitle ">
                    <?= T('Shipping Information'); ?>
                </div>

                <div class="kthanks_boxContent">
                    <?php echo $shippingAddress ?>
                </div>

            </div>
        </div>
        <div style="clear:both"></div>

        <p><?= T('*A confirmation email has been sent to'); ?><?php echo $emailAddress ?> </p>

    </div>

</div>

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
<script>
    $.removeCookie('cart', {path: '/'});

</script>
</body>
</html>








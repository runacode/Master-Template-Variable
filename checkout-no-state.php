<?php
include_once(dirname(__FILE__) . '/locale/languages.php');
//This code must be included at the top of your script before any output is sent to the browser
//-even before <!DOCTYPE> declaration
require_once realpath(dirname(__FILE__) . "/resources/konnektiveSDK.php");
$pageType = "checkoutPage"; //choose from: presalePage, leadPage, checkoutPage, upsellPage1, upsellPage2, upsellPage3, upsellPage4, thankyouPage
$deviceType = "ALL"; //choose from: DESKTOP, MOBILE, ALL
$ksdk = new KonnektiveSDK($pageType, $deviceType);

?>

<!DOCTYPE html>
<html>
<head>
    <title>
        <?= T('Checkout - Rocket Commerce'); ?>
    </title>

    <meta name="viewport" content="width=device-width"/>
    <meta charset="utf-8"/>

    <?php
    //this line of code must go either inside the <head> </head> tags or inside the <body></body> tags
    $ksdk->echoJavascript();
    ?>
    <link rel="stylesheet" type="text/css" href="resources/css/fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="resources/css/shopify.css">
    <link rel="stylesheet" type="text/css" href="resources/css/stamped-reviews.css">
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
        window.product = <?php echo json_encode($product); ?>;
        window.data = <?php echo json_encode($data); ?>;
    </script>
    <script src="/resources/js/cart.min.js?rand=<?php echo rand(0,1000); ?>"></script>
    <style>body {
            margin: 8px !important;
        }</style>
</head>
<body class="page-checkout">
<div class='ktemplate_pageContainer'>
    <header class="container-fluid p-0">
        <div class="d-flex justify-content-center main-part">
            <div class="logo">
                <img src="resources/images/feg-serum-logo.jpg"/>
            </div>
        </div>
    </header>
    <div class="top-steps-wrap">
        <div class="top-steps">
            <span><i class="fa fa-check-circle"></i><span><?= T('Your Selection'); ?></span></span>
            <span><i class="fa fa-check-circle"></i><span><?= T('Your Details'); ?></span></span>
            <span><i class="fa fa-circle blink-me"></i><span><?= T('Final Step'); ?></span></span>
        </div>
    </div>
    <?php echo $ksdk->getShoppingCart() ?>

    <div style="
    padding: 20px;
    margin: 15px 6px 0;
    border: 1px solid #000;
    color: #333;
    font-weight: 400;
    font-size: 22px;
    text-align: center;"><?= T('Express Checkout'); ?><br><?php $ksdk->echoPaypalCheckoutButton(); ?></div>

    <form id='kform' class='kform kform_kcartCheckout' onsubmit='return false;'>
        <div class='kform_layout2Col kform_layout2Col_L'>
            <h3> <?= T('Contact Information'); ?></h3>
            <div class="all-fields-required">
                <span>*</span><span><?= T('All fields are required to ship your order correctly'); ?>&nbsp;</span>
                <i class="fa fa-check"></i>
            </div>
            <div class="kform_spacer">
                <input name="firstName" type="TEXT" isRequired>
            </div>
            <div class="kform_spacer">
                <input name="lastName" type="TEXT" isRequired>
            </div>

            <div class="kform_spacer">
                <input name="emailAddress" type="TEXT" isRequired>
            </div>
            <h3> <?= T('Billing Address'); ?></h3>
            <div class='kform_spacer'>
                <input name='address1' type='TEXT' isRequired>
            </div>


            <div class='kform_spacer'>
                <select name='city'  type='TEXT' isRequired>
                    <option value=''><?= T('Select City'); ?></option>
                </select>
            </div>

            <div class='kform_spacer' style="display:none">
                <input type="hidden" name='state' />
            </div>


            <div class='kform_spacer'>
                <select name='country' defaultText='country'>
                </select>
            </div>

            <div class='kform_spacer'>
                <input name='postalCode' type='TEXT' isRequired>
            </div>
            <div class='kform_spacer kform_checkbox'>
                <input name='billShipSame' type='CHECKBOX' checked>
                <label for='billShipSame'>
                    <?= T('Shipping Address same as Billing'); ?>
                </label>
            </div>
            <div id='kform_hiddenAddress'>
                <div class='kform_spacer'>
                    <input name='shipAddress1' type='TEXT' isRequired>
                </div>

                <div class='kform_spacer'>
                    <input name='shipAddress2' type='TEXT'>
                </div>

                <div class='kform_spacer'>
                    <select name='shipCity'   isRequired>
                        <option value=''><?= T('Select City'); ?></option>
                    </select>
                </div>

                <div class='kform_spacer' style="display:none">
                    <input type="hidden" name='shipState' />
                </div>

                <div class='kform_spacer'>
                    <select name='shipCountry'></select>
                </div>

                <div class='kform_spacer'>
                    <input name='shipPostalCode' type='TEXT' isRequired>
                </div>
            </div>

        </div>

        <div class='kform_layout2Col  kform_layout2Col_R'>


            <table class='kcartTotals'>
                <tr>
                    <td><?= T('Sub Total'); ?></td>
                    <td class='kcartSubTotal'>0.00</td>
                </tr>
                <tr>
                    <td><?= T('Shipping'); ?></td>
                    <td class='kcartShipTotal'>0.00</td>
                </tr>
                <tr>
                    <td><?= T('Sales Tax'); ?></td>
                    <td class='kcartSalesTax'>0.00</td>
                </tr>
                <tr>
                    <td><?= T('Discount'); ?></td>
                    <td class='kcart<?= T('Discount'); ?>'>0.00</td>
                </tr>
                <tr>
                    <td><?= T('Insurance'); ?></td>
                    <td class='kcart<?= T('Insurance'); ?>'>0.00</td>
                </tr>
                <tr>
                    <td><b><?= T('Grand Total'); ?></b></td>
                    <td class='kcartGrandTotal'>0.00</td>
                </tr>
            </table>


            <input type="hidden" name='paySource' value="CREDITCARD">
            <div class='kform_spacer'>
                <h3><?= T('Credit Card'); ?></h3>
                <div class="text-center"><a href="javascript:$('#kform_payPalButton').click()"> <img class="img-fluid"
                                                                            src="resources/images/sponsors-02.jpg"></a>
                <div style='display:none'>
                    <div id='kformPaySourceWrap' inputType='radio'></div>
                    <div class='kform_spacer' id='kformNewPaymentType'>
                        <input type='checkbox' name='newPaymentType'>
                        <span>
                                New <?= T('Credit Card'); ?>
                            </span>
                    </div>
                </div>
            </div>

            <div id='kform_paySourceCard'>
                <div class='kform_spacer'>
                    <input name='cardNumber' type='TEXT' maxlength=16 isRequired>
                </div>

                <div class='kform_spacer'>
                    <input name='cardSecurityCode' type='TEXT' maxlength=4>
                </div>

                <div class='kform_spacer' style='text-align:right'>
                    <label for='cardMonth' style='width:30%;text-align:middle;'>
                        <?= T('Expiration'); ?>:
                    </label>
                    <select name='cardMonth' style='width:30%' isRequired>
                        <option value='01'><?= T('01 (Jan)'); ?></option>
                        <option value='02'><?= T('02 (Feb)'); ?></option>
                        <option value='03'><?= T('03 (Mar)'); ?></option>
                        <option value='04'><?= T('04 (Apr)'); ?></option>
                        <option value='05'><?= T('05 (May)'); ?></option>
                        <option value='06'><?= T('06 (Jun)'); ?></option>
                        <option value='07'><?= T('07 (Jul)'); ?></option>
                        <option value='08'><?= T('08 (Aug)'); ?></option>
                        <option value='09'><?= T('09 (Sep)'); ?></option>
                        <option value='10'><?= T('10 (Oct)'); ?></option>
                        <option value='11'><?= T('11 (Nov)'); ?></option>
                        <option value='12'><?= T('12 (Dec)'); ?></option>
                    </select>
                    <select name='cardYear' style='width:30%' isRequired>
                        <option value='2019'>2019</option>
                        <option value='2020'>2020</option>
                        <option value='2021'>2021</option>
                        <option value='2022'>2022</option>
                        <option value='2023'>2023</option>
                        <option value='2024'>2024</option>
                        <option value='2025'>2025</option>
                        <option value='2026'>2026</option>
                        <option value='2027'>2027</option>
                        <option value='2028'>2028</option>
                        <option value='2029'>2029</option>
                        <option value='2030'>2030</option>
                        <option value='2031'>2031</option>
                        <option value='2032'>2032</option>
                        <option value='2033'>2033</option>
                        <option value='2034'>2034</option>
                        <option value='2035'>2035</option>
                        <option value='2036'>2036</option>
                        <option value='2037'>2037</option>
                        <option value='2038'>2038</option>
                        <option value='2039'>2039</option>
                    </select>
                </div>
            </div>

            <button class='kform_submitBtn' id='kformSubmit'><?= T('Complete Order'); ?> <i
                        class="fa fa-arrow-circle-right"></i></button>
            <div class="text-center mt-2"><img class="img-fluid" src="resources/images/sponsors-01.jpg"</div>


            <input type='hidden' name='orderItems' value=''>
        </div>


    </form>
    <br><br>
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
<div style="clear:both; padding-bottom: 20px;"></div>

<script>
    $(document).ready(Load)

    function Load() {
        if (!window.kform || !window.kform.states) {
            setTimeout(Load, 200);
            return;
        }
        var States=window.kform.states.<?php echo strtoupper($data->country_1); ?>;
        $(Object.keys(States)).each(function (i, item) {
            $("[name='city']").append($('<option />').val(States[item]).text(States[item]))
        })

        $(Object.keys(States)).each(function (i, item) {
            $("[name='shipCity']").append($('<option />').val(States[item]).text(States[item]))
        })
        $("[name='shipCity']").change(function () {
            $("[name='shipState']").val($("[name='shipCity']").val())
        })
        $("[name='city']").change(function () {
            $("[name='state']").val($("[name='city']").val())
        })
    }
</script>
</body>
</html>


<?php

$pageEvent = "InitiateCheckout";
$qs = ["Event"=>$pageEvent];
include_once('pixelcode/pixelhelper.php');


?>









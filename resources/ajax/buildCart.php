<?php

//get current cart items from ksdk
$cart = (array)$ksdk->getSessValue('cart');

//get product details from ksdk
$products = $ksdk->getProducts();
function getProductsTotal($cart, $products){
    $total = 0;

    foreach ($cart as $productId => $qty) {
        //get detailed information about the individual item
        //details are stored in an object in the products array
        $item = $products[$productId];


        $total += $item->price * $qty;
    }

    return $total;
}

//if the customer has logged into their eCommerce account, this object will exist in session
$customer = $ksdk->getSessValue('customer');

//where user is sent after clicking the "Continue Shopping" html button
$shopUrl = $ksdk->getPageUrl('catalogPage');


?>

<div class="order-summary-toggle">
    <button id="order-summary-toggle-button" class="d-flex w-100"><span><i class="fa fa-shopping-basket"></i> Order Summary <i class="fa fa-angle-down"></i></span> <b><?= T('currency') . getProductsTotal($cart, $products) ?> </b></button>
</div>
<div id='kcartDetail' class="d-none">
    <br>
    <!-- a button for going back and adding more items to the cart -->
    <!-- the href attribute does not usually go on input buttons, but we've added it here as the button behaves like a link
    and sends the user to the url specified in the href attribute -->
    <input type='button' value='Continue Shopping' class='kcartShopButton' href="<?php echo $shopUrl; ?>">
    <div id='kcartTitle'><?= T('Your Shopping Cart'); ?></div>

    <?php if(!empty($customer)) { ?>
        <span class='kcartLogoutWrap'>
        	<?= T('logged in as'); ?> <?php echo $customer->emailAddress; ?>
            <span id='kcartLogout'><?= T('log out'); ?></span>
        </span>
    <?php } else {?>
        <span  class='kcartLogoutWrap'> <?= T('Have an Account ?'); ?> </span><span id='kcartSigninButton'><?= T('Sign In'); ?></span>
        <?php
    }
    //build a table with column titles
    ?>
    <table id='kcartTable'>
        <tr id='kcartTitleRow'>
            <td  style='width:200px'><?= T('Item'); ?></td>
            <td><?= T('Qty'); ?></td>
            <td><?= T('Description'); ?></td>
            <td><?= T('Amount'); ?></td>
            <td >&nbsp;</td>
        </tr>
        <?php

        //If cart is empty, display a message about the empty cart
        if(empty($cart))
        {
        ?>
        <tr>
            <td colspan=5 id='kcartEmptyCartWarning'>
                <?= T('Your shopping cart is currently empty. Click the continue shopping button to add products to your cart.'); ?>
            </td>
        </tr>
    </table>

<?php
return;
}
//loop through products in the cart, building each row of the table
foreach($cart as $productId=>$qty)
{
    //get detailed information about the individual item
    //details are stored in an object in the products array
    $item = $products[$productId];

    //define variables to output in html
    $name = $item->name;
    $description = "<i>*description unvailable</i>";
    if(!empty($item->description))
        $description = $item->description;

    $currency = $ksdk->currencySymbol;
    $itemSubTotal = number_format($item->price,2);
    //by mafiozzzza
    $itemSubTotal = number_format($item->price * $qty,2);
    $imageUrl = $item->imagePath;

    //build the row <tr>

    ?>
    <tr class='kcartItem' productId='<?php echo $productId ?>'>
        <td>
            <img src='<?php echo $imageUrl ?>' class='kcartProductImage'>
        </td>
        <td>
            <div class="name"><?php echo  $name ?></div>
            <div style='white-space:nowrap' class="description">
                <div><?= T('Quantity'); ?></div>
                <div>
                    <span class='kcartMinusBtn'>-</span>
                    <span class='kcartItemQty'><?php echo $qty ?></span>
                    <span class='kcartPlusBtn'>+</span> Unit<?php echo $qty > 1 ? 's' : ''; ?>
                </div>
            </div>
            <div class="subtotal"><div><?= T('Subtotal'); ?></div><div><?php echo  $currency ?><?php echo $itemSubTotal; ?></div></div>
            <div class="low-stock"><img src="resources/images/low_battery.jpg"/> <?= T('LOW STOCK'); ?></div>
        </td>
    </tr>
    <?php
}

//done looping, close out the table

?>
    </table>
    <div class="customers-love"><?= T('Customers love this product!'); ?> <i class="fa fa-star"></i><i class="fa fa-star"></i>
        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>(4.9/5)</div>
    <div class="review-highlights">
        <div class="title"><?= T('Review Highlights'); ?></div>
        <div class="items">
            <div>
                <div><i class="fa fa-star"></i></div>
                <div>
                    <div><b>"<?= T('Works if you keep to the plan'); ?>"</b></div>
                    <div>73 <?= T('related reviews'); ?></div>
                </div>
            </div>
            <div>
                <div><i class="fa fa-star"></i></div>
                <div>
                    <div><b>"<?= T('I have noticed quite an improvement in my lashes'); ?>"</b></div>
                    <div>57 <?= T('related reviews'); ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="upsell-timer"></div>
</div>
<div>
</div>


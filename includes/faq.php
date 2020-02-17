<div class="rc-faq">
    <h3><?= T('Sales'); ?></h3>
    <h5><?= T('I found that in my purchase only contained two products. I get the third free product?'); ?></h5>
    <p><?= T('Don\'t worry, will arrive at your place all the three products! Our shipping agent specializes in detecting this type of error, he will add the third free iten to your order!'); ?></p>


    <h3><?= T('Shop info'); ?></h3>

    <h5><?= T('What are the payment methods?'); ?></h5>
    <p><?= T('You can make the payment as follows'); ?>:</p>
    <ul>
        <li><?= T('Credit Card'); ?></li>
        <li><?= T('Paypal'); ?></li>
    </ul>
    <p><?= T('All our payments are processed and secured by Paypal and Credit Card, ensuring that all transactions are safe for us and for our customers'); ?></p>

    <h5><?= T('It\'s safe to shop at this store?'); ?></h5>
    <p><?= T('Yes! We know that many customers have had bad experiences buying into other sites, but We are a serious and legitimate company that fulfills its responsibilities to all customers'); ?></p>
    <p><?= T('We take a lot of care with the information you provide to us when you place an order The server hosting the transmission of information using SSL (Secure Sockets Layer)'); ?></p>
    <p><?= T('Also, we take care to control the quality of all our products before shipment, so your experience with us will be always fantastic!'); ?></p>
    <p><?= T('By shopping with us, you will have the assistance of our support anytime, by email or Facebook'); ?></p>
    <p><?= T('We also ensure that you receive your product or get their money back =)'); ?></p>
    <p><?= T('We have many testimonials from customers who have already received their purchases on our website, Facebook and Instagram!'); ?></p>

    <h5><?= T('How do I buy it?'); ?></h5>
    <p><?= T('It\'s quite simple! Just go on the product page you want to purchase, choose the model and the quantity and click "Add to Cart"'); ?></p>
    <p><?= T('You will be redirected to your shopping cart where you can finalize the request to enter your address and payment information'); ?></p>

    <h3><?= T('REQUEST'); ?></h3>

    <h5><?= T('Do you ship to my city?'); ?></h5>
    <p><?= T('Yes, we send to all country safely and to the address provided at the time of purchase! Please make sure to correctly enter the address at the time of purchase'); ?></p>


    <h3><?= T('Deadlines and Delivery'); ?></h3>

    <h5><?= T('What is the deadline?'); ?></h5>
    <p><?= T('Usually it takes 10 to 20 business days to be delivered! You can follow the tracking on the 17Track website https //17tracknet/en'); ?></p>
    <p><?= T('We pay all shipping fees for the product, so you don\'t have to pay any additional fees! )'); ?></p>

    <h5><?= T('How can I track the delivery?'); ?></h5>
    <p><?= T('You will receive the tracking code of your order within 72 hours after confirmation of payment'); ?></p>
    <p><?= T('With this code, you will be able to accompany the consignment at the Post Office site - click here!'); ?></p>

    <h5><?= T('I want to report a problem with my order!'); ?></h5>
    <p><?= T('If you have a problem with your order, our customer support team is always available You can contact them by e-mail'); ?>:
        &nbsp;&nbsp;<a href="mailto:<?= $product->support_email; ?>"><?= $product->support_email; ?></a>&nbsp;<?= T('We will answer you within 24 business hours'); ?>
    </p>

    <h5><?= T('My order is not being moved or updated What to do?'); ?></h5>
    <p><?= T('Your order status may remain the same for a few days, but don\'t worry, this is normal!'); ?></p>
    <p><?= T('Tracking information will be updated when the package arrives in UK If your order is not delivered within 20 working days, please contact our customer support team by email'); ?>:
        &nbsp;&nbsp;<a href="mailto:<?= $product->support_email; ?>"><?= $product->support_email; ?></a>&nbsp;<?= T('Our team is always available to serve you and your email will be answered within 24 working hours!'); ?>
    </p>

    <h5><?= T('My tracking code shows that the product is \pending removal\" (or the delivery was missing), what should I do?"'); ?></h5>
    <p><?= T('Sometimes, the Post Office attempt delivery of your product, but find some kind of problem in the process When this happens, your tracking code is updated with any of these statuses \Waiting for withdrawal\" \"delivery attempt fails,\" \"unknown customer in the place\""'); ?></p>
    <p><?= T('In such cases, they leave the product in an agency to be taken by the customer'); ?>
        <br><?= T('Call the nearest post office from your location and check if they can release your package so you can go there and pick it up with your document and your tracking code'); ?>
    </p>
    <p><?= T('We recommend that you do so urgently, because the post office keep the product a time for withdrawal and this time the recipient does not get the product, they send back to the supplier'); ?>
        <br><?= T('If you have any questions about the code or procedure, please send an email to our support, we will help you'); ?>
    </p>

    <h3><?= T('Return, Refund and Exchange (Guarantee)'); ?></h3>

    <h5><?= T('I received my damaged product, what to do?'); ?></h5>
    <p><?= T('Please contact our customer support team by email'); ?>:<a
                href="mailto:<?= $product->support_email; ?>"><?= $product->support_email; ?></a>&nbsp;<?= T('Always attach a photo and / or video to show the problem with your product The customer support team is always available to serve you and respond within 24 working hours Rest assured, we will find the best solution!'); ?>
    </p>

    <h5><?= T('I\'m not satisfied with the product I received How can I return it?'); ?></h5>
    <p><?= T('Please contact us, please email'); ?><a
                href="mailto:<?= $product->support_email; ?>"><?= $product->support_email; ?></a>&nbsp;<?= T('We respond within 24 working hours'); ?>
    </p>
    <p><?= T('The cost of returning the product in perfect condition to sell, will be the buyer\'s responsibility'); ?></p>
    <p><?= T('We ask you to describe in email the reason for his dissatisfaction and send us a photo and / or video of the product received so we can offer a solution'); ?></p>

    <h5><?= T('Can I change or cancel my order?'); ?></h5>
    <p><?= T('To cancel or change your order, send us an email to'); ?><a
                href="mailto:<?= $product->support_email; ?>"><?= $product->support_email; ?></a>&nbsp;<?= T('up to 24 hours after payment'); ?>
    </p>
    <p><?= T('After this period your order has already been shipped and will be en route to the address you entered'); ?></p>


    <p><strong><?= T('Did not find the answer? Contact us!'); ?></strong></p>
</div>


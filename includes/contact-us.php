<?php
require_once 'data.php';
if($_POST['contact-name']) {
    $name = htmlspecialchars(stripslashes(trim($_POST['contact-name'])));
    $subject = htmlspecialchars(stripslashes(trim($_POST['contact-subject'])));
    $email = htmlspecialchars(stripslashes(trim($_POST['contact-email'])));
    $order_number = htmlspecialchars(stripslashes(trim($_POST['contact-order-number'])));
    $message = htmlspecialchars(stripslashes(trim($_POST['contact-message'])));

    $body = " Name: $name\n Subject: $subject\n E-mail: $email\n Order #$order_number\n Message:\n $message";
    if (mail($data->support_email, 'Contact Us - ' . $data->country_1, $body)) {
        echo json_encode( (object)['code' => 0, 'message' => '<p style="color: green">Thanks for contacting us. We\'ll get back to you as soon as possible.</p>']);
    } else {
        echo json_encode( (object)['code' => 1, 'message' => '<p style="color: red">Error occurred, please try again later</p>']);
    }
    die();
}
?>
<div id="contact-form-response" class="d-none"></div>
<form class="needs-validation" action="" novalidate id="contact-form">
    <div class="form-group">
        <input type="name" class="form-control" id="contact-name" name="contact-name" placeholder="*Name" required>
        <div class="invalid-feedback">
            Please enter you name.
        </div>
    </div>
    <div class="form-group">
        <select class="form-control" id="contact-subject" name="contact-subject" required>
            <option value="" selected="selected" disabled="disabled">Subject</option>
            <option value="Questions about the product">Questions about the product</option>
            <option value="Questions about my order">Questions about my order</option>
            <option value="Trouble Paying">Trouble Paying</option>
            <option value="Payment">Payment</option>
            <option value="Partnership">Partnership</option>
            <option value="Others">Others</option>
        </select>
    </div>
    <div class="form-group">
        <input type="email" class="form-control" id="contact-email" name="contact-email" placeholder="*Email" required>
        <div class="invalid-feedback">
            Please enter you email.
        </div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="contact-order-number" name="contact-order-number" placeholder="Order Number">
    </div>
    <div class="form-group">
        <textarea class="form-control" id="contact-message" name="contact-message" rows="5" required></textarea>
        <div class="invalid-feedback">
            Please enter you message.
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary mb-2">Send Message</button>
    </div>
</form>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    event.stopPropagation();

                    if (form.checkValidity() === true) {
                        $.ajax({
                            type: 'POST',
                            url: '/includes/contact-us.php',
                            data: $('#contact-form').serializeArray(),
                            dataType: 'json',
                            success: function(response){
                                console.log(response);
                                if(response.code == 0){
                                    $('#contact-form').addClass('d-none');
                                }
                                $('#contact-form-response').html(response.message);
                                $('#contact-form-response').removeClass('d-none');
                            }
                        });
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

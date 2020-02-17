if (!Array.prototype.find) {
    Object.defineProperty(Array.prototype, 'find', {
        value: function(predicate) {
            // 1. Let O be ? ToObject(this value).
            if (this == null) {
                throw TypeError('"this" is null or not defined');
            }

            var o = Object(this);

            // 2. Let len be ? ToLength(? Get(O, "length")).
            var len = o.length >>> 0;

            // 3. If IsCallable(predicate) is false, throw a TypeError exception.
            if (typeof predicate !== 'function') {
                throw TypeError('predicate must be a function');
            }

            // 4. If thisArg was supplied, let T be thisArg; else let T be undefined.
            var thisArg = arguments[1];

            // 5. Let k be 0.
            var k = 0;

            // 6. Repeat, while k < len
            while (k < len) {
                // a. Let Pk be ! ToString(k).
                // b. Let kValue be ? Get(O, Pk).
                // c. Let testResult be ToBoolean(? Call(predicate, T, « kValue, k, O »)).
                // d. If testResult is true, return kValue.
                var kValue = o[k];
                if (predicate.call(thisArg, kValue, k, o)) {
                    return kValue;
                }
                // e. Increase k by 1.
                k++;
            }

            // 7. Return undefined.
            return undefined;
        },
        configurable: true,
        writable: true
    });
}
window.cart = {
    line_items: [],
    was: 0,
    saving: 0,
    total: 0,
    cartSave: function () {
        $.cookie('cart', JSON.stringify(cart.line_items));
    },
    cartRestore: function () {
        if ( $.cookie('cart')) {
            console.log('hehe');
            window.cart.line_items = JSON.parse($.cookie('cart'));
        }
    },
    updateSession: function(){
        var updateSession = {};
        for(var index in window.cart.line_items){
            var item = window.cart.line_items[index];
            updateSession[item.cid] = item.qty;
        }
        console.log('CART updateSession', updateSession);
        kform.cart.updateSession(updateSession);

    },
    addToCart: function () {
        if (!window.cart.line_items.length) {
            var line_item = window.product;
            line_item.qty = 0;
            window.cart.line_items.push(line_item);
        }
        var free_line_item = JSON.parse(JSON.stringify(window.product));
        var Quantity = $('[name="qty"]:visible').val() || 1 ;

        console.log('QTY', window.cart.line_items[0].qty);
        window.cart.line_items[0].qty += +Quantity;
        // window.kform.cart.addToCart(window.product.cid, 1);
        console.log('QTY', window.cart.line_items[0].qty);

        if (window.cart.line_items[0].qty >= 2 && ! this.line_items.find(function(a){
            return a.cid === free_line_item.cid_free;
        })) {

            free_line_item.price = 0;
            free_line_item.cid = free_line_item.cid_free;
            free_line_item.qty = 1;
            console.log('Add free item', free_line_item);
            this.line_items.push(free_line_item);
            // kform.cart.addToCart(window.product.cid_free, 1);
        }
        if(window.fbq){
            window.fbq('track', 'AddToCart');
        }
        this.updateSession();
        this.cartSave();
    },
    removeFromCart: function () {
        window.cart.line_items[0].qty--;
        // kform.cart.minusItem(window.product.cid);


        if (window.cart.line_items[0].qty < 2) {
            // kform.cart.minusItem(window.product.cid_free);
            this.line_items.splice(1, 1);
        }
        if (window.cart.line_items[0].qty < 1) {
            window.cart.line_items = [];
        }

        this.updateSession();
        this.cartSave();
    },
    getCartWas: function(){
        var was = 0;
        window.cart.line_items.forEach(function(item) {
            was += item.old_price * item.qty;
        }.bind(this));
        return (Math.round(was*100)/100);
    },
    getCartTotal: function(){
        var total = 0;
        window.cart.line_items.forEach(function(item) {
            total += item.price * item.qty;
        }.bind(this));
        return (Math.round(total*100)/100);
    },
    render: function () {
        var r = '<div class="container cart-header">';
        r += '<div class="row">';
        r += '<div class="col-10 cart-title">';
        r += 'Cart';
        r += '</div>';
        r += '<div class="col-2">';
        r += '<button class="close-cart">X</button>';
        r += '</div>';
        r += '</div>';
        r += '</div>';

        if (window.cart.line_items && window.cart.line_items.length) {
            r += '<div class="upsell-timer"></div>';
            r += '<div class="container cart-line-items text-center">';
            window.cart.line_items.forEach(function(item, i)  {
                    if(i>1){
                        return;
                    }
                r += '<div class="row line-item' + (i == 1 ? ' free-item' : '') + '">';
                r += '<div class="col-3 img">';
                r += '<img src="' + item.img_small + '" class="img-fluid" />';
                r += '</div>';
                r += '<div class="col-6 name">';
                r += '<div>' + item.name + '</div>';
                r += '<div><button class="qty-button qty-button_minus" data-line_index="' + i + '">-</button> '+ item.qty +' <button class="qty-button qty-button_plus"  data-line_index="' + i + '">+</button></div>';
                r += '</div>';
                r += '<div class="col-3 price">';
                r += '<div>' + data.currency + item.price + '</div>';
                r += '</div>';
                r += '</div>';

            });

            r += '</div>';
            r += '<div class="container cart-total">';
            r += '<div class="row was">';
            r+= document.querySelector('#WasTemplate').innerHTML
            r += '<div class="col-6 ">';
            r += data.currency + this.getCartWas();
            r += '</div>';
            r += '</div>';
            r += '<div class="row saving">';
            r+= document.querySelector('#SavingTemplate').innerHTML
            r += '<div class="col-6 ">';
            r += data.currency + Math.round((this.getCartWas()-this.getCartTotal()) * 100) / 100;
            r += '</div>';
            r += '</div>';
            r += '<div class="row total">';
            r+= document.querySelector('#TotalTemplate').innerHTML
            r += '<div class="col-6 ">';
            r += data.currency + this.getCartTotal();
            r += '</div>';
            r += '</div>';
            r += '</div>';
            r+= document.querySelector('#CartBottomTemplate').innerHTML
        } else {
            r += '<div class="container cart-bottom">';
            r += '<div class="row">';
            r += '<div class="col-12 name">';
            r+= document.querySelector('#CartTempty').innerHTML
            r += '<div><img class="img-fluid pl-5 pt-1 pr-5" src="resources/images/sponsors-01.jpg" /></div>';
            r += '</div>';
            r += '</div>';
        }
        r += '</div>';

        return r;
    },
    updateCartView: function(){
        var cart = $('<div>' + window.cart.render() + '</div>');
        var lineItems = cart.find('.cart-line-items');
        var total = cart.find('.cart-total');

        $('.cart-container .cart .cart-line-items').html( lineItems.html() );
        $('.cart-container .cart .cart-total').html( total.html() );
    }
};

$(document).ready(function () {

    if($('.cart-container .cart').length){
        window.cart.cartRestore();
        $('.cart-container .cart').html(window.cart.render());

        $('.add-to-cart').click(function () {

            window.cart.addToCart();

            $('.cart-container .cart').html(window.cart.render());
            $('.cart-container').removeClass('d-none');

        });
        $('.cart-button').click(function () {
            $('.cart-container').toggleClass('d-none');
        });
        $(document).on('click', '.close-cart', function () {
            $('.cart-container').addClass('d-none');
        });
        $(document).on('click', '.qty-button_minus', function () {
            window.cart.removeFromCart();
            window.cart.updateCartView();
        });
        $(document).on('click', '.qty-button_plus', function () {
            window.cart.addToCart();
            // $('.cart-container .cart').html(window.cart.render());
            window.cart.updateCartView();
        });
        setInterval(function () {
            fnDate();
        }, 2000);

    }


    var countdown = $.cookie('upsell_1-countdown') ? $.cookie('upsell_1-countdown') : 0;
    getCountdownMessage('.upsell-timer', countdown );
});
function fnDate() {
    var counter = $('.persons-online>span');
    var count = Math.floor(Math.random() * 91 + 210);

    if(counter.length){
        counter.text(count);
    }
}

/* Countdowns */
function getCountdownMessage(selector, time,message) {
    if(!message) message = false;
    // Update the count down every 1 second
    var x = setInterval(function () {
        target = $(selector);
        if(!target.length) return;

        var now = new Date().getTime();
        var distance = time - now;

        if (distance < 0 /* && jQuery.cookie('develop') != 'true'*/) {
            time = now + 15*60*1000;
            distance = time - now;
            $.cookie('upsell_1-countdown', time);
        }

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if (hours < 10) {
            hours = "0" + hours;
        }
        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        if (seconds < 10) {
            seconds = "0" + seconds;
        }
//console.log(jQuery.cookie('develop'));

        // If the count down is finished, write some text
        if(!message){
            message = 'Special Offer Ends in';
        }

        target.html(window.DiscountMessage   + ' <span>' + (hours) + ':' + (minutes) + ':' + (seconds) + '</span>');
    }, 1000);
}

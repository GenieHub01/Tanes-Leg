

// $.growl({ title: "Growl", message: "The kitten is awake!" });
// $.growl.error({ message: "The kitten is attacking!" });
// $.growl.notice({ message: "The kitten is cute!" });
// $.growl.warning({ message: "The kitten is ugly!" });


function updateCartCount(count) {
    $('.cart_count').html(count > 0 ? count : '');
}

$('a.add_to_cart').click(function (e) {
    e.preventDefault();
    var data = {
        id: $(this).attr('data-id'),
        qty: $('#qty').val()
    };

    $.get(
        '/cart/add-item',
        data
        ,
        function (respond) {
            $.growl({title: "Cart", message: "Item added."});
            updateCartCount(respond.count);

        },
    ).fail(function (xhr, status, error) {
        showError(xhr, status, error);
    });
});

function updateCartLine(item) {
    if (item){
        var idDiv = '#cartItem_' + item.id;
        $(idDiv).replaceWith(item.html);
    }

    // updateCart(respond);
}

function updateCart(respond){
    // if (respond.item){
    //     updateCartLine(respond.item);
    // }


    $('.subTotal').html(respond.subTotal);
    $('.holdingDeposit').html(respond.holdingDeposit);
    $('.taxAmount').html(respond.taxAmount);
    $('.shippingAmount').html(respond.shippingAmount);

    if (respond.extraShippingAmount){
        $('.extraShipping').show();
        $('.extraShippingAmount').html(respond.extraShippingAmount);
    } else {
        $('.extraShipping').hide();
    }



    $('.baseShippingAmount').html(respond.baseShippingAmount);

    $('.cartTotal').html(respond.cartTotal);

    if (respond.promocode) {

        $('.promocodeBlock').show();
        $('.promocodeTotal').html(respond.promocode.promoTotalShipping);
        $('.promocodeDesc').html(respond.promocode.desc);

    } else {
        $('.promocodeBlock').hide();
    }
        // $('.promocodeSum').html(respond.promocodeSum);

    //
    // $('.cart_total_sum').html(sum);
    // $('.cart_total_tax').html(tax);
    // $('.cart_total_sumtotal').html(sumtotal);
    // $('#shippingAmount').html(  shipping );
    // $('.cart_holding').html( deposit);
    // $('#extraShipping').html(extraShipping );
}

$('body').on('change', '#order-country_id', function (e) {
    $obj = $(this);
    $.get(
        '/cart/set-country',
        {
            id: $obj.val()
        }
        ,
        function (respond) {
            $.growl({title: "Cart", message: "Country settings changed. Check total Sum." });
            // $.growl({title: "Cart", message: "Item added." });
            // updateCartCount(respond.cart.count);
            // updateCartLine(respond.item);
            updateCart(respond.cart);

        },
    ).fail(function (xhr, status, error) {
        showError(xhr, status, error);
    });

});
$('body').on('click', 'a.cart-plus-item', function (e) {
    e.preventDefault();
    var data = {
        id: $(this).attr('data-id')
    };

    $.get(
        '/cart/add-item',
        data
        ,
        function (respond) {
            // $.growl({title: "Cart", message: "Item added." });
            updateCartCount(respond.cart.count);
            updateCartLine(respond.item);
            updateCart(respond.cart);

        },
    ).fail(function (xhr, status, error) {
        showError(xhr, status, error);
    });
});


$('body').on('click', 'a.cart-minus-item', function (e) {
    e.preventDefault();
    var data = {
        id: $(this).attr('data-id')
    };

    $.get(
        '/cart/delete-item',
        data
        ,
        function (respond) {
            // $.growl({title: "Cart", message: "Item added." });
            updateCartCount(respond.cart.count);
            updateCartLine(respond.item);
            updateCart(respond.cart);

        },
    ).fail(function (xhr, status, error) {
        showError(xhr, status, error);
    });
});


$('a.available-soon').click(function(e){
    e.preventDefault();

    $.growl.notice({ message: "Эта функция будет скоро доступна." });
});

function showError(xhr, code, text) {
    'use strict';
    if (xhr.responseJSON) {
        $.growl.error({message: 'Error(' + xhr.status + '): ' + xhr.responseJSON.error_text});
    } else {
        $.growl.error({message: 'Error(' + xhr.status + '): ' + text});
    }
}


$("img").on("error", function () {
    $(this).attr("src", "/img/no_image.jpg");
});



$('select[name="brand"]').change(function(){
    $('select[name="model"]').prop("disabled", true);
    $('select[name="capacity"]').prop("disabled", true);
    $('select[name="year"]').prop("disabled", true);
    $('select[name="fuel"]').prop("disabled", true);
    $('select[name="product"]').prop("disabled", true);

    if (!$(this).val()){
        return false;
    }
    var data = {
        brand: $(this).val()
    };
    $.get(
        '/site/product-search',
        data
        ,
        function (respond) {
            $('select[name="model"]').find('option').remove();
            $('select[name="model"]').append('<option value="">-- Model --</option>"');
            $.each(respond.items,function(key, value){
                $('select[name="model"]').append('<option value=' + key + '>' + value + '</option>');
            });
            $('select[name="model"]').prop("disabled", false);

        },
    ).fail(function (xhr, status, error) {
        showError(xhr, status, error);
    });
});



$('select[name="model"]').change(function(){
    // $('select[name="model"]').prop("disabled", true);
    $('select[name="capacity"]').prop("disabled", true);
    $('select[name="capacity"]').append('<option value="">-- Engine Capacity --</option>"');
    $('select[name="year"]').prop("disabled", true);
    $('select[name="year"]').append('<option value="">-- Year --</option>"');
    $('select[name="fuel"]').prop("disabled", true);
    $('select[name="fuel"]').append('<option value="">-- Fuel --</option>"');
    $('select[name="product"]').prop("disabled", true);
    $('select[name="product"]').append('<option value="">-- Product --</option>"');


    if (!$(this).val()){
        return false;
    }
    var data = {
        brand: $('select[name="brand"]').val(),
        model: $(this).val()
    };
    $.get(
        '/site/product-search',
        data
        ,
        function (respond) {
            $('select[name="capacity"]').find('option').remove();
            $('select[name="capacity"]').append('<option value="">-- Capacity --</option>"');
            $.each(respond.items,function(key, value){

                $('select[name="capacity"]').append('<option value=' + key + '>' + value + '</option>');
            });
            $('select[name="capacity"]').prop("disabled", false);

        },
    ).fail(function (xhr, status, error) {
        showError(xhr, status, error);
    });
});




$('select[name="capacity"]').change(function(){
    // $('select[name="model"]').prop("disabled", true);
    // $('select[name="capacity"]').prop("disabled", true);
    // $('select[name="capacity"]').append('<option value="">-- Engine Capacity --</option>"');
    $('select[name="year"]').prop("disabled", true);
    $('select[name="year"]').append('<option value="">-- Year --</option>"');
    $('select[name="fuel"]').prop("disabled", true);
    $('select[name="fuel"]').append('<option value="">-- Fuel --</option>"');
    $('select[name="product"]').prop("disabled", true);
    $('select[name="product"]').append('<option value="">-- Product --</option>"');


    if (!$(this).val()){
        return false;
    }
    var data = {
        brand: $('select[name="brand"]').val(),
        model:$('select[name="model"]').val(),
        capacity: $(this).val()
    };
    $.get(
        '/site/product-search',
        data
        ,
        function (respond) {
            $('select[name="year"]').find('option').remove();
            $('select[name="year"]').append('<option value="">-- Year --</option>"');
            $.each(respond.items,function(key, value){

                $('select[name="year"]').append('<option value=' + key + '>' + value + '</option>');
            });
            $('select[name="year"]').prop("disabled", false);

        },
    ).fail(function (xhr, status, error) {
        showError(xhr, status, error);
    });
});



$('select[name="year"]').change(function(){
    // $('select[name="model"]').prop("disabled", true);
    // $('select[name="capacity"]').prop("disabled", true);
    // $('select[name="capacity"]').append('<option value="">-- Engine Capacity --</option>"');
    // $('select[name="year"]').prop("disabled", true);
    // $('select[name="year"]').append('<option value="">-- Year --</option>"');

$('select[name="fuel"]').prop("disabled", true);
$('select[name="fuel"]').append('<option value="">-- Fuel --</option>"');
    $('select[name="product"]').prop("disabled", true);
    $('select[name="product"]').append('<option value="">-- Product --</option>"');


    if (!$(this).val()){
        return false;
    }
    var data = {
        brand: $('select[name="brand"]').val(),
        model:$('select[name="model"]').val(),
        year:$('select[name="year"]').val(),
        capacity:$('select[name="capacity"]').val()

    };
    $.get(
        '/site/product-search',
        data
        ,
        function (respond) {
            $('select[name="fuel"]').find('option').remove();
            $('select[name="fuel"]').append('<option value="">-- Fuel --</option>"');
            $.each(respond.items,function(key, value){

                $('select[name="fuel"]').append('<option value=' + key + '>' + value + '</option>');
            });
            $('select[name="fuel"]').prop("disabled", false);

        },
    ).fail(function (xhr, status, error) {
        showError(xhr, status, error);
    });
});


$('select[name="fuel"]').change(function(){
    // $('select[name="model"]').prop("disabled", true);
    // $('select[name="capacity"]').prop("disabled", true);
    // $('select[name="capacity"]').append('<option value="">-- Engine Capacity --</option>"');
    // $('select[name="year"]').prop("disabled", true);
    // $('select[name="year"]').append('<option value="">-- Year --</option>"');

    $('select[name="product"]').prop("disabled", true);
    $('select[name="product"]').append('<option value="">-- Product --</option>"');


    if (!$(this).val()){
        return false;
    }
    var data = {
        brand: $('select[name="brand"]').val(),
        model:$('select[name="model"]').val(),
        year:$('select[name="year"]').val(),
        fuel:$('select[name="fuel"]').val(),
        capacity:$('select[name="capacity"]').val()

    };
    $.get(
        '/site/product-search',
        data
        ,
        function (respond) {
            $('select[name="product"]').find('option').remove();
            $('select[name="product"]').append('<option value="">-- Product --</option>"');
            $.each(respond.items,function(key, value){

                $('select[name="product"]').append('<option value=' + key + '>' + value + '</option>');
            });
            $('select[name="product"]').prop("disabled", false);

        },
    ).fail(function (xhr, status, error) {
        showError(xhr, status, error);
    });
});


$('#showproduct').click(function(e){

    e.preventDefault();
    var val =  $('select[name="product"]').val();
    if (!val){
        return false;
    }
    window.location.replace("/store/view?id="+val);
});
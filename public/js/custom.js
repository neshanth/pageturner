// Cart AJAX

$(".cart-form").on("submit", function (e) {
    e.preventDefault();
    var token = $(this).find("input[name='_token']").val();
    var productId = $(this).find(".product-id").val();
    var customerId = $(this).find(".customer-id").val();
    var price = $(this).find(".price").val();
    var successElement = $(this).find(".cart-success");
    var failiureElement = $(this).find(".cart-fail");

    let data = {
        _token: token,
        product_id: productId,
        customer_id: customerId,
        quantity: 1,
        price: price,
    };

    $.ajax({
        url: "/cart",
        type: "post",
        data: data,
        success: function (response) {
            successElement.text(response);
            setTimeout(function () {
                successElement.hide();
            }, 3000);
            cartCount();
        },
        error: function (err) {
            if (err.status === 401) {
                failiureElement.text("Please Log In");
                setTimeout(function () {
                    failiureElement.hide();
                }, 3000);
            }
        },
    });
});

//cart count
function cartCount() {
    $.ajax({
        url: "/cart",
        type: "get",
        success: function (response) {
            var count = $(".cart-count").text(response);
        },
        error: function (err) {},
    });
}
cartCount();

//Increment and Decrement
$(".qty-btn").on("click", function (e) {
    e.preventDefault();
    var button = $(this).attr("data-qty");
    var input = "";
    if (e.target.getAttribute("data-qty") == "inc") {
        input = e.target.parentElement.previousElementSibling;
    } else {
        input = e.target.parentElement.nextElementSibling;
    }
    var token =
        e.target.parentNode.parentNode.parentNode.firstElementChild.value;
    var cartId = e.target.parentNode.parentNode.firstElementChild.value;
    var successElement = $(".cart-update-success");
    var data = {
        _token: token,
        cartId: cartId,
        qty: button,
    };
    if (button === "dec") {
        let count = parseInt(input.value) - 1;
        count = count < 1 ? 1 : count;
        input.value = count;
    } else {
        input.value = parseInt(input.value) + 1;
    }
    $.ajax({
        url: "/cart/update",
        type: "post",
        data: data,
        success: function (response) {
            cartTotals();
            successElement.text("Cart Has Been Updated");
            setTimeout(() => {
                successElement.text("");
            }, 3000);
        },
        error: function (err) {},
    });
});

//Delete Cart Item
$(".cart-delete").on("click", function (e) {
    e.preventDefault();
    var token = $(this).parent().find("input[name='_token']").val();
    var cartId = $(this).parent().find(".cart-delete").attr("data-id");
    var deleteButton = $(this);
    var cartItem = $(this).parent();
    var successElement = $(".cart-update-success");
    var data = {
        _token: token,
        cartId: cartId,
    };
    $.ajax({
        url: "/cart/delete",
        type: "delete",
        data: data,
        success: function (response) {
            deleteButton.prop("disabled", true);
            cartItem.addClass("disable-item");
            successElement.text("Please Click On Update Cart");
            setTimeout(() => {
                successElement.text("");
            }, 3000);
            // location.reload();
        },
        error: function (err) {},
    });
    cartTotals();
});

//Cart Totals
function cartTotals() {
    var total = $(".total-amount");
    var shippingMethod = $("#shipping").find(":selected").val();
    $.ajax({
        url: "/cart/totals",
        type: "get",
        success: function (response) {
            var finalTotal = response;
            if (shippingMethod === "express") {
                finalTotal += 10.0;
            }
            total.text("Rs. " + finalTotal);
        },
        error: function (err) {},
    });
}

$("#shipping").on("change", function () {
    cartTotals();
});

cartTotals();

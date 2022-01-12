$(".cart-form").on("submit", function (e) {
    e.preventDefault();
    var token = $(this).find("input[name='_token']").val();
    var productId = $(this).find(".product-id").val();
    var customerId = $(this).find(".customer-id").val();

    let data = {
        _token: token,
        product_id: productId,
        customer_id: customerId,
        quantity: 1,
    };

    $.ajax({
        url: "/cart",
        type: "post",
        data: data,
        success: function (response) {
            console.log(response);
            var successElement = e.target.lastChild;
            successElement.textContent = response;
            cartCount();
        },
        error: function (err) {
            if (err.status === 401) {
                window.location.href = "login";
            }
            console.log(err);
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
        error: function (err) {
            console.log(err);
        },
    });
}
cartCount();

//Increment and Decrement
$(".qty-btn").on("click", function (e) {
    e.preventDefault();
    var button = $(this).attr("data-qty");
    var input = $(this).parent().find(".quantity-input");
    var token = $(this).parent().find("input[name='_token']").val();
    var cartId = $(this).parent().find("input[name='cart-id']").val();
    var data = {
        _token: token,
        cartId: cartId,
        qty: button,
    };
    if (button === "dec") {
        var count = parseInt(input.text()) - 1;
        count = count < 1 ? 1 : count;
        input.text(count);
    } else {
        input.text(parseInt(input.text()) + 1);
    }
    $.ajax({
        url: "/cart/update",
        type: "post",
        data: data,
        success: function (response) {
            console.log(response);
        },
        error: function (err) {
            console.log(err);
        },
    });
});

//Delete Cart Item
$(".cart-delete").on("click", function (e) {
    e.preventDefault();
    var token = $(this).parent().find("input[name='_token']").val();
    var cartId = $(this).parent().find(".cart-delete").attr("data-id");
    console.log(cartId);
    var data = {
        _token: token,
        cartId: cartId,
    };
    $.ajax({
        url: "/cart/delete",
        type: "delete",
        data: data,
        success: function (response) {
            console.log(response);
        },
        error: function (err) {
            console.log(err);
        },
    });
});

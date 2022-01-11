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
$(".dec-btn").on("click", function (e) {
    e.preventDefault();
    var input = $(this).parent().find(".quantity-input");
    console.log(input.val());
    var count = parseInt(input.val()) - 1;
    count = count < 1 ? 1 : count;
    input.val(count);
    changeQty($(this));
});
$(".inc-btn").on("click", function (e) {
    e.preventDefault();
    var input = $(this).parent().find(".quantity-input");
    input.val(parseInt(input.val()) + 1);
});

function changeQty(selector) {
    var token = selector.find("input[name='_token']").val();
    console.log(selector);
    var cartId = selector.find("input[name='cart-id']").val();
    var data = {
        _token: token,
        cartId: cartId,
    };
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
}

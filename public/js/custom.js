//FLICKITY
var elem = document.querySelector(".main-carousel");
var flkty = new Flickity(elem, {
    // options
    cellAlign: "left",
    contain: true,
});

// Navigation Menu
let hamburgerButton = document.querySelector(".hamburger");
let mobileMenu = document.querySelector(".mobile-menu");
hamburgerButton.addEventListener("click", () => {
    mobileMenu.classList.toggle("hide-menu");
    mobileMenu.classList.toggle("show-menu");
});

// Search Bar
let searchIcon = document.querySelector(".search-icon");
let logo = document.querySelector(".logo");
let rightMenu = document.querySelector(".right-menu");
let searchContainer = document.querySelector(".search-container");
let closeBtn = document.querySelector(".close-btn");
searchIcon.addEventListener("click", () => {
    logo.classList.add("hide-items");
    rightMenu.classList.add("hide-items");
    searchContainer.classList.remove("hide-items");
});
closeBtn.addEventListener("click", () => {
    logo.classList.remove("hide-items");
    rightMenu.classList.remove("hide-items");
    searchContainer.classList.add("hide-items");
});

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
                // window.location.href = "login";
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
            cartTotals();
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
    var deleteButton = $(this);
    var cartItem = $(this).parent();
    var spinner = document.querySelector(
        `.spinner-border[data-id="${cartId}"]`
    );
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
            spinner.classList.add("show-loader");
            location.reload();
        },
        error: function (err) {
            console.log(err);
        },
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
        error: function (err) {
            console.log(err);
        },
    });
}

$("#shipping").on("change", function () {
    cartTotals();
});

cartTotals();

/* Search */
let products = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: path + '/search/preview?query=%QUERY'
    }
});

products.initialize();

$("#typeahead").typeahead({
    // hint: false,
    highlight: true
},{
    name: 'products',
    display: 'title',
    limit: 10,
    source: products
});

$('#typeahead').bind('typeahead:select', function(ev, suggestion) {
    // console.log(suggestion);
    window.location = path + '/search/?query=' + encodeURIComponent(suggestion.title);
});

$("#currencies-select").change(function () {
    let curr = $(this).val();
    window.location = "currency/change?curr=" + curr;
});
$('#mod-select').change(function () {
    let option = $(this).find('option').filter(':selected'),
        // modId = option.val(),
        price = option.data('price'),
        // color = option.data('color') ?? 'base',
        pricePlace = $('#product-price')[0],
        pricePlaceOld = $('#product-price_old')[0];
    if (pricePlaceOld) {
        let oldToNew = (+/\d+/.exec(pricePlaceOld.innerText)) / (+/\d+/.exec(pricePlace.innerText));
        pricePlaceOld.innerText = sLeft + Math.round(price * course * oldToNew) + sRight;
    }
    pricePlace.innerText = sLeft + Math.round(price * course) + sRight;
});
$(".add-to-cart-link").click(function (e) {
    e.preventDefault();
    let id = $(this).data('id'),
        qty = $('.quantity input').val() ?? 1,
        mod = $('#mod-select').val() ?? 0,
        data = {
            "id": id,
            "qty": qty,
            "mod": mod,
        };
    $.ajax({
        url: path + "/cart/add",
        data: data,
        method: "GET",
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert("Произошла ошибка, попробуйте позже.")
        }
    });
    return false;
});
$('.show-cart').click(function (e) {
    e.preventDefault();
    $.ajax({
        url: path + "/cart/show",
        method: "GET",
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert("Произошла ошибка, попробуйте позже.")
        }
    });
    return false;
});
$('body').on('click', ".del-item", function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    $.ajax({
        url: path + "/cart/delete",
        data: {
            "id": id,
        },
        method: "GET",
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert("Произошла ошибка, попробуйте позже.")
        }
    });
    return false;
});
$('body').on('click', ".clear-cart", function (e) {
    e.preventDefault();
    $.ajax({
        url: path + "/cart/clear",
        method: "GET",
        success: function (res) {
            showCart(res);
        },
        error: function () {
            alert("Произошла ошибка, попробуйте позже.")
        }
    });
    return false;
});

function showCart(code) {
    $('.modal-body').html(code);
    $('#cart').modal();
}

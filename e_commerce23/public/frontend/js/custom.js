$(document).ready(function () {
    $(".getPrice").change(function () {
        var size = $(this).val();
        var product_id = $(this).attr("product-id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/get-attribute-price',
            data: { size: size, product_id: product_id },
            type: 'POST', // Change to POST request
            success: function (resp) {
                // alert(resp);
                if ( resp['discount'] > 0) {
                    // Use backticks (`) for multi-line strings in JavaScript
                    $(".getAttributePrice").html(
                        '<span class="pd-detail__price"> ₹' + resp['final_price'] + '</span>' +
                        '<span class="pd-detail__discount">(' + resp['discount'] + ' % OFF)</span>' +
                        '<del class="pd-detail__del">₹' + resp['product_price'] + '</del>'
                    );
                } else {
                    $(".getAttributePrice").html("<span class='pd-detail__price'> ₹"+resp['final_price']+"</span>");
                }
                
            },
            error: function () {
                alert("error");
            }
        });
    });
});

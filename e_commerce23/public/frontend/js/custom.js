$(document).ready(function () {
    $(".getPrice").change(function () {
        var size = $(this).val();
        var product_id = $(this).attr("product-id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/get-attribute-price",
            data: { size: size, product_id: product_id },
            type: "POST", // Change to POST request
            success: function (resp) {
                // alert(resp);
                if (resp["discount"] > 0) {
                    // Use backticks (`) for multi-line strings in JavaScript
                    $(".getAttributePrice").html(
                        '<span class="pd-detail__price"> ₹' +
                            resp["final_price"] +
                            "</span>" +
                            '<span class="pd-detail__discount">(' +
                            resp["discount"] +
                            " % OFF)</span>" +
                            '<del class="pd-detail__del">₹' +
                            resp["product_price"] +
                            "</del>"
                    );
                } else {
                    $(".getAttributePrice").html(
                        "<span class='pd-detail__price'> ₹" +
                            resp["final_price"] +
                            "</span>"
                    );
                }
            },
            error: function () {
                alert("error");
            },
        });
    });
    $("#addToCart").submit(function () {
        // alert("test");
        var formData = $(this).serialize();
        // alert(formData)

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            url: "/add-to-cart",
            data: formData,
            type: "post", // Change to POST request
            success: function (resp) {
                // alert(resp['message'])
                if (resp["status"] == true) {
                    $(".print-successs-msg").show();
                    $(".print-successs-msg").delay(2000).fadeOut('slow');
                    $(".print-successs-msg").html(
                        "<div class='successs'>" +
                            "<span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>" +
                            resp['message'] +
                        "</div>"
                    );
                } else {
                    // alert(resp['message']);
                    $(".print-err-msg").show();
                    $(".print-err-msg").delay(2000).fadeOut('slow');
                    $(".print-err-msg").html(
                        "<div class='alert'>" +
                            "<span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span>" +
                            resp['message'] +
                        "</div>"
                    );
                    

                }
            },
            error: function () {
                alert("error");
            },
        });
    });

    // update cartitems quantity
    $(document).on('click', '.updatecartitems', function() {
        let new_qty; // Declare new_qty variable
        
        if ($(this).hasClass('fa-plus')) {
            // get quantity
            let quantity = $(this).data('qty');
            // increase the quantity by 1
            new_qty = parseInt(quantity) + 1;
        } else if ($(this).hasClass('fa-minus')) {
            // get quantity
            let quantity = $(this).data('qty');
            // check quantity is at least 1
            if (quantity <= 1) {
                alert("Item quantity should be at least 1!");
                return false;
            }
            // decrease the quantity by 1
            new_qty = parseInt(quantity) - 1;
        }
        
        var cartid = $(this).data('cartid');
        
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: { cartid: cartid, qty: new_qty },
            url: '/update-cart-item-qty',
            type: "POST",
            success: function(resp) {
                if(resp.status==false){
                    alert(resp.message);
                }
                
            },
            error: function() {
                alert("Error!");
            }
        });
    });
    // delete cart item
    $(document).on('click','.deleteCARTitem',function(){
        var cartid=$(this).data('cartid');
        // var result=confirm("Are you sure delete cart item ?");
        
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: { cartid: cartid },
            url: '/delete-cart-item',
            type: "POST", // Ensure that the request type is POST
            success: function(resp) {
                $('#appendcartitems').html(resp.view);
            },
            error: function() {
                alert("Error!");
            }
        });
        
    })
        
});

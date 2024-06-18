$(document).ready(function () {
    // When any element with the class 'updatecmspagestatus' is clicked (using event delegation)

    // check status for cms page
    $(document).on("click", ".updatestatus", function () {
        // Fetch 'status' and 'page_id' attributes from the clicked element
        var status = $(this).attr("status"); // Retrieve the status of the clicked element
        var page_id = $(this).attr("page_id"); // Retrieve the page ID of the clicked element
        var check = $(this).attr("check");
        console.log(status); // Output the status to the console for debugging
        console.log(page_id); // Output the page ID to the console for debugging

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Include CSRF token for security
            },
            type: "post", // HTTP method: POST
            url: "/admin/update-status-" + check, // URL to send the request
            data: { status: status, page_id: page_id }, // Data to be sent in the request
            success: function (response) {
                // Handle the response from the server after the status update
                if (response["status"] == 0) {
                    // If the status is 0, update the icon and status to 'Inactive'
                    $("#page-" + page_id + " i")
                        .removeClass("fa-toggle-on")
                        .addClass("fa-toggle-off")
                        .css("color", "gray");
                    $("#page-" + page_id).attr("status", "Inactive");
                } else if (response["status"] == 1) {
                    // If the status is 1, update the icon and status to 'Active'
                    $("#page-" + page_id + " i")
                        .removeClass("fa-toggle-off")
                        .addClass("fa-toggle-on")
                        .css("color", "");
                    $("#page-" + page_id).attr("status", "Active");
                } else {
                    // Handle other cases if needed
                }
            },
            error: function () {
                // If there's an error with the AJAX request, show an alert
                alert("Error");
            },
        });
    });

    // check delete for cms page

    // $(document).on("click", ".confirmdelete", function () {
    //     var record = $(this).attr("record");
    //     alert(record)
    //     var record_id = $(this).attr("record_id");
    //     alert(record_id)
    //     const swalWithBootstrapButtons = Swal.mixin({
    //         customClass: {
    //             confirmButton: "btn btn-success",
    //             cancelButton: "btn btn-danger",
    //         },
    //         buttonsStyling: false,
    //     });

    //     swalWithBootstrapButtons
    //         .fire({
    //             title: "Are you sure?",
    //             text: "You won't be able to revert this!",
    //             icon: "warning",
    //             showCancelButton: true,
    //             confirmButtonText: "Yes, delete it!",
    //             cancelButtonText: "No, cancel!",
    //             reverseButtons: true,
    //         })
    //         .then((result) => {
    //             if (result.isConfirmed) {
    //                 swalWithBootstrapButtons.fire(
    //                     "Deleted!",
    //                     "Your file has been deleted.",
    //                     "success"
    //                 );
    //                 window.location.href =
    //                     "/admin/delete-" + record + "/" + record_id;
    //             } else if (
    //                 /* Read more about handling dismissals below */
    //                 result.dismiss === Swal.DismissReason.cancel
    //             ) {
    //                 swalWithBootstrapButtons.fire(
    //                     "Cancelled",
    //                     "Your imaginary file is safe :)",
    //                     "error"
    //                 );
    //             }
    //         });
    // });

    // status check for subadmin
    $(document).on("click", ".updatestatussubadmin", function () {
        var status = $(this).attr("status");
        var subadmin_id = $(this).attr("page_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-status-subadmin-page",
            data: { status: status, subadmin_id: subadmin_id },
            success: function (response) {
                // Handle the response from the server after the status update
                if (response["status"] == 0) {
                    // If the status is 0, update the icon and status to 'Inactive'
                    $("#subadmin-" + subadmin_id + " i")
                        .removeClass("fa-toggle-on")
                        .addClass("fa-toggle-off")
                        .css("color", "gray");
                    $("#subadmin-" + subadmin_id).attr("status", "Inactive");
                } else if (response["status"] == 1) {
                    // If the status is 1, update the icon and status to 'Active'
                    $("#subadmin-" + subadmin_id + " i")
                        .removeClass("fa-toggle-off")
                        .addClass("fa-toggle-on")
                        .css("color", "");
                    $("#subadmin-" + subadmin_id).attr("status", "Active");
                } else {
                    // Handle other cases if needed
                }
            },
            error: function () {
                // If there's an error with the AJAX request, show an alert
                alert("Error");
            },
        });
    });

    // status check for category page

    $(document).on("click", ".updateCategorystatus", function () {
        var status = $(this).attr("status");
        var category_id = $(this).attr("page_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-status-category-page",
            data: { status: status, category_id: category_id },
            success: function (response) {
                // Handle the response from the server after the status update
                if (response["status"] == 0) {
                    // If the status is 0, update the icon and status to 'Inactive'
                    $("#category-" + category_id + " i")
                        .removeClass("fa-toggle-on")
                        .addClass("fa-toggle-off")
                        .css("color", "gray");
                    $("#category-" + category_id).attr("status", "Inactive");
                } else if (response["status"] == 1) {
                    // If the status is 1, update the icon and status to 'Active'
                    $("#category-" + category_id + " i")
                        .removeClass("fa-toggle-off")
                        .addClass("fa-toggle-on")
                        .css("color", "");
                    $("#category-" + category_id).attr("status", "Active");
                } else {
                    // Handle other cases if needed
                }
            },
            error: function () {
                // If there's an error with the AJAX request, show an alert
                alert("Error");
            },
        });
    });
    // product status
    $(document).on("click", ".updateproductstatus", function () {
        var status = $(this).attr("status");
        // alert(status)
        var product_id = $(this).attr("page_id");
        // alert(product_id)
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-status-product-page",
            data: { status: status, product_id: product_id },
            success: function (response) {
                // Handle the response from the server after the status update
                if (response["status"] == 0) {
                    // If the status is 0, update the icon and status to 'Inactive'
                    $("#product-" + product_id + " i")
                        .removeClass("fa-toggle-on")
                        .addClass("fa-toggle-off")
                        .css("color", "gray");
                    $("#product-" + product_id).attr("status", "Inactive");
                } else if (response["status"] == 1) {
                    // If the status is 1, update the icon and status to 'Active'
                    $("#product-" + product_id + " i")
                        .removeClass("fa-toggle-off")
                        .addClass("fa-toggle-on")
                        .css("color", "");
                    $("#product-" + product_id).attr("status", "Active");
                } else {
                    // Handle other cases if needed
                }
            },
            error: function () {
                // If there's an error with the AJAX request, show an alert
                alert("Error");
            },
        });
    });

    // update product attribute status
    $(document).on("click", ".updateattributestatus", function () {
        var status = $(this).attr("status");
        // alert(status)
        var attribute_id = $(this).attr("attribute_id");
        // alert(product_id)
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-status-attribute-page",
            data: { status: status, attribute_id: attribute_id },
            success: function (response) {
                // Handle the response from the server after the status update
                if (response["status"] == 0) {
                    // If the status is 0, update the icon and status to 'Inactive'
                    $("#attribute-" + attribute_id + " i")
                        .removeClass("fa-toggle-on")
                        .addClass("fa-toggle-off")
                        .css("color", "gray");
                    $("#attribute-" + attribute_id).attr("status", "Inactive");
                } else if (response["status"] == 1) {
                    // If the status is 1, update the icon and status to 'Active'
                    $("#attribute-" + attribute_id + " i")
                        .removeClass("fa-toggle-off")
                        .addClass("fa-toggle-on")
                        .css("color", "");
                    $("#attribute-" + attribute_id).attr("status", "Active");
                } else {
                    // Handle other cases if needed
                }
            },
            error: function () {
                // If there's an error with the AJAX request, show an alert
                alert("Error");
            },
        });
    });
    // update brand status
    $(document).on("click", ".updatebrandstatus", function () {
        var status = $(this).attr("status");
        // alert(status)
        var brand_id = $(this).attr("brand_id");
        // alert(product_id)
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-status-brand-page",
            data: { status: status, brand_id: brand_id },
            success: function (response) {
                // Handle the response from the server after the status update
                if (response["status"] == 0) {
                    // If the status is 0, update the icon and status to 'Inactive'
                    $("#brand-" + brand_id + " i")
                        .removeClass("fa-toggle-on")
                        .addClass("fa-toggle-off")
                        .css("color", "gray");
                    $("#brand-" + brand_id).attr("status", "Inactive");
                } else if (response["status"] == 1) {
                    // If the status is 1, update the icon and status to 'Active'
                    $("#brand-" + brand_id + " i")
                        .removeClass("fa-toggle-off")
                        .addClass("fa-toggle-on")
                        .css("color", "");
                    $("#brand-" + brand_id).attr("status", "Active");
                } else {
                    // Handle other cases if needed
                }
            },
            error: function () {
                // If there's an error with the AJAX request, show an alert
                alert("Error");
            },
        });
    });
    // update banner status
    $(document).on("click", ".updatebannerstatus", function () {
        var status = $(this).attr("status");
        // alert(status)
        var banner_id = $(this).attr("banner_id");
        // alert(product_id)
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-status-banner-page",
            data: { status: status, banner_id: banner_id },
            success: function (response) {
                // Handle the response from the server after the status update
                if (response["status"] == 0) {
                    // If the status is 0, update the icon and status to 'Inactive'
                    $("#banner-" + banner_id + " i")
                        .removeClass("fa-toggle-on")
                        .addClass("fa-toggle-off")
                        .css("color", "gray");
                    $("#banner-" + banner_id).attr("status", "Inactive");
                } else if (response["status"] == 1) {
                    // If the status is 1, update the icon and status to 'Active'
                    $("#banner-" + banner_id + " i")
                        .removeClass("fa-toggle-off")
                        .addClass("fa-toggle-on")
                        .css("color", "");
                    $("#banner-" + banner_id).attr("status", "Active");
                } else {
                    // Handle other cases if needed
                }
            },
            error: function () {
                // If there's an error with the AJAX request, show an alert
                alert("Error");
            },
        });
    });


    // update cupon status
    $(document).on("click", ".updatecuponstatus", function () {
        var status = $(this).attr("status");
        // alert(status)
        var cuppon_id = $(this).attr("cuppon_id");
        // alert(cuppon_id)
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-status-cupons-page",
            data: { status: status, cuppon_id: cuppon_id },
            success: function (response) {
                // Handle the response from the server after the status update
                if (response["status"] == 0) {
                    // If the status is 0, update the icon and status to 'Inactive'
                    $("#cupon-" + cuppon_id + " i")
                        .removeClass("fa-toggle-on")
                        .addClass("fa-toggle-off")
                        .css("color", "gray");
                    $("#cupon-" + cuppon_id).attr("status", "Inactive");
                } else if (response["status"] == 1) {
                    // If the status is 1, update the icon and status to 'Active'
                    $("#cupon-" + cuppon_id + " i")
                        .removeClass("fa-toggle-off")
                        .addClass("fa-toggle-on")
                        .css("color", "");
                    $("#cupon-" + cuppon_id).attr("status", "Active");
                } else {
                    // Handle other cases if needed
                }
            },
            error: function () {
                // If there's an error with the AJAX request, show an alert
                alert("Error");
            },
        });
    });

    // show /hide cupon
    $("#automaticCupon").click(function() {
        $("#cuponfield").hide();
    });

    $("#manualCupon").click(function() {
        $("#cuponfield").show();
    });
});
$(document).ready(function() {
    // check admin password is correct or not
    $("#CurrentPassword").keyup(function() {
        var CurrentPassword = $("#CurrentPassword").val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            type: 'post',
            url: '/admin/check-current-password',
            data: { CurrentPassword: CurrentPassword },
            success: function(response) {
                if (response === "false") { // Use strict equality '===' for comparison
                    $("#verifycurntpwd").html("Current password is incorrect");
                } else if (response === "true") { // Use strict equality '===' for comparison
                    $("#verifycurntpwd").html("Current password is correct");
                }
            },
            error: function() {
                alert('Error occurred');
            }
        });
    });
    
});


// cmspagestatus



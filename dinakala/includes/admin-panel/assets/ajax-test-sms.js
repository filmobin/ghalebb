jQuery(document).ready(function (a) {
    a(document).on("click", "#dina-test-sms-submit", function (o) {
        var testBtn = a(this);
        testBtn.find(".fal").removeClass("fa-envelope").addClass("fa-spinner-third fa-spin"), a(".dina-test-sms-sending-result").slideUp().text(''),
        a.ajax({
            type: "POST",
            dataType: "json",
            url: admin_ajax_test_sms_object.ajaxurl,
            data: {
                action: "dina_otp_test_action",
                phonenumber: a("#dina-test-sms-number").val(),
                userid: testBtn.data("user-id"),
                security: a('#dina_otp_test_nonce').val()
            },
            success: function (o) {
                testBtn.find(".fal").removeClass("fa-spinner-third fa-spin").addClass("fa-envelope"), a(".dina-test-sms-sending-result").slideDown().text(o.message)
            }
        })
    })
    a("#dina-test-sms-number").keydown (function (e) {
        if ( e.key == 'Enter') {
            e.preventDefault();
            a('#dina-test-sms-submit').click();
            return false;
        }
    });
});
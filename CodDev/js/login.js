var request;
var LOGIN_PATH = "?reg_log";
$("#form_login").submit(function (event) {
    if (request) {
        request.abort();
    }
    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serialize();

    $inputs.prop("disabled", true);

    request = $.ajax({
        url: LOGIN_PATH,
        type: "post",
        data: serializedData,
        success: function (response, textStatus, jqXHR) {
            if (response != 0) {
                $('#retorno').html(response);
            } else {
                location.replace("?page=ac.home");
            }
        }
    });

    request.done(function (response, textStatus, jqXHR) {
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
    });

    request.always(function () {
        $inputs.prop("disabled", false);
    });
    event.preventDefault();
});
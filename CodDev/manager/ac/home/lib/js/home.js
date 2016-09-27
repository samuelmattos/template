var request;
var Home = function() {

    var self = this;

    this.update = function() {
    }
    this.refresh = function() {
        self.update();
    }
}

var HOME_PATH = "?redir=modulos/ac/home/";
$("#form_fechamento").submit(function(event){
    if (request) {
        request.abort();
    }
    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serialize();

    $inputs.prop("disabled", true);
    
    request = $.ajax({
        url: HOME_PATH+"busca_fechamento.php",
        type: "post",
        data: serializedData,
        beforeSend: function() {
            $('#retorno').html("<img src='img/3.gif' />");
        },
        success: function(response, textStatus, jqXHR) {
            $('#retorno').html(response);            
        }
    });

    request.done(function (response, textStatus, jqXHR){
        });

    request.fail(function (jqXHR, textStatus, errorThrown){
        });

    request.always(function () {
        $inputs.prop("disabled", false);
    });
    event.preventDefault();
});

Home.rel_pdf = function(){
    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serialize();

    $inputs.prop("disabled", true);
    
    request = $.ajax({
        url: HOME_PATH+"rel_pdf.php",
        type: "post",
        data: serializedData,
        beforeSend: function() {
            html("<img src='img/3.gif' />");
        },
        success: function(response, textStatus, jqXHR) {
            html(response);            
        }
    });

    request.done(function (response, textStatus, jqXHR){
        });

    request.fail(function (jqXHR, textStatus, errorThrown){
        });

    request.always(function () {
        $inputs.prop("disabled", false);
    });
    event.preventDefault();
}
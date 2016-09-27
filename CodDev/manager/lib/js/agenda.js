/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var Agenda = function () {

    var self = this;

    this.update = function () {
    }
    this.refresh = function () {
        //self.update();
    }
}

jQuery(document).ready(function () {


    jQuery('#cad_evento').submit(function () {
        var dados = jQuery(this).serialize();

        jQuery.ajax({
            type: "POST",
            url: "lib/CadEvento.php",
            data: dados,
            success: function (data)
            {
                $('#myModal').modal('hide');
                $('#local').val('');
                $('#dt_ini').val('');
                $('#dt_fim').val('');
                $('#descricao').val('');
            }
        });
        return false;
    });

    geraJson = function () {
        var dados = jQuery(this).serialize();
        jQuery.ajax({
            type: "POST",
            url: "lib/geraJson.php",
            data: dados,
            success: function (data)
            {
                $('#myModal').modal('hide');
                $('#local').val('');
                $('#dt_ini').val('');
                $('#dt_fim').val('');
                $('#descricao').val('');
            }
        });
    };


});

Agenda.deletEvent = function (id_enveto) {
    // console.log('Evento: '+id_enveto);
//    var dados = id_enveto.serialize();
    // console.log('Evento: '+dados);
    jQuery.ajax({
        type: "POST",
        url: "lib/deletEvent.php",
        data: {id_evento: id_enveto},
        success: function ()
        {

        }
    });
    return true;
}

<?php
/* x
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class THome extends Template {

    public static function bar_nav() {
        ?>
        <div class="page-header">
            <h1>Cadastro de Eventos JUADSJO</h1>
        </div>
        <div id="resposta"></div>
        <div class="row">
            <div class="span11"><a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">Cadastrar Evento <i class="icon-plus icon-white"></i></a></div>
            <div class="span1"><a class="btn btn-warning" href="?logout">Sair <i class="icon-off icon-white"></i></a></div>
        </div>
        <?php
        THome::form_view_evento("Cadastrar Evento");
    }

    /**
     * Modal responsável por editar e incluir um evento no sistema
     * @param STR $title
     * @param Evento $evento
     */
    public static function form_view_evento($title) {
        Template::modal_head($title);
        ?>
        <form id="cad_evento" method="post" action="">
            <fieldset>
                <input required type="text" class="input-xxlarge" name="local" id="local" placeholder="Local/Congregação" title="Preencha o campo local">
                <label>Data Incial</label>
                <input required class="input-xxlarge" name="dt_ini" id="datepicker" title="Preencha o campo data inicial do envento">
                <label>Data Final</label>
                <input required class="input-xxlarge" name="dt_fim" id="datepicker" title="Preencha o campo data final do envento">
                <label>Descrição</label>
                <textarea required name="descricao" class="input-xxlarge" name="descricao" id="descricao" rows="3" title="Preencha o campo local do evento"></textarea>
            </fieldset>
            <button class="btn btn-primary" type="submit" >Salvar mudanças</button>
        </form>
        <?php
        echo Template::modal_footer();
    }

    /**
     * 
     * @param Array[Evento] $eventos
     */
    public static function list_evento($eventos) {
        ?>
        <table class="table table-striped table-hove">
            <caption>Lista de eventos</caption>
            <thead>
                <tr>
                    <th>
                        Descrição
                    </th>
                    <th>
                        Local
                    </th>
                    <th>
                        Data inicial
                    </th>
                    <th>
                        Data Final
                    </th>
                    <th>
                        Ação
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($eventos as $evento) {
                    /* @var $evento Evento */
                    ?>
                    <tr>
                        <td>
                            <?php echo $evento->get_descricao(); ?>
                        </td>
                        <td>
                            <?php echo $evento->get_local(); ?>
                        </td>
                        <td>
                            <?php echo $evento->get_dt_ini(); ?>
                        </td>
                        <td>
                            <?php echo $evento->get_dt_fim(); ?>
                        </td>
                        <td>
                            <a href="#" onclick="Agenda.deletEvent(<?php echo $evento->get_id_evento(); ?>);" class="btn btn-danger" ><i class="icon-trash icon-white"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
    }

}

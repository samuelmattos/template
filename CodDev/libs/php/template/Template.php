<?php
/* 6E8DD7
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Template {

    static function display_header($title, $css = null) {
        ?>
        <html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="pt-br">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta http-equiv="Content-Language" content="pt-br"/>
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon"/>
                <link rel="icon" href="/images/favicon.ico" type="image/x-icon"/>
                <title><?php echo $title; ?></title>
                <!-- Bootstrap -->
                <link href="<?php echo PATH; ?>/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen"/>
                <link href="<?php echo PATH; ?>/bootstrap/css/bootstrap-responsive.css" rel="stylesheet"/>
                <?php echo $css; ?>
            </head>
            <body>
                <section class="container">
                    <?php
                }

                static function display_footer($load = null) {
                    ?>
                </section>
                <footer id="footer">
                    <div class="container">
                        <p class="muted credit">© <?php echo date("Y"); ?> DevCog Solutions. <br><a target="_blank" href="http://www.devcog.com.br/">DevCog</a></p>
                    </div>
                </footer>
            </body>

            <script src="<?php echo PATH; ?>/js/jquery.min.js"></script>
            <script src="<?php echo PATH; ?>/bootstrap/js/bootstrap.min.js"></script>
            <?php echo $load; ?>
        </html>
        <?php
    }

    static function modal_head($title) {
        ?>
        <!-- Modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel"><?php echo $title; ?></h3>
            </div>
            <div class="modal-body">
                <?php
            }

            static function modal_footer() {
                ?>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>               
            </div>
        </div>
        <?php
    }

    static function display_exception(Exception $e, $title = 'Erro', $onClickOk = '', $blackout = 0) {
        $debug = false; //TODO isso deve ser configuravel
        $message = $e->getMessage();
        if ($debug) {
            $message .= '<pre>' . $e->getTraceAsString() . '</pre';
        }
        Template::display_error($message, $title, $blackout, $onClickOk);
    }

    /**
     *  tem que alterar para os padrões do bootstrap
     * @param Exception $message
     * @param type $title
     * @param type $blackout
     * @param type $onClickOk
     */
    static function display_error($message, $title = 'Erro', $blackout = 0, $onClickOk = '') {
        Template::modal_head($title);
        echo $message->getMessage();
        Template::modal_footer();
    }

}
?>
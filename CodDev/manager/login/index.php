<?php
$user = Session::getInstance()->get(AC::K_CURRENT_USER);

if ($user != null) {   
    AC::_include("index.php?page=ac.home");
    exit();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login</title>
        <!-- Bootstrap -->
        <link href="<?php echo PATH; ?>/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen"/>

        <link href="<?php echo PATH; ?>/css/login.css" rel="stylesheet" media="screen">
        <link href="<?php echo PATH; ?>/bootstrap/css/bootstrap-responsive.css" rel="stylesheet"/>

    </head>
    <body>
        <div class="container">
            <form class="form-signin" method='post' id="form_login">
                <img src="<?php echo PATH; ?>images/devcog.png" alt="">
                <h2 class="form-signin-heading">Login</h2>
                <input type="text" required="true" id="usuario" name="usuario" placeholder="Usuário" class="input-block-level">
                <input type="password" required="true" id="senha" name="senha" placeholder="Senha" class="input-block-level">
                <button type="submit" class="btn btn-large btn-primary">Entrar</button>
                <p id="retorno" class="text-error"></p>
            </form>
            <center><p>Desenvolvido por <?php echo AC::NOME_APP; ?></p></center>
        </div>
        <script src="<?php echo PATH; ?>/js/jquery.min.js"></script>
        <script src="<?php echo PATH; ?>/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo PATH; ?>/js/login.js"></script>
        <script>
            $(document).ready();
        </script>
    </body>
</html>

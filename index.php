<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ConCredito</title>
    <link rel="icon" type="img/png" href="img/ico.ico" />

    <link href="diseno/css/bootstrap.min.css" rel="stylesheet">
    <link href="diseno/css/grayscale.css" rel="stylesheet">
    <link href="diseno/css/default.css" rel="stylesheet">
    <link href="diseno/css/sweetalert.css" rel="stylesheet">
    <link href="diseno/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Oswald|Ranga|Roboto|Kaushan+Script" rel="stylesheet">

    <script src="diseno/js/jquery.js"></script>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div class="container" style="margin-top: 100px;">
        <div class="col-md-4 col-md-offset-4" style="background: white;">
            <img src="diseno/img/logo.png" class="img-responsive mbot" width="350">
            <div id="result" class="alert">
                <div class="alert alert-danger" style="display:none;" id="error">
                    <p>Usuario no identificados</p>
                </div>
                <div class="form-group">
                    <label for="user"><b>Usuario:</b></label>
                    <input type="user" class="form-control" id="usuario" placeholder="Usuario" autofocus="autofocus">
                </div>                    
                <button type="button" class="btn btn-primary btn-lg btn-block" id="btn_login"><i class="fa" aria-hidden="true" id="fa_login"></i> Entrar</button>   
                <br>                   
            </div>
        </div>
    </div>


    <script type="text/javascript" src="diseno/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="diseno/js/jquery.min.js"></script>
    <script type="text/javascript" src="diseno/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="diseno/js/concredito.js"></script>
</body>
</html>
<!doctype html>
<html lang="en">
<?php
$host = $_SERVER["HTTP_HOST"];
$urlactual = "http://" . $host . "/evaluacionhap/";
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://172.16.1.100:82/evaluacionhap/assets/img/hap.ico">

    <title>Cover Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="http://172.16.1.100:82/evaluacionhap/assets/css/cover.css" rel="stylesheet">
</head>

<body class="text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">

        </header>

        <main role="main" class="inner cover">
            <img src="http://172.16.1.100:82/evaluacionhap/assets/img/signo-de-exclamacion.png" alt="">
            <h1 class="cover-heading">ACCESO SUSPENDIDO PARA COLABORADORES.</h1>

            <p class="lead">
                <a href="<?= $urlactual ?>" class="btn btn-lg btn-secondary">Regresar</a>
            </p>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <strong>Copyright &copy; 2022 <a href="#"> Sistemas HAP</a>.</strong> Todos los Derechos Reservados
            </div>
        </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

</body>

</html>
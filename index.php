<?php
    session_start(); session_destroy();
    setlocale(LC_ALL, 'pt-BR', 'pt-BR.utf-8', 'pt-BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $host = "localhost";
    $db = "";
    $user = "";
    $pass = "";
    try {
        $pdo = new PDO("mysql:host=$host; dbname=$db; charset=utf8", $user, $pass);
    }
    catch (Exception $e) {
        echo "Erro ao estabelecer conexão com o banco de dados:".$e->getMessage();
        die;
    }

    $versiculo = rand(1, 211082);
    $sql_versiculo = "SELECT * FROM versiculos WHERE ver_id = {$versiculo}";
    $dados_versiculo = $pdo->query($sql_versiculo);
    $result_versiculo = $dados_versiculo->fetch(PDO::FETCH_OBJ);
        $ver_liv_id = $result_versiculo->ver_liv_id;
        $ver_capitulo = $result_versiculo->ver_capitulo;
        $ver_versiculo = $result_versiculo->ver_versiculo;

    $sql = "SELECT * FROM versiculos, versoes, livros, testamentos "
        . "WHERE ver_liv_id = {$ver_liv_id} AND ver_capitulo = {$ver_capitulo} AND ver_versiculo = {$ver_versiculo} "
        . "AND ver_vrs_id = vrs_id "
        . "AND ver_liv_id = liv_id "
        . "AND liv_tes_id = tes_id "
        . "ORDER BY ver_liv_id, ver_vrs_id, ver_capitulo, ver_versiculo ";
    $dados = $pdo->query($sql);
    $pdo = null;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="refresh" content="25">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="imagetoolbar" content="no">
        <meta name="description" content="Bíblia OnLine">
        <meta name="author" content="BÍBLIA">
        <meta name="generator" content="">
        <meta name="robots" content="all">
        <meta name="googlebot" content="NoIndex">
        <meta name="DC.title" content="|BÌBLIA">
        <meta name="DC.creator" content="Soares, Rinaldo LM">
        <meta name="DC.creator.address" content="rsoares@rsoares.com">
        <meta name="DC.Identifier" content="">
        <title>|BÍBLIA</title>
    <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <!-- Favicons -->
        <link rel="icon" href="./biblia.png">
        <meta name="theme-color" content="#3c3f90">
    <!-- Custom styles for this template -->
         <link href="./css.css" rel="stylesheet">
    </head>
    <body>
        <form class="form-signin" action="#" method="post" target="_self">
            <div class="text-center mb-4">
                <h4 class="h4 mb-3 font-weight-normal">A Bíblia</h4>
            </div>
<?php
    while ($result = $dados->fetch(PDO::FETCH_OBJ)) {
        $liv_nome = $result->liv_nome;
        $ver_capitulo = $result->ver_capitulo;
        $ver_versiculo = $result->ver_versiculo;
        echo "<p class='mt-1 mb-1 text-muted text-center' style='font-size:12px;'>\"{$result->ver_texto}\"</p>";
        echo "<p class='mt-1 mb-1 text-muted text-right' style='font-size:12px; font-style: italic;'>{$result->vrs_nome}</p>";
        echo "<hr>";
    }
    echo "<h4 class='h4 mb-3 font-weight-normal text-center'>{$liv_nome} {$ver_capitulo}:{$ver_versiculo}</h4>";
    unset($pdo); 
    unset($dados);
?>
            <p class="mt-5 mb-3 text-muted text-center">&copy; 2020 - 2021</p>
        </form>

    </body>
    <!-- JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

    <!-- Etiqueta global do site (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-22809481-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-22809481-2');
    </script>
</html>

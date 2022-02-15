<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./style.css" />

    <title>Consulta de Brokers</title>
      
    </head>
  <body>

      <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <p>Brokers</p>
        </div>
      </nav>  

    <div class="containerform"> 
      
    <div class="box">

      <?php 
        error_reporting(0);
        $nome = "%".trim($_POST['brokers'])."%";
        if(!empty($_POST['brokers'])){
        $dbh = new PDO('mysql:host=;dbname=', '', '');

        $sth = $dbh->prepare('SELECT * FROM `brokers` WHERE `LA` LIKE :nome LIMIT 10');
        $sth->bindParam(':nome', $nome, PDO::PARAM_STR);
        $sth->execute();

        $resultados = $sth->fetchAll(PDO::FETCH_ASSOC);
        }else{
            echo 'erro de conexão ao BD';
        }
      ?>
        <form action="" method="POST">

          <input class="input is-primary" type="text" name="brokers" placeholder="Inserir conteudo aqui">
          <button class="button is-fullwidth">Buscar</button>    

          <div class="notification">

              <?php
                  error_reporting(0);
                  if (count($resultados)) {
                  foreach ($resultados as $key => $value) {
                ?> 

            <table>
              <thead class="">
                <tr class="">
                  <th title="la">LA</th>
                  <th title="broker">Broker</th>
                  <th title="app">Aplicativo/Token/Banco</th>
                <tr>
              </thead>

              <tbody>
                <tr id="">
                  <td><?php echo''.$value['LA']; ?></td>
                  <td><?php echo''.$value['broker']; ?></td>
                  <td><?php echo''.$value['token']; ?></td>
                </tr>
              </tbody>
            </table>

              <?php
                }}
              ?>
          </div>
        </form>
      </div>
    </div>

  </body>
</html>
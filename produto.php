<?php

require "./vendor/autoload.php";

use EscapeWork\Frete\Correios\PrecoPrazo;
use EscapeWork\Frete\Correios\Data;
use EscapeWork\Frete\FreteException;

if (isset($_POST['cep'])) {
  $cepDestino = $_POST['cep'];

  $frete = new PrecoPrazo();
  try {
    $frete->setCodigoServico(Data::PAC)
      ->setCepOrigem('05593970')   # apenas numeros, sem hifen(-)
      ->setCepDestino($cepDestino) # apenas numeros, sem hifen(-)
      ->setComprimento(30)              # obrigatorio
      ->setAltura(30)                   # obrigatorio
      ->setLargura(30)                  # obrigatorio
      ->setDiametro(30)                 # obrigatorio
      ->setPeso(0.5);                   # obrigatorio


    $resultPAC = clone $frete->calculate();

    $frete->setCodigoServico(Data::SEDEX);

    $resultSEDEX = clone $frete->calculate();
  } catch (FreteException $e) {
    // trate o erro adequadamente (e não escrevendo na tela)
    echo $e->getMessage();
    echo $e->getCode(); // este código é o código de erro dos correios
    // pode ser usado pra dar mensagens como CEP inválido para o cliente
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./public/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet" />
  <title>Produto teste</title>
</head>

<body>
  <header>
    <div class="menu_produto">
      <div class="logo">
        <h1>IceStore</h1>
      </div>
      <!--logo-->

      <div class="cabeçalho-link">
        <li>
          <a href="/">Inicio</a>
        </li>
        <li>
          <a href="/login">Faça login</a>
        </li>
        <li>
          <a href="/register">Crie sua conta</a>
        </li>
        <li>
          <a href="/logged">Minha área</a>
        </li>
      </div>
      <!--cabeçalho-link-->
      <div class="icon">
        <span>
          <ion-icon name="bag-outline"></ion-icon>
        </span>
      </div>
    </div>
  </header>
  <main class="content">
    <div class="left-side">
      <h1>Camisa Nike Brasil I 2022/23 Jogador Masculina</h1>
      <P>A Coleção da Seleção Brasileira de 2022 combina a icônica estampa da onça-pintada com design inovador que mantém seu corpo seco mesmo no auge da empolgação. Uma homenagem ao Brasil e ao seu povo, esta coleção foi feita para mostrar a sua garra.</P>
      <h2>R$699,99</h2>
      <h4>ou 12x de R$ 58,33</h4>
      <br>
      <h3 href="#">ADICIONAR AO CARRINHO</h3>
      <form method="POST">
        <br>
        <input type="text" name="cep" id="cep" placeholder="Digite seu cep" />
        <button type="submit" class="btn btn-primary">Calcule o frete</button>
        <a target="_blank" href="https://buscacepinter.correios.com.br/app/endereco/index.php">Não sabe seu cep? Clique aqui</a> <br>
        <?php if (isset($_POST['cep'])) : ?>
          <div class="row">
            <h5>PAC: R$<?php echo $resultPAC['cServico']['Valor'] ?>(Prazo: <?php echo $resultPAC['cServico']['PrazoEntrega'] ?>dias)</h5> <br>
            <h5>SEDEX: R$<?php echo $resultSEDEX['cServico']['Valor'] ?>(Prazo: <?php echo $resultSEDEX['cServico']['PrazoEntrega'] ?>dias)</h5>
          </div>
        <?php endif; ?>
      </form>
    </div>

    <div class="right-side">
      <img src="./js/img/COPA1.png" alt="">
    </div>
  </main>

  <script src="https://unpkg.com/scrollreveal"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
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
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Icestore</title>
  </head>
  <body>
    <header>
      <div class="menu">
          <div class="logo">
              <h1>IceStore</h1>
          </div><!--logo-->
                  <div class="cabeçalho-link">
                       <nav class="navbar">
                          <a  href="/" class="navbar-brand">Início</a>
                          <a  href="/login" class="navbar-brand">Faça login</a>
                          <a  href="/register" class="navbar-brand">Crie sua conta</a>
                          <a  href="/logged" class="navbar-brand">Minha área</a>
                          <form class="form-inline">
                            <input class="form-control mr-sm-3" type="search" placeholder="Pesquise aqui..." aria-label="Pesquisar">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
                          </form>
                        </nav>
                  </div>
                  <div class="cart">
                
                    <button type="button" id="cart-btn">
                        <ion-icon name="bag-outline"></ion-icon>
                        <span id="cart-count-info">0</span>
                         </button> 
                 
                
            </div><!--cart-->
              </div>
  </header>
    <main class="content">
      <div class="left-side">
        <h1>Camisa Nike Brasil 1 2022/23 Jogador Masculina</h1>
        <P
          >A Coleção da Seleção Brasileira de 2022 combina a icônica estampa da
          onça-pintada com design inovador que mantém seu corpo seco mesmo no
          auge da empolgação. Uma homenagem ao Brasil e ao seu povo, esta
          coleção foi feita para mostrar a sua garra.</P
        >
        <br />
        <h2>R$699,99</h2>
        <h4>ou 12x de R$ 58,33</h4>
<br>
<h5>Escolha o tamanho</h5>
<div class="select">
   <select name="format" id="format">
      <option selected disabled>Escolha o tamanho</option>
      <option value="PP">PP</option>
      <option value="P">P</option>
      <option value="M">M</option>
      <option value="G">G</option>
      <option value="GG">GG</option>
   </select>
</div>
<br>
<h5>Escolha a quantidade</h5>
<div>
<select name="format" id="format">

  <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
 </select>
</div>

<div class="buy">
  <a href="" class="btn2" id="">Adicionar ao carrinho</a>
  <a href="" class="btn3" id="buy-now">Comprar agora</a>
</div>

<h5>Calcule o frete</h5>
<form method="POST">
        <input type="text" name="cep" id="cep" placeholder="Digite seu cep" />
        <button type="submit" class="btn btn-primary">Calcule o frete</button> <br>
        <a target="_blank" href="https://buscacepinter.correios.com.br/app/endereco/index.php">Não sabe seu cep? Clique aqui</a>
        <?php if (isset($_POST['cep'])) : ?>
          <div class="row">
            <h5>PAC: R$<?php echo $resultPAC['cServico']['Valor'] ?>(Prazo: <?php echo $resultPAC['cServico']['PrazoEntrega'] ?>dias)</h5>
          </div>
          <div class="row">
          <h5>SEDEX: R$<?php echo $resultSEDEX['cServico']['Valor'] ?>(Prazo: <?php echo $resultSEDEX['cServico']['PrazoEntrega'] ?>dias)</h5>
          </div>
        <?php endif; ?>
      </form>

      </div>
      <div class="right-side">
        <img src="./public/js/img/CAMISA_COPA1.png" alt="Camisa da copa do mundo Nike" />
      </div>
    </main>

    <div class="top-footer"> </div>

    <footer class="Contato" id="Contato">
		<div class="meio-contato">
			<h3>IceStore</h3>
    <li>CPNJ: 48.265.682/0001-90</li>

		</div>

		<div class="meio-contato">
			<h3>Atendimento</h3>
			<li><a href="">FAQ</a></li>
			<li><a href="">Fale conosco</a></li>
			<li><a href="">Politíca de devolução</a></li>

		</div>

		<div class="meio-contato">
			<h3>Redes Sociais</h3>
            <li><a href="">Instagram</a></li>
            <li><a href="">Facebook</a></li>
            <li><a href="">Youtube</a></li>
		</div>

		<div class="meio-contato">
			<h3>Shopping</h3>
			<li><a href="#">Clothing Store</a></li>
			<li><a href="#">Trending Shoes</a></li>
			<li><a href="#">Accessories</a></li>
			<li><a href="#">Sale</a></li>
		</div>
    </footer>

    <div class="bottom-footer">
        <p>
            © 2022 Icestore. Todos Os Direitos Reservados.
        </p>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
    <script src="/controllers/shoppingCart.js"></script>
  </body>
</html>

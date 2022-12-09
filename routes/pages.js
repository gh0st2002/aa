const express = require("express");
const loggedIn = require("../controllers/loggedIn");
const logout = require("../controllers/logout");
const logout2 = require("../controllers/logout2");
const { calcularPrecoPrazo } = require("correios-brasil");

const router = express.Router();

router.get("/logged", loggedIn, (req, res) => {
  if (req.user) {
    res.render("logged", { status: "loggedIn", user: req.user });
  } else {
    res.render("logged", { status: "no", user: "nothing" });
  }
});

router.get("/CAMISA_BRASIL1", loggedIn, (req, res) => {
  if (req.user) {
    res.render("CAMISA_BRASIL1", { status: "loggedIn", user: req.user });
  } else {
    res.render("CAMISA_BRASIL1", { status: "no", user: "nothing" });
  }
});

router.get("/CAMISA_BRASIL2", loggedIn, (req, res) => {
  if (req.user) {
    res.render("CAMISA_BRASIL2", { status: "loggedIn", user: req.user });
  } else {
    res.render("CAMISA_BRASIL2", { status: "no", user: "nothing" });
  }
});

router.get("/NIKE_DUNKLOW2", loggedIn, (req, res) => {
  if (req.user) {
    res.render("TENIS_2", { status: "loggedIn", user: req.user });
  } else {
    res.render("TENIS_2", { status: "no", user: "nothing" });
  }
});

router.get("/NIKE_DUNKLOW1", loggedIn, (req, res) => {
  if (req.user) {
    res.render("TENIS_1", { status: "loggedIn", user: req.user });
  } else {
    res.render("TENIS_1", { status: "no", user: "nothing" });
  }
});

router.get("/NIKE_DUNKLOW3", loggedIn, (req, res) => {
  if (req.user) {
    res.render("TENIS_3", { status: "loggedIn", user: req.user });
  } else {
    res.render("TENIS_3", { status: "no", user: "nothing" });
  }
});

router.get("/login", loggedIn, (req, res) => {
  if (req.user) {
    res.render("login2", { status: "loggedIn", user: req.user });
  } else {
    res.render("login2", { frete: "", status: "no", user: "nothing" });
  }
});

router.get("/checkout", loggedIn, (req, res) => {
  if (req.user) {
    res.render("cart", { status: "loggedIn", user: req.user });
  } else {
    res.render("cart", { frete: "", status: "no", user: "nothing" });
  }
});

router.get("/", loggedIn, (req, res) => {
  if (req.user) {
    res.render("market", { status: "loggedIn", user: req.user });
  } else {
    res.render("market", { status: "no", user: "nothing" });
  }
});

router.get("/register", (req, res) => {
  res.sendFile("register.html", { root: "./public/js" });
});

router.get("/logout", logout);
router.get("/logout2", logout2);

// //rota nova
// router.get("/CAMISA_BRASIL1", (req, res) => {
//   res.render(".ejs", { frete: "" });
// });

// códigos no readme
// calculo do frete JS - nCdServico: 04014 = SEDEX à vista / 04510 = PAC à vista
router.post("/CAMISA_BRASIL1", async (req, res) => {
  const inputCep = req.body.cep;
  const data = {
    sCepOrigem: "81200100",
    sCepDestino: inputCep, // variavel recebida
    nVlPeso: "1",
    nCdFormato: "1",
    nVlComprimento: "20",
    nVlAltura: "20",
    nVlLargura: "20",
    nCdServico: ["04510"],
    nVlDiametro: "0",
  };

  const objeto = await calcularPrecoPrazo(data);
  res.render("CAMISA_BRASIL1.ejs", { frete: objeto[0].Valor || "" });

});

module.exports = router;

const express = require("express");
const loggedIn = require("../controllers/loggedIn");
const logout = require("../controllers/logout");




const router =  express.Router();

router.get("/logged", loggedIn, (req, res) => {
    if(req.user){
        res.render("index", { status: "loggedIn", user:req.user })
    }else{
        res.render("index", { status: "no", user: "nothing" })
    }
})

router.get("/register", (req, res) => {
    res.sendFile("register.html", { root:"./public/js" })
})

router.get("/login", (req, res) => {
    res.sendFile("login.html", { root: "./public/js" })
})

router.get("/logout", logout)

router.get ("/", (req,res)=>{
    res.sendFile("market.html", {root:"./public/js"})
})

router.get ("/produto_camisanike1", (req,res)=>{
    res.sendFile("produto1.html", {root:"./public/js"})
})

//rota nova
router.get("/teste", (req, res) => {
    res.render('teste.ejs')
})

router.post("/teste", async (req, res) => {
    const inputCep = req.body.cep
    const data = {
        sCepOrigem: '81200100',
        sCepDestino: inputCep,
        nVlPeso: '1',
        nCdFormato: '1',
        nVlComprimento: '20',
        nVlAltura: '20',
        nVlLargura: '20',
        nCdServico: ['04014', '04510'], 
        nVlDiametro: '0',
      }

      const valor = await calcularPrecoPrazo(data)
      res.render('teste.ejs', { title: 'Título' })
})

const { calcularPrecoPrazo } = require('correios-brasil');

module.exports = router
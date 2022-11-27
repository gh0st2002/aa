const express = require("express")
const login = require("./login")
const register = require("./register")


const router = express.Router()

router.post("/register", register)
router.post("/login", login)

module.exports = router
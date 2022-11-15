const express = require("express");
const router = express.Router();
const register = require("./register");
const logout = require("./logout");
const login = require("./login"); 

router.post("/register", register);
router.post("/login", login);
    // router.post("/logout", logout);

module.exports = router;
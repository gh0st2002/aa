const logout2 = (req, res) =>{
    res.clearCookie("userRegistered");
    res.redirect("/")
    }
    module.exports = logout2;
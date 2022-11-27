const logout = (req, res) =>{
res.clearCookie("userRegistered");
res.redirect("/logged")
}
module.exports = logout;
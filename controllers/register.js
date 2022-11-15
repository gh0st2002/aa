const db = require("../routes/db-config");
const bcrypt = require("bcryptjs");

const register = async (req, res) => {
    const { email, password: Npassword} = req.body
    if(!email || !Npassword) return res.json({ status: "error", error: "Por favor, digite seu e-mail e senha" });
    else{

        db.query('SELECT email FROM users WHERE email = ?', [email], async (err, result) => {
            
                if(err) throw err;
                if (result[0]) return res.json({ status:  "error", error: "E-mail já foi cadastrado"})
                else{
                    const password = await bcrypt.hash(Npassword, 8);
   
                    
                    db.query('INSERT INTO users SET ?', {email: email, password: password}, (error, results) => {
                                if(error) throw error;
                                return res.json({ status: "success", success: "Usuário cadastrado com sucesso"  })
                    })
                }
        })
    }
}
module.exports = register;

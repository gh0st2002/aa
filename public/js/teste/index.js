document.getElementById('submit-btn').addEventListener('click', () => {
    const inputCep = document.getElementById('cep-user')
    const data = {
        sCepOrigem: '81200100',
        sCepDestino: inputCep.value,
        nVlPeso: '1',
        nCdFormato: '1',
        nVlComprimento: '20',
        nVlAltura: '20',
        nVlLargura: '20',
        nCdServico: ['04014', '04510'], 
        nVlDiametro: '0',
      }


      fetch("http://localhost:5000/retrieve_preco_frete", {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json"
        }
      }).then(res => console.log(res))
      
      
      


})

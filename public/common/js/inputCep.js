function getCep() {

    $_cep = $('#inputCep_cep').val();
    //Nova variável "cep" somente com dígitos.
    var cep = $_cep.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $('#inputCep_rua').length > 0 ? document.getElementById('inputCep_rua').value = "..." : '';
            $('#inputCep_bairro').length > 0 ? document.getElementById('inputCep_bairro').value = "..." : '';
            $('#inputCep_cidade').length > 0 ? document.getElementById('inputCep_cidade').value = "..." : '';
            $('#inputCep_uf').length > 0 ? document.getElementById('inputCep_uf').value = "..." : "";
            $('#inputCep_ibge').length > 0 ? document.getElementById('inputCep_ibge').value = "..." : '';
            $('#inputCep_complemento').length > 0 ? document.getElementById('inputCep_complemento').value = "..." : '';
            //$('#inputCep_localidade').length > 0 ? document.getElementById('inputCep_localidade').value = "..." : '';
            //
            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            clear_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        clear_cep();
    }
};

function clear_cep() {
    //Limpa valores do formulário de cep.
    $('#inputCep_rua').length > 0 ? document.getElementById('inputCep_rua').value = "" : '';
    $('#inputCep_bairro').length > 0 ? document.getElementById('inputCep_bairro').value = "" : '';
    $('#inputCep_cidade').length > 0 ? document.getElementById('inputCep_cidade').value = "" : '';
    $('#inputCep_uf').length > 0 ? document.getElementById('inputCep_uf').value = "" : "";
    $('#inputCep_ibge').length > 0 ? document.getElementById('inputCep_ibge').value = "" : '';
    $('#inputCep_complemento').length > 0 ? document.getElementById('inputCep_complemento').value = "" : '';
    //$('#inputCep_localidade').length > 0 ? document.getElementById('inputCep_localidade').value = "" : '';
}

function callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        $('#inputCep_rua').length > 0 ? document.getElementById('inputCep_rua').value = (conteudo.logradouro) : '';
        $('#inputCep_bairro').length > 0 ? document.getElementById('inputCep_bairro').value = (conteudo.bairro) : '';
        $('#inputCep_cidade').length > 0 ? document.getElementById('inputCep_cidade').value = (conteudo.localidade) : '';
        $('#inputCep_uf').length > 0 ? document.getElementById('inputCep_uf').value = (conteudo.uf) : '';
        $('#inputCep_ibge').length > 0 ? document.getElementById('inputCep_ibge').value = (conteudo.ibge) : '';
        $('#inputCep_complemento').length > 0 ? document.getElementById('inputCep_complemento').value = (conteudo.complemento) : '';
        //$('#inputCep_localidade').length > 0 ? document.getElementById('inputCep_localidade').value = (conteudo.localidade) : '';
    } //end if.
    else {
        //CEP não Encontrado.
        clear_cep();
        alert("CEP não encontrado.");
    }
}
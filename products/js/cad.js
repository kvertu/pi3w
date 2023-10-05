var vericep = false;
var verisenha = false;
var vericnpj = false;

function ajax(url) {
    var http;
    var r;
    try {   
        http = new XMLHttpRequest();
    } catch (error) {
        var msg = "Chegou a hora de trocar de navegador!!!";
        console.log(msg);
        alert(msg);
    }
    http.onreadystatechange = function () {
        if (http.readyState == 4) {
            r = http.responseText;
        }
    }
    http.open('GET', url, false);
    http.send(null);
    return r;
}

function cadCep() {
    vericep = false;
    const rcep = /^[0-9]{5}[0-9]{3}$/g;
    var cep = document.getElementById("cep").value;

    if (rcep.test(cep)) {
        var logra = document.getElementById("logra");
        var bai = document.getElementById("bairro");
        var cidade = document.getElementById("cidade");
        var estado = document.getElementById("uf");
        try {
            var end = JSON.parse(ajax(`https://viacep.com.br/ws/${cep}/json/`));
            if (end.logradouro.includes("Avenida")) {
                end.logradouro = end.logradouro.replaceAll("Avenida","Av.");
            }
            if (end.logradouro.includes("Rua")) {
                end.logradouro = end.logradouro.replaceAll("Rua","R.");
            }
            logra.value = end.logradouro;
            bai.value = end.bairro;
            cidade.value = end.localidade;
            estado.value = end.uf;
            vericep = true;
        } catch (error) {
            endereco.value = "Não foi encontrado";
        }
    }
    verificar();
}

function cadCnpj() {
    vericnpj = false;
    const rcnpj = /^\d{2}\d{3}\d{3}\d{4}\d{2}$/g;
    inputcnpj = document.getElementById("cnpj");
    var cnpj = inputcnpj.value;

    if (rcnpj.test(cnpj)) {
        vericnpj = true;
    } 
}

function cadSenha() {
    verisenha = false;
    
    var senha = document.getElementById("senha");
    var csenha = document.getElementById("csenha");
    var aviso = document.getElementById("aviso-senha");

    if (senha.value == csenha.value) {
        verisenha = true;
        aviso.innerHTML = "";
    } else {
        aviso.innerHTML = "Ambos os campos de senha devem ser iguais!";
    }
    verificar();
}

function verificar() {
    var botao = document.getElementById("btn-avancar");
    if (vericep && verisenha && vericnpj) {
        botao.innerHTML = `<input type="submit" class="btn btn-primary" value="Avançar">`;
    } else {
        botao.innerHTML = `<input type="submit" disabled class="btn btn-primary" value="Avançar">`;
    }
}
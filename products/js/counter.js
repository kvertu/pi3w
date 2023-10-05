var tamanho_cesta;
var t = document.getElementById("total");

function define_tamanho_cesta(cont) {
    tamanho_cesta = cont;
}

function total() {
    t.innerText = 0;
    for (let i = 0; i < tamanho_cesta; i++) {
        var sub = document.getElementById("subtotal-" + i);
        // console.log(sub);
        var num = parseFloat(sub.innerText);
        // console.log(num);
        var old = parseFloat(t.innerText);
        t.innerText = round2ndDecimal(num + old);
        // console.log(t.innerText);
    }
}

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

function minus(cont) {
    var counter = document.getElementById("counter-" + cont);
    var sub = document.getElementById("subtotal-" + cont);
    var valor = parseFloat(document.getElementById("price-" + cont).innerText);

    if (counter.value > 1) {
        counter.value = ajax("changecounter.php?op=0&cod=" + cont);
        // console.log(counter.value);
        sub.innerText = round2ndDecimal(valor * counter.value);
        // console.log(round2ndDecimal(valor * counter.value));
        total();
    }
}

function plus(cont) {
    var counter = document.getElementById("counter-" + cont);
    var sub = document.getElementById("subtotal-" + cont);
    var valor = parseFloat(document.getElementById("price-" + cont).innerText);

    if (counter.value < 1000) {
        // sessionStorage.setItem(`cesta[${cont}]['amount']`, sessionStorage.getItem(`cesta[${cont}]['amount']`) + 1);
        counter.value = ajax("changecounter.php?op=1&cod=" + cont);
        sub.innerText = round2ndDecimal(valor * counter.value);
        // console.log(round2ndDecimal(valor * counter.value));
        total();
    }
}

function round2ndDecimal(value) {
    // Os miseráveis da Mozilla são geniais!
    return decimalAdjust('round', value, -2);
}

function decimalAdjust(type, value, exp) {
    // Se exp é indefinido ou zero...
    if (typeof exp === 'undefined' || +exp === 0) {
        return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // Se o valor não é um número ou o exp não é inteiro...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
        return NaN;
    }
    // Transformando para string
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Transformando de volta
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
}
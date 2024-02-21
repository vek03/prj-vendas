var pays = document.getElementById('payments');
var clonePay  = pays.cloneNode(true);
var count1 = 0;

document.getElementById('add-pay').addEventListener('click', function () {
    var payment = document.createElement('div');
    payment.classList.add('payment');
    count1++;

    payment.innerHTML = `
        <div id="dvalue` + count1 + `" class="relative z-0 w-full mb-5 group">
            <label class="block font-medium text-sm text-gray-700" for="value">Valor</label>
            <input oninput="calc2()" value=0 class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="value` + count1 + `" step="any" type="number" name="payments[` + count1 + `][0]" required="required" autofocus="autofocus" autocomplete="value">
        </div>

        <div id="dinvoice` + count1 + `" class="relative z-0 w-full mb-5 group">
            <label class="block font-medium text-sm text-gray-700" for="value">Vencimento</label>
            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="invoice` + count1 + `" type="date" name="payments[` + count1 + `][1]" required="required" autofocus="autofocus" autocomplete="invoice">
            <hr>
            <br>
        </div>
    `;
    
    document.getElementById('payments').appendChild(payment);
    calc();
});



document.getElementById('del-pay').addEventListener('click', function () {
    $('#dvalue' + count1 + '').remove();
    $('#dinvoice' + count1 + '').remove();

    if(count1 > 0)
    {
        count1--;
    }
    calc();
});



function add(count){
    var contador = parseFloat(document.getElementById(count).value);
    contador++;

    if(contador >= 10)
    {
        document.getElementById(count).value = 10;
    }else
    {
        document.getElementById(count).value = contador;
    }

    calc();
}



function del(count){
    var contador = parseFloat(document.getElementById(count).value);
    contador--;

    if(contador <= 0)
    {
        document.getElementById(count).value = 0;
    }else
    {
        document.getElementById(count).value = contador;
    }

    calc();
}



function calc(){
    var numProd = parseInt(document.getElementById('numProd').innerText);
    var valores = [];
    var total = 0;

    for(i = 0; i < numProd ; i++){
        valores[i] = parseFloat(document.getElementById('count' + i).value) * parseFloat(document.getElementById('price' + i).innerText);
    }

    for(i = 0; i < valores.length ; i++){
        total += valores[i];
    }

    document.getElementById('total').value = total;
    calc2();
}



function calc2(){
    var dist = 0;
    var txttotal = document.getElementById('total').value;

    for(i = 0; i <= count1 ; i++){
        if(document.getElementById('value' + i + '').value === '')
        {
            document.getElementById('value' + i + '').value = 0;
        }else
        {
            dist = dist + parseFloat(document.getElementById('value' + i + '').value);
        }
    }

    document.getElementById('dist').value = dist;
    document.getElementById('deft').value = txttotal - dist;
    calc()
}
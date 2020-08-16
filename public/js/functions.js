function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}

function excluir(id) {
    Swal.fire({
        title: 'Deseja Excluir o Registro?',
        text: "Após clicar em sim, não será possível recuperar o registro.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SIM',
        cancelButtonText: 'NÃO'
        }).then((result) => {
        if (result.value) {


	/**********************/

			// Verificar o Browser
			// Firefox, Google Chrome, Safari e outros
			if (window.XMLHttpRequest) {
				req = new XMLHttpRequest();
			 // Internet Explorer
			} else if (window.ActiveXObject) {
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}

			var url = "/product/destroy/" + id;

			req.open("Get", url, true);
			req.send();


	/**********************/

            Swal.fire(
            'Registro Excluído com Sucesso!',
            'Esta ação não poderá ser desfeita.',
            'success'
            )

        document.location.replace('/product');

        }
        })
}

function voltar() {
    window.history.back();
}

function alertaBaixa() {
    Swal.fire({
        icon: 'error',
        title: 'Atenção!',
        text: 'Produto Não Disponível!',
      })
}

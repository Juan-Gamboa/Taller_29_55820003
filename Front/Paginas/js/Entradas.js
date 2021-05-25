const urlApi = "http://localhost/Programacion_avanzada/taller_29_55820003/taller_29_55820003/entradas";
let listaEntradas = [];
let identrada = 0;
let entrada = null;

function indexApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaEntradas = response.data;
            asignarDatosTablaHtml();
        }
    };
    xhttp.open("GET", urlApi, true);
    xhttp.send();
}
indexApi();

function asignarDatosTablaHtml() {
    let html = '';
    for (let item of listaEntradas) {
        console.log(item);
        html += '<tr>';
        html += '    <td class="text-center">' + item.id + '</td>';
        html += '    <td class="text-center">' + item.fecha + '</td>';
        html += '    <td class="text-center">' + item.cantidad +'</td>';
        html += '    <td class="text-center">' + item.persona_id +'</td>';
        html += '    <td class="text-center">' + item.objecto_inventario_id + '</td>';
        html += '    <td class="text-center">';
        html += '        <div class="contentButtons">';
        html += '           <button class="btn btn-secondary" onclick="ver(' + item.id + ')">Ver detalles</button>';
        html += '           <button class="btn btn-success" onclick="modificar(' + item.id + ')">Modificar</button>';
        html += '           <button class="btn btn-danger" onclick="eliminar(' + item.id + ')">Eliminar</button>';
        html += '        <div>';
        // html += '        <div class="contentButtons">';
        // html += '           <button class="button verde" onclick="ver(' + item.id + ')">Ver detalle</button>';
        // html += '           <button class="button azul" onclick="modificar(' + item.id + ')">Modificar</button>';
        // html += '           <button class="button rojo" onclick="eliminar(' + item.id + ')">Eliminar</button>';
        // html += '        <div>';
        html += '    </td>';
        html += '</tr>';
    }
    if (html == '') {
        html += '<tr>';
        html += '    <td class="text-center">No hay datos registrados</td>';
        html += '</tr>';
    }
    const element = document.getElementById('listaEntradas').getElementsByTagName('tbody')[0];
    element.innerHTML = html;
}

function datailApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            entrada = response.data;
        }
    };
    xhttp.open("GET", urlApi + '/' + identrada, false);
    xhttp.send();
}


function saveDataForm(event) {
    event.preventDefault();
    let data = 'fecha=' + document.getElementById('fecha').value;
    data += '&cantidad=' + document.getElementById('cantidad').value;
    data += '&persona_id=' + document.getElementById('persona_id').value;
    data += '&objecto_inventario_id=' + document.getElementById('objecto_inventario_id').value;
    save(data);
}

function save(data) {
    let reponse = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            reponse = JSON.parse(this.response);
            console.log(reponse);
            indexApi();
            onClickCancelar();
        }
    };
    let param = identrada > 0 ? '/' + identrada : '';
    let metodo = identrada > 0 ? 'PUT' : 'POST';
    xhttp.open(metodo, urlApi + param, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}

function crear() {
    identrada = 0;
    entrada = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Registrar datos entrada';
    document.getElementById('fecha').value = '';
    document.getElementById('cantidad').value = '';
    document.getElementById('persona_id').value = '';
    document.getElementById('objecto_inventario_id').value = '';
    document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
}

function modificar(id) {
    console.log(id);
    identrada = id;
    entrada = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Modificar datos entrada';
    datailApi();
    if (entrada != null) {
        document.getElementById('fecha').value = entrada.fecha;
        document.getElementById('cantidad').value = entrada.cantidad;
        document.getElementById('persona_id').value = entrada.persona_id;
        document.getElementById('objecto_inventario_id').value = entrada.objecto_inventario_id;
        document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
    }
}

function eliminar(id) {
    console.log(id);
    identrada = id;
    document.getElementsByClassName('popupControll')[2].classList.remove('popupControll-cerrar');
}

function onClickSi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            identrada = 0;
            entrada = null;
            indexApi();
            document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
        }
    };
    xhttp.open("DELETE", urlApi + '/' + identrada, false);
    xhttp.send();
}

function onClickNo() {
    document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
}

function ver(id) {
    console.log(id);
    identrada = id;
    entrada = null;
    datailApi();
    if (entrada != null) {
        document.getElementById('idLb').innerText = entrada.id;
        document.getElementById('fechaLb').innerText = entrada.fecha;
        document.getElementById('cantidadLb').innerText = entrada.cantidad;
        document.getElementById('persona_idLb').innerText = entrada.persona_id;
        document.getElementById('objecto_inventario_idLb').innerText = entrada.objecto_inventario_id;
        document.getElementsByClassName('popupControll')[1].classList.remove('popupControll-cerrar');
    }
}

function onClickCancelar() {
    document.getElementsByClassName('popupControll')[0].classList.add('popupControll-cerrar');
}

function onClickCerrar() {
    document.getElementsByClassName('popupControll')[1].classList.add('popupControll-cerrar');
}
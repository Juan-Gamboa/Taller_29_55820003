const urlApi = "http://localhost/Programacion_avanzada/Taller_29_55820003/Taller_29_55820003/objetos";
let listaObjetos = [];
let idobjeto = 0;
let objeto = null;

function indexApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaObjetos = response.data;
            asignarDatosTablaHtml();
        }
    };
    xhttp.open("GET", urlApi, true);
    xhttp.send();
}
indexApi();
function asignarDatosTablaHtml() {
    let html = '';
    for (let item of listaObjetos) {
        console.log(item);
        html += '<tr>';
        html += '    <td class="text-center">' + item.id + '</td>';
        html += '    <td class="text-center">' + item.nombre + '</td>';
        html += '    <td class="text-center">' + item.descripcion +'</td>';
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
        html += '    <td colspan="12" class="text-center">No hay datos registrados</td>';
        html += '</tr>';
    }
    const element = document.getElementById('listaObjetos').getElementsByTagName('tbody')[0];
    element.innerHTML = html;
}

function datailApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            objeto = response.data;
        }
    };
    xhttp.open("GET", urlApi + '/' + idobjeto, false);
    xhttp.send();
}


function saveDataForm(event) {
    event.preventDefault();
    let data = 'nombre=' + document.getElementById('nombre').value;
    data += '&descripcion=' + document.getElementById('descripcion').value;
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
    let param = idobjeto > 0 ? '/' + idobjeto : '';
    let metodo = idobjeto > 0 ? 'PUT' : 'POST';
    xhttp.open(metodo, urlApi + param, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}

function crear() {
    idobjeto = 0;
    objeto = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Registrar datos objeto';
    document.getElementById('nombre').value = '';
    document.getElementById('descripcion').value = '';
    document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
}

function modificar(id) {
    console.log(id);
    idobjeto = id;
    objeto = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Modificar datos objeto';
    datailApi();
    if (objeto != null) {
        document.getElementById('nombre').value = objeto.nombre;
        document.getElementById('descripcion').value = objeto.descripcion;
        document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
    }
}

function eliminar(id) {
    console.log(id);
    idobjeto = id;
    document.getElementsByClassName('popupControll')[2].classList.remove('popupControll-cerrar');
}

function onClickSi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            idobjeto = 0;
            objeto = null;
            indexApi();
            document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
        }
    };
    xhttp.open("DELETE", urlApi + '/' + idobjeto, false);
    xhttp.send();
}

function onClickNo() {
    document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
}

function ver(id) {
    console.log(id);
    idobjeto = id;
    objeto = null;
    datailApi();
    if (objeto != null) {
        document.getElementById('idLb').innerText = objeto.id;
        document.getElementById('nombreLb').innerText = objeto.nombre;
        document.getElementById('descripcionLb').innerText = objeto.descripcion;
        document.getElementsByClassName('popupControll')[1].classList.remove('popupControll-cerrar');
    }
}

function onClickCancelar() {
    document.getElementsByClassName('popupControll')[0].classList.add('popupControll-cerrar');
}

function onClickCerrar() {
    document.getElementsByClassName('popupControll')[1].classList.add('popupControll-cerrar');
}
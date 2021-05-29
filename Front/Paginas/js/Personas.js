const urlApi = "http://localhost/Programacion_avanzada/Taller_29_55820003/Taller_29_55820003/personas";
const urlApiE = "http://localhost/Programacion_avanzada/Taller_29_55820003/Taller_29_55820003/entradas";
const urlApiS = "http://localhost/Programacion_avanzada/Taller_29_55820003/Taller_29_55820003/salidas";
let listaPersonas = [];
let listaEntradas = [];
let listaSalidas = [];
let idpersona = 0;
let persona = null;

function indexApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaPersonas = response.data;
            asignarDatosTablaHtml();
        }
    };
    xhttp.open("GET", urlApi, true);
    xhttp.send();
}
function indexApiE() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaEntradas = response.data;

        }
    };
    xhttp.open("GET", urlApiE, true);
    xhttp.send();
}
function indexApiS() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaSalidas = response.data;

        }
    };
    xhttp.open("GET", urlApiS, true);
    xhttp.send();
}
indexApi();
indexApiE();
indexApiS();
function asignarDatosTablaHtml() {
    let html = '';
    for (let item of listaPersonas) {
        console.log(item);
        html += '<tr>';
        html += '    <td class="text-center">' + item.id + '</td>';
        html += '    <td class="text-center">' + item.tipo_identificacion + '</td>';
        html += '    <td class="text-center">' + item.numero_identificacion +'</td>';
        html += '    <td class="text-center">' + item.nombres +'</td>';
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
    const element = document.getElementById('listaPersonas').getElementsByTagName('tbody')[0];
    element.innerHTML = html;
}

function datailApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            persona = response.data;
        }
    };
    xhttp.open("GET", urlApi + '/' + idpersona, false);
    xhttp.send();
}


function saveDataForm(event) {
    event.preventDefault();
    let data = 'tipo_identificacion=' + document.getElementById('tipo_identificacion').value;
    data += '&numero_identificacion=' + document.getElementById('numero_identificacion').value;
    data += '&nombres=' + document.getElementById('nombres').value;
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
    let param = idpersona > 0 ? '/' + idpersona : '';
    let metodo = idpersona > 0 ? 'PUT' : 'POST';
    xhttp.open(metodo, urlApi + param, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}

function crear() {
    idpersona = 0;
    persona = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Registrar datos persona';
    document.getElementById('tipo_identificacion').value = '';
    document.getElementById('numero_identificacion').value = '';
    document.getElementById('nombres').value = '';
    document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
}

function modificar(id) {
    console.log(id);
    idpersona = id;
    persona = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Modificar datos persona';
    datailApi();
    if (persona != null) {
        document.getElementById('tipo_identificacion').value = persona.tipo_identificacion;
        document.getElementById('numero_identificacion').value = persona.numero_identificacion;
        document.getElementById('nombres').value = persona.nombres;
        document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
    }
}
function validarPersonasR(idpersona){
    let itemP=idpersona;
    console.log(itemP);
    let val=false;
    for (let itemE of listaEntradas){
        if(itemP==itemE.persona_id){
            val=true;
            console.log(val);
            break;
        }else{
            for (let itemS of listaSalidas){
                if(itemP==itemS.persona_id){
                    val=true;
                    console.log(val);
                    break;
                }else{          
                    val=false;
                    console.log(val);
                }
            } 
        }    
    }
    if(val!=false){
        window.alert("La persona no se puede eliminar debido a que tiene un registro a su nombre");
    }else{
        window.alert("Esta persona no tiene registros a su nombre");
    }
    
}
function eliminar(id) {
    console.log(id);
    idpersona = id;
    validarPersonasR(idpersona);
    document.getElementsByClassName('popupControll')[2].classList.remove('popupControll-cerrar');
}

function onClickSi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            idpersona = 0;
            persona = null;
            indexApi();
            document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
        }
    };
    xhttp.open("DELETE", urlApi + '/' + idpersona, false);
    xhttp.send();
}

function onClickNo() {
    document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
}

function ver(id) {
    console.log(id);
    idpersona = id;
    persona = null;
    datailApi();
    if (persona != null) {
        document.getElementById('idLb').innerText = persona.id;
        document.getElementById('tipo_identificacionLb').innerText = persona.tipo_identificacion;
        document.getElementById('numero_identificacionLb').innerText = persona.numero_identificacion;
        document.getElementById('nombresLb').innerText = persona.nombres;
        document.getElementsByClassName('popupControll')[1].classList.remove('popupControll-cerrar');
    }
}

function onClickCancelar() {
    document.getElementsByClassName('popupControll')[0].classList.add('popupControll-cerrar');
}

function onClickCerrar() {
    document.getElementsByClassName('popupControll')[1].classList.add('popupControll-cerrar');
}
const urlApi = "http://localhost/Programacion_avanzada/Taller_29_55820003/Taller_29_55820003/salidas";
const urlApiE = "http://localhost/Programacion_avanzada/Taller_29_55820003/Taller_29_55820003/entradas";
const urlApiP = "http://localhost/Programacion_avanzada/Taller_29_55820003/Taller_29_55820003/personas";
const urlApiO = "http://localhost/Programacion_avanzada/Taller_29_55820003/Taller_29_55820003/objetos";
let listaSalidas = [];
let listaEntradas = [];
let listaPersonas = [];
let listaObjetos = [];
let idsalida = 0;
let salida = null;
function indexApiP(){
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaPersonas = response.data;
        }
    };
    xhttp.open("GET", urlApiP, true);
    xhttp.send();
}
function indexApiO(){
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaObjetos = response.data;
        }
    };
    xhttp.open("GET", urlApiO, true);
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
function indexApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            listaSalidas = response.data;
            asignarDatosTablaHtml();
            asignarDatosPersonaId();
            asignarDatosObjetosId();
        }
    };
    xhttp.open("GET", urlApi, true);
    xhttp.send();
}
indexApi();
indexApiO();
indexApiP();
indexApiE();
function asignarDatosPersonaId(){
    for (let itemP of listaPersonas){
        console.log(itemP.id);
        document.getElementById("persona_id").innerHTML += "<option value='"+itemP.id+"'>"+itemP.nombres+"</option>";
    }        
}
function asignarDatosObjetosId(){
    for (let itemO of listaObjetos){
        console.log(itemO.id);
        document.getElementById("objecto_inventario_id").innerHTML += "<option value='"+itemO.id+"'>"+itemO.nombre+"</option>";
    }        
}
function asignarDatosTablaHtml() {
    let html = '';
    let val=false;
    let canE='';
    for (let item of listaSalidas) {
        console.log(item);
        html += '<tr>';
        html += '    <td class="text-center">' + item.id + '</td>';
        html += '    <td class="text-center">' + item.fecha + '</td>';
        html += '    <td class="text-center">' + item.cantidad +'</td>';
        html += '    <td class="text-center">' + item.persona_id +'</td>';
        html += '    <td class="text-center">' + item.objecto_inventario_id + '</td>';
        for (let itemE of listaEntradas) {
            if(item.objecto_inventario_id==itemE.objecto_inventario_id){
                console.log(itemE.cantidad);
                canE=itemE.cantidad;
                val=true; 
                break;
            } 
        }
        if(val!=false){
            html += '    <td class="text-center">' + canE + '</td>';
        }
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
    const element = document.getElementById('listaSalidas').getElementsByTagName('tbody')[0];
    element.innerHTML = html;
}

function datailApi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            salida = response.data;
        }
    };
    xhttp.open("GET", urlApi + '/' + idsalida, false);
    xhttp.send();
}


function saveDataForm(event) {
    validarCantidad();
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
    let param = idsalida > 0 ? '/' + idsalida : '';
    let metodo = idsalida > 0 ? 'PUT' : 'POST';
    xhttp.open(metodo, urlApi + param, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}
function validarCantidad(){
    num1=document.getElementById('cantidad').value;
    numV=false;
    if (num1 <= 0) {
            alert("No se puede registrar cantidades negativas");
    }else{
        if (Number.isInteger(Number(num1))) {
            numV=true;
        } else {
            numV=false;
        }
        if (numV == false) {
             alert("No se puede registrar cantidades decimales");
        }else{
            validarCantidadE();   
            }
        }   
}
function validarCantidadE(){
    num1=document.getElementById('cantidad').value;
    idO=document.getElementById('objecto_inventario_id').value;
    for (let itemE of listaEntradas) {
        if(item.objecto_inventario_id==itemE.objecto_inventario_id){
            console.log(itemE.cantidad);
            if(num1>itemE.cantidad){
                console.log(num1);
                alert("La cantidad de salida"+num1+"no Puede superar la cantidad de entrada"+itemE.cantidad+"del objeto con id"+idO);
                break;
            }
        } 
    }

}
function crear() {
    idsalida = 0;
    salida = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Registrar datos salida';
    document.getElementById('fecha').value = '';
    document.getElementById('cantidad').value = '';
    document.getElementById('persona_id').value = '';
    document.getElementById('objecto_inventario_id').value = '';
    document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
}

function modificar(id) {
    console.log(id);
    idsalida = id;
    salida = null;
    const elementTitulo = document.getElementById('controlForm').getElementsByTagName('h2')[0];
    elementTitulo.innerText = 'Modificar datos salida';
    datailApi();
    if (salida != null) {
        document.getElementById('fecha').value = salida.fecha;
        document.getElementById('cantidad').value = salida.cantidad;
        document.getElementById('persona_id').value = salida.persona_id;
        document.getElementById('objecto_inventario_id').value = salida.objecto_inventario_id;
        document.getElementsByClassName('popupControll')[0].classList.remove('popupControll-cerrar');
    }
}

function eliminar(id) {
    console.log(id);
    idsalida = id;
    document.getElementsByClassName('popupControll')[2].classList.remove('popupControll-cerrar');
}

function onClickSi() {
    let response = null;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            response = JSON.parse(this.response);
            console.log(response);
            idsalida = 0;
            salida = null;
            indexApi();
            document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
        }
    };
    xhttp.open("DELETE", urlApi + '/' + idsalida, false);
    xhttp.send();
}

function onClickNo() {
    document.getElementsByClassName('popupControll')[2].classList.add('popupControll-cerrar');
}

function ver(id) {
    console.log(id);
    idsalida = id;
    salida = null;
    datailApi();
    if (salida != null) {
        document.getElementById('idLb').innerText = salida.id;
        document.getElementById('fechaLb').innerText = salida.fecha;
        document.getElementById('cantidadLb').innerText = salida.cantidad;
        document.getElementById('persona_idLb').innerText = salida.persona_id;
        document.getElementById('objecto_inventario_idLb').innerText = salida.objecto_inventario_id;
        document.getElementsByClassName('popupControll')[1].classList.remove('popupControll-cerrar');
    }
}

function onClickCancelar() {
    document.getElementsByClassName('popupControll')[0].classList.add('popupControll-cerrar');
}

function onClickCerrar() {
    document.getElementsByClassName('popupControll')[1].classList.add('popupControll-cerrar');
}
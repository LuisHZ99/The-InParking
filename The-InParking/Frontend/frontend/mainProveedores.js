document.addEventListener("DOMContentLoaded", function() {
    
//API PARA TRAER LOS DATOS DE UN VISITANTE CON EL PARAMETRO DE SU NO.CONTROL DESDE LA TABLA CUANDO SELECCIONAMOS LA FILA DEL ALUMNO
let datos = document.getElementById("datos_p");

//VARIABLE PARA ALMACENAR EL CODIGO SELECICONADO DE LA TABLA
let codigo_p;
let empresa;
let fecha_e_p;

axios
  .get('https://nandbless99.shop/theinparking/backend/getProveedorData.php')
  .then((response) => {
    datos.innerHTML = "";
    let array = response.data;

    array.forEach((dato, index) => {
      //CREA UA NUEVA FILA
      let nuevaFila = document.createElement("tr");

      //AGREGA LAS CELDAS CORRESPONDIENTES A LA FILA
      nuevaFila.innerHTML =
        "<td>" + dato.codigo_p + "</td>" +
        "<td>" + dato.nombre + "</td>" +
        "<td>" + dato.empresa + "</td>"+
        "<td>" + dato.fecha_e_p + "</td>";

      //EVENTO CLIC LA FILA DE LA TABLA
      nuevaFila.addEventListener("click", function() {
        //SELECCIONA LOS DATOS DE LA CELDA QUE SELCCIONAMOS EN LA FILA
        let datos_proveedor = this.getElementsByTagName("td");

        //OBTIENE EL CODIGO DE LA CELDA DE LA FILA SELECCIONADA
        codigo_p = datos_proveedor[0].innerHTML;
        empresa = datos_proveedor[2].innerHTML;
        fecha_e_p = datos_proveedor[3].innerHTML;

let modalBodyProveedor = document.getElementById("modalBodyProveedor");
            modalBodyProveedor.innerHTML = "";
        //REALIZA LA SOLICITUD API PARA OBTENER LOS DATOS GENERALES
        axios
        .get("https://nandbless99.shop/theinparking/backend/getProveedorTotalData.php?codigo_p=" + codigo_p)
          .then((response) => {
          
let data = response.data;


if (data.length > 0) {
  let proveedores = data[0]; //ACCEDE AL PRIMER OBJETO EN EL ARRAY

  let nombre_p = proveedores.nombre_p;
  let ap_p = proveedores.ap_p;
  let am_p = proveedores.am_p;
  let identificacion_p = proveedores.identificacion_p;
  let placa_p = proveedores.placa_p;
  let modelo_p = proveedores.modelo_p;

  //AGREGA AL MODAL LOS DATOS OBTENIDOS DE LA API
  modalBodyProveedor.innerHTML = "";
  modalBodyProveedor.innerHTML +=
    "<p><span class='fuente-cabecera-card-modalpv'>Código: </span><span class='fuente-dato-card-modalpv'>" + codigo_p+ "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Nombre: </span><span class='fuente-dato-card-modalpv'>" + nombre_p + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Apellido Paterno: </span><span class='fuente-dato-card-modalpv'>" + ap_p + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Apellido Materno: </span><span class='fuente-dato-card-modalpv'>" + am_p + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Identificacion: </span><span class='fuente-dato-card-modalpv'>" + empresa + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Placa: </span><span class='fuente-dato-card-modalpv'>" + placa_p + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Modelo: </span><span class='fuente-dato-card-modalpv'>" + modelo_p + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Fecha de Ingreso: </span><span class='fuente-dato-card-modalpv'>" + fecha_e_p + "</span></p>" ;

  //ABRE EL MODAL
  $('#myModalProveedor').modal('show');
} else {
  console.log("No se encontraron registros para el número de control proporcionado.");
}
          })
          .catch(error => console.error(error));
      });

      //AGREGA UNA NUEVA FILA A LA TABLA
      datos.appendChild(nuevaFila);
    });
  })
  .catch(error => console.error(error));
  
 
});
 

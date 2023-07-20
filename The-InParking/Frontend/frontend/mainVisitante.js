document.addEventListener("DOMContentLoaded", function() {
    
//API PARA TRAER LOS DATOS DE UN VISITANTE CON EL PARAMETRO DE SU NO.CONTROL DESDE LA TABLA CUANDO SELECCIONAMOS LA FILA DEL ALUMNO
let datos = document.getElementById("datos_v");

//VARIABLE PARA ALMACENAR EL CODIGO SELECICONADO DE LA TABLA
let codigo_v; 
let motivo;
let fecha_e_v;

axios
  .get('https://nandbless99.shop/theinparking/backend/getVisitanteData.php')
  .then((response) => {
    datos.innerHTML = "";
    let array = response.data;

    array.forEach((dato, index) => {
      //CREA UA NUEVA FILA
      let nuevaFila = document.createElement("tr");

      //AGREGA LAS CELDAS CORRESPONDIENTES A LA FILA
      nuevaFila.innerHTML =
        "<td>" + dato.codigo_v + "</td>" +
        "<td>" + dato.nombre + "</td>" +
        "<td>" + dato.motivo + "</td>"+
        "<td>" + dato.fecha_e_v + "</td>";

      //EVENTO CLIC LA FILA DE LA TABLA
      nuevaFila.addEventListener("click", function() {
        //SELECCIONA LOS DATOS DE LA CELDA QUE SELCCIONAMOS EN LA FILA
        let datos_visitante = this.getElementsByTagName("td");

        //OBTIENE EL CODIGO DE LA CELDA DE LA FILA SELECCIONADA
        codigo_v = datos_visitante[0].innerHTML;
        motivo = datos_visitante[2].innerHTML;
        fecha_e_v = datos_visitante[3].innerHTML;

let modalBodyVisitante = document.getElementById("modalBodyVisitante");
            modalBodyVisitante.innerHTML = "";
        //REALIZA LA SOLICITUD API PARA OBTENER LOS DATOS GENERALES
        axios
        .get("https://nandbless99.shop/theinparking/backend/getVisitanteTotalData.php?codigo_v=" + codigo_v)
          .then((response) => {
          
let data = response.data;


if (data.length > 0) {
  let visitantes = data[0]; //ACCEDE AL PRIMER OBJETO EN EL ARRAY

  let nombre_v = visitantes.nombre_v;
  let ap_v = visitantes.ap_v;
  let am_v = visitantes.am_v;
  let identificacion_v = visitantes.identificacion_v;
  let destino_v = visitantes.destino_v;
  let placa_v = visitantes.placa_v;
  let modelo_v = visitantes.modelo_v;

  //AGREGA AL MODAL LOS DATOS OBTENIDOS DE LA API
  modalBodyVisitante.innerHTML = "";
  modalBodyVisitante.innerHTML +=
    "<p><span class='fuente-cabecera-card-modalpv'>Código: </span><span class='fuente-dato-card-modalpv'>" + codigo_v+ "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Nombre: </span><span class='fuente-dato-card-modalpv'>" + nombre_v + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Apellido Paterno: </span><span class='fuente-dato-card-modalpv'>" + ap_v + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Apellido Materno: </span><span class='fuente-dato-card-modalpv'>" + am_v + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Identificacion: </span><span class='fuente-dato-card-modalpv'>" + identificacion_v + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Motivo: </span><span class='fuente-dato-card-modalpv'>" + motivo + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Destino: </span><span class='fuente-dato-card-modalpv'>" + destino_v + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Placa: </span><span class='fuente-dato-card-modalpv'>" + placa_v + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Modelo: </span><span class='fuente-dato-card-modalpv'>" + modelo_v + "</span></p>" +
    "<p><span class='fuente-cabecera-card-modalpv'>Fecha de Ingreso: </span><span class='fuente-dato-card-modalpv'>" + fecha_e_v + "</span></p>" ;

  //ABRE EL MODAL
  $('#myModalVisitante').modal('show');
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
 

document.addEventListener("DOMContentLoaded", function() {
    
    //API PARA TRAER LOS DATOS DEL ULTIMO QUE INGRESO AL ESTACIONAMIENTO 
  const foto_usuario = document.querySelector('.foto_usuario');
  let lblnombre = document.getElementById('lblnombre');
  let lblapellidos = document.getElementById('lblapellidos');
  let lblnocontrol = document.getElementById('lblnocontrol');
  let lblcarrera = document.getElementById('lblcarrera');
  let lbltelefono = document.getElementById('lbltelefono');
  let lblplacas = document.getElementById('lblplacas');
  let lblmarca = document.getElementById('lblmarca');
  let lblmodelo = document.getElementById('lblmodelo');
  let lblcolor = document.getElementById('lblcolor');
  let lblhrentrada = document.getElementById('lblhrentrada');

//VARIABLE PARA ALMACENAR EL CODIGO ANTERIOR
let codigo_nc_ea_anterior = null;

setInterval(() => {
  axios
    .get('http://nandbless99.shop/theinparking/backend/getStatusAlumnoEntradaCard.php')
    .then(response => {
      let data = response.data;
      foto_usuario.src = data.foto_a; 
      lblnombre.innerHTML = data.nombre;
      lblapellidos.innerHTML = data.apellidos;

      //VERIFICAR SI EL CODIGO HA CAMBIADO
      if (data.codigo_nc_ea !== codigo_nc_ea_anterior) {
        codigo_nc_ea_anterior = data.codigo_nc_ea;
        lblnocontrol.innerHTML = data.codigo_nc_ea;

        //SI EL CODIGO CAMBIA SE ACTUALIZA LA TABLA CON LOS NUEVOS DATOS DEL NUEVO CODIGO
        actualizarTabla();
      }

      lblcarrera.innerHTML = data.carrera;
      lbltelefono.innerHTML = data.telefono;
      lblplacas.innerHTML = data.placa_a;
      lblmarca.innerHTML = data.marca;
      lblmodelo.innerHTML = data.modelo;
      lblcolor.innerHTML = data.color;
      lblhrentrada.innerHTML = data.fecha_i_a;
    })
    .catch(error => console.error(error));
}, 1000);



//ACTUALIZA LA TABLA CON LOS DATOS DE NUEVO INSERT
function actualizarTabla() {
  axios
    .get('https://nandbless99.shop/theinparking/backend/getAlumnoData.php')
    .then(response => {
      let array = response.data;
      let datos = document.getElementById("datos_a");
      datos.innerHTML = "";

      array.forEach(dato => {
        let nuevaFila = document.createElement("tr");

        nuevaFila.innerHTML =
          "<td>" + dato.codigo_nc_ea + "</td>" +
          "<td>" + dato.nombre + "</td>" +
          "<td>" + dato.fecha_i_a + "</td>";

        nuevaFila.addEventListener("click", function() {
          let datos_alumno = this.getElementsByTagName("td");
          let codigo_nc_ea = datos_alumno[0].innerHTML;
          let fecha_i_a = datos_alumno[2].innerHTML;

          obtenerDatosGenerales(codigo_nc_ea, fecha_i_a);
        });

        datos.appendChild(nuevaFila);
      });
    })
    .catch(error => console.error(error));
}


//OBTIENE DATOS GENERALES DEL ALUMNO CUANOD DAS CLIC EN LA TABLA ENVIADO PARAMETROS DE SU CODIGO Y LA FECHA DE INGRESO
function obtenerDatosGenerales(codigo_nc_ea, fecha_i_a) {
  axios
    .get("https://nandbless99.shop/theinparking/backend/getAlumnoTotalData.php?codigo_nc_ea=" + codigo_nc_ea + "&fecha_i_a="+ fecha_i_a)
    .then(response => {
      let data = response.data;

      if (data.length > 0) {
        let alumno = data[0];
        let nombre = alumno.nombre;
        let ap_a = alumno.ap_a;
        let am_a = alumno.am_a;
        let carrera = alumno.carrera;
        let telefono = alumno.telefono;
        let placa_a = alumno.placa_a;
        let marca = alumno.marca;
        let modelo = alumno.modelo;
        let color = alumno.color;
        let fecha_s_a = alumno.fecha_s_a;

        let modalBodyPanelP = document.getElementById("modalBodyPanelP");
        modalBodyPanelP.innerHTML = "";

        modalBodyPanelP.innerHTML +=
          "<p><span class='fuente-cabecera-card-modalp'>No.Control: </span><span class='fuente-dato-card-modalp'>" + codigo_nc_ea + "</span></p>" +
          "<p><span class='fuente-cabecera-card-modalp'>Nombre: </span><span class='fuente-dato-card-modalp'>" + nombre + "</span></p>" +
          "<p><span class='fuente-cabecera-card-modalp'>Apellido Paterno: </span><span class='fuente-dato-card-modalp'>" + ap_a + "</span></p>" +
          "<p><span class='fuente-cabecera-card-modalp'>Apellido Materno: </span><span class='fuente-dato-card-modalp'>" + am_a + "</span></p>" +
          "<p><span class='fuente-cabecera-card-modalp'>Carrera: </span><span class='fuente-dato-card-modalp'>" + carrera + "</span></p>" +
          "<p><span class='fuente-cabecera-card-modalp'>Telefono: </span><span class='fuente-dato-card-modalp'>" + telefono + "</span></p>" +
          "<p><span class='fuente-cabecera-card-modalp'>Placa: </span><span class='fuente-dato-card-modalp'>" + placa_a + "</span></p>" +
          "<p><span class='fuente-cabecera-card-modalp'>Marca: </span><span class='fuente-dato-card-modalp'>" + marca + "</span></p>" +
          "<p><span class='fuente-cabecera-card-modalp'>Modelo: </span><span class='fuente-dato-card-modalp'>" + modelo + "<span></p>" +
          "<p><span class='fuente-cabecera-card-modalp'>Color: </span><span class='fuente-dato-card-modalp'>" + color + "</span></p>" +
          "<p><span class='fuente-cabecera-card-modalp'>Fecha de Ingreso: </span><span class='fuente-dato-card-modalp'>" + fecha_i_a + "</span></p>"+
          "<p><span class='fuente-cabecera-card-modalp'>Fecha de Salida: </span><span class='fuente-dato-card-modalp'>" + fecha_s_a + "</span></p>";

        $('#myModalPanelP').modal('show');
      } else {
        console.log("No se encontraron registros para el número de control proporcionado.");
      }
    })
    .catch(error => console.error(error));
}

 
});
 

/*eslint-disable*/

function calcularTotal(services, users) {
    let total = 0;
      if (services == 1) {
      total += 3000;
    }else if(services > 1 && services <= 5){
      total += 5000;
    } 
    else if (services >= 6 && services <= 10) {
      total += 8000;
    } else {
      total += 12000;
    }
    total += users * 1000;
    return total;
  }

  // Función para manejar el envío del formulario
  function handleSubmit(event) {
    event.preventDefault();
    const services = parseInt(document.getElementById('services').value);
    const users = parseInt(document.getElementById('users').value);
    const total = calcularTotal(services, users);
    mostrarResultado(total);
  }

  // Función para mostrar el resultado en el HTML
  function mostrarResultado(total) {
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = `<h3 class="total-a-pagar"><a href="/comprar">Total a Pagar: <span>$${total}</span></a></h3>`;
  }

  // Asignar el evento 'submit' al formulario
  document.getElementById('payment-form').addEventListener('submit', handleSubmit);



  //EDITAR FOTO DE PERFIL - RESERVADOR
function editProfilePhoto() {
  // Lógica para editar la foto de perfil
  alert("Editar foto de perfil");
}


//EDITAR INFORMACION DEL PERFIL- RESERVADOR
function mostrarFormulario() {
  // Encuentra el formulario de actualización y muéstralo
  var formulario = document.getElementById("formulario-actualizar-perfil");
  formulario.style.display = "block";

  //Oculta el botón de editar perfil después de mostrar el formulario
  var botonEditar = document.getElementById("editar-perfil");
  botonEditar.style.display = "none";
}


function eliminarNotificacion(id) {
  // Lógica para eliminar una notificación individual
  alert("Eliminar notificación " + id);
}

function eliminarTodasNotificaciones() {
  // Lógica para eliminar todas las notificaciones
  alert("Eliminar todas las notificaciones");
}




// Modal para la parte de sacar turno en RESERVADOR
function mostrarModal(servicioId) {
  // Establecer el ID del servicio en el formulario
  document.getElementById('servicio-id').value = servicioId;
  document.getElementById('modal-turno').style.display = 'block';
}

function cerrarModal() {
  document.getElementById('modal-turno').style.display = 'none';
}

// Cerrar el modal si el usuario hace clic fuera de él
window.onclick = function(event) {
  var modal = document.getElementById('modal-turno');
  if (event.target == modal) {
      modal.style.display = 'none';
      
  }
}


//Hasta aca lo del modal  
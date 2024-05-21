function cargarDatos() {
  fetch("./controllers/traerAllClasesController.php")
    .then((response) => response.json())
    .then((data) => {
      const tablaDatos = document.getElementById("tablaDatos");
      tablaDatos.innerHTML = "";
      data.forEach((row) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-4 fs-5 text-dark">${row.codigo}</td>
            <td class="px-6 py-4 fs-5 text-dark">${row.nombre}</td>
            <td class="px-6 py-4 fs-5 text-dark">${row.precio}</td>
            <td class="px-6 py-4 fs-5 text-dark">${row.categoria}</td>

            <td class="flex justify-evenly mt-4">
              <button id='actualizar' onclick='TraerDatos(${row.codigo})' class='btn btn-primary ' type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                <i class="fa-solid fa-pen-to-square text-black  hover:text-blue-400"></i>
              </button>

              <button id='eliminar' onClick='eliminarProducto(${row.codigo})' class='btn btn-danger  '>
                <i class="fa-solid fa-trash text-black  hover:text-red-400"></i>
              </button>
            </td>


          </tr>`;

        tablaDatos.appendChild(tr);
      });
    });
}

function limpiarFormulario() {
  var inputCodigo = document.getElementById("codigo");
  var inputNombre = document.getElementById("nombre");
  var inputPrecio = document.getElementById("precio");
  var inputCategoria = document.getElementById("categoria");

  inputCodigo.value = "";
  inputNombre.value = "";
  inputPrecio.value = "";
  inputCategoria.value = "";
}

function guardarClase( codigo,nombre, precio, categoria) {
  fetch(
    `./controllers/guardarController.php?&codigo=${codigo}&nombre=${nombre}&precio=${precio}&categoria=${categoria}`
  )
    .then((response) => response.text())
    .then((data) => {
      limpiarFormulario();
      cargarDatos();
    });
}


function agregarClase() {
  const nombre = document.getElementById("nombre").value;
  const precio = document.getElementById("precio").value;
  const categoria = document.getElementById("categoria").value;

  fetch(
    `./controllers/agregarProductoController.php?&nombre=${nombre}&precio=${precio}&categoria=${categoria}`
  )
    .then((response) => {
      return response.text();
    })
    .then((data) => {
      console.log(data);
      if (data === "Agregado Exitosamente") {
        cargarDatos();
        limpiarFormulario(); 
      } else {
        console.error("Error al agregar el producto:", data);
      }
    })
    .catch((error) => {
      console.error("Error al agregar el producto:", error);
    });
}


function eliminarProducto(codigo) {

  var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'), {
    keyboard: false
  });

  confirmDeleteModal.show();

  
  document.getElementById("confirmDeleteButton").addEventListener("click", function() {

    fetch("./controllers/eliminarProductoController.php?codigo=" + codigo)
      .then((response) => response.text())
      .then((data) => {
        console.log(data);
        cargarDatos();
      })
      .catch((error) => {
        console.error("Error al eliminar el producto:", error);
      });

    confirmDeleteModal.hide();
  });
}


function TraerDatos(codigo) {
  fetch(`./controllers/traerClaseController.php?codigo=${codigo}`)
    .then((response) => response.json())
    .then((data) => {
      var inputCodigo = document.getElementById("codigo");
      var inputNombre = document.getElementById("nombre");
      var inputPrecio = document.getElementById("precio");
      var inputCategoria = document.getElementById("categoria");

      inputCodigo.value = data["codigo"];
      inputNombre.value = data["nombre"];
      inputPrecio.value = data["precio"];
      inputCategoria.value = data["categoria"];
      
    });

  var boton = document.getElementById("guardar");

  boton.onclick = function () {
    var inputCodigo = document.getElementById("codigo");
    var inputNombre = document.getElementById("nombre");
    var inputPrecio = document.getElementById("precio");
    var inputCategoria = document.getElementById("categoria");

    var valcodigo = inputCodigo.value;
    var valNombre = inputNombre.value;
    var valPrecio = inputPrecio.value;
    var valCategoria = inputCategoria.value;
    limpiarFormulario();
    guardarClase( valcodigo,valNombre, valPrecio, valCategoria);
   
    
  };
}

cargarDatos();

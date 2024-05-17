function cargarDatos(){
  fetch('controllers/traerClaseController.php')
  .then(response=>response.json())
  .then(data=>{
      const tablaDatos=document.getElementById('tablaDatos');
      tablaDatos.innerHTML='';
      data.forEach(row => {
          const tr=document.createElement('tr');
          tr.innerHTML=`
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-4">${row.codigo}</td>
            <td class="px-6 py-4">${row.nombre}</td>
            <td class="px-6 py-4">${row.precio}</td>
            <td class="px-6 py-4">${row.categoria}</td>

            <td class="flex justify-evenly mt-4">
              <button id='eliminar' onClick='eliminarClase(${row.codigo})'>
                <i class="fa-solid fa-pen-to-square text-black hover:text-blue-400"></i>
              </button>

              <button id='actualizar'>
                <i class="fa-solid fa-trash text-black  hover:text-red-400"></i>
              </button>
            </td>

      
              
            
          </tr>`;

          tablaDatos.appendChild(tr);
          
      });
  });
}

cargarDatos()

function eliminarProducto(id) {
  fetch("./controllers/eliminarProductoController.php?id=" + id)
    .then((response) => response.text())
    .then((data) => {
      alert("Ok");
    });
}
cargarDatos();


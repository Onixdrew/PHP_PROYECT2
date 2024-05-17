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
              <button id='actualizar' '   >
                <i class="fa-solid fa-pen-to-square text-black hover:text-blue-400"></i>
              </button>

              <button id='actualizareliminar onClick='eliminarClase(${row.codigo}'>
                <i class="fa-solid fa-trash text-black  hover:text-red-400"></i>
              </button>
            </td>


          </tr>`;

          tablaDatos.appendChild(tr);
          
      });
  });
}








function limpiarFormulario(){
  var inputCodigo=document.getElementById("codigo")
  var inputNombre=document.getElementById("nombre");
  var inputPrecio=document.getElementById("precio");
  var inputCategoria=document.getElementById("categoria");
  
  inputCodigo.value="";
  inputNombre.value="";
  inputPrecio.value="";
  inputCategoria.value="";
  
}



function guardarClase(codigo,nombre,precio,categoria){
  fetch( `./controllers/guardarController.php?codigo=${codigo} &nombre=${nombre} &precio= ${precio} &categoria= ${categoria}`)
  .then(response=>response.text())
  .then(data=>{
      limpiarFormulario();
      cargarDatos();
    });
    
  }
  
  function agregarClase() {
    const codigo = document.getElementById("codigo").value;
    const nombre = document.getElementById("nombre").value;
    const precio = document.getElementById("precio").value;
    const categoria = document.getElementById("categoria").value;
    
    fetch(
      `./Controller/aagregarProductoController.php?codigo=${codigo} &nombre=${nombre} &precio=${precio} &categoria=${categoria}`
    )
    .then((response) => {
      return response.text();
      
    })
    .then((data) => {
      console.log(data);
      document.getElementById("codigo").value = "";
      document.getElementById("nombre").value = "";
      document.getElementById("precio").value = "";
      document.getElementById("categoria").value = "";
    });
  }
  
  
  function eliminarProducto(codigo) {
    fetch("./controllers/eliminarProductoController.php?codigo=" + codigo)
      .then((response) => response.text())
      .then((data) => {
        alert("Ok");
        cargarDatos();
      });
  }

  
function TraerDatos(codigo){
  fetch(`./controller/traerClaseController.php?codigo= ${codigo}`)
  .then(response=>response.json())
  .then(data=>{
      var inputNombre=document.getElementById("nombre");
      var inputPrecio=document.getElementById("precio");
      var inputCategoria=document.getElementById("categoria");
      
      inputNombre.value=data['nombre'];
      inputPrecio.value=data['precio'];
      inputCategoria.value=data['categoria'];
    
     
      
  });
  var boton=document.getElementById("guardar");

  boton.onclick=function(){
    var inputCodigo=document.getElementById("codigo")
    var inputNombre=document.getElementById("nombre");
    var inputPrecio=document.getElementById("precio");
    var inputCategoria=document.getElementById("categoria");
    
    var valcodigo=inputCodigo.value;
    var valNombre=inputNombre.value;
    var valPrecio=inputPrecio.value;
    var valCategoria=inputCategoria.value;
    limpiarFormulario()
    guardarClase(valcodigo,valNombre,valPrecio,valCategoria);
 
  };

};



cargarDatos();
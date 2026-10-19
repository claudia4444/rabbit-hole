const contenedor = document.getElementById("imagen-container");
const texto = document.getElementById("texto-placeholder");
const imagen = document.getElementById("imagen-aleatoria");

let semillaActual = null;

contenedor.addEventListener("click", function () {
  semillaActual = Date.now();
  imagen.src = "https://picsum.photos/seed/" + semillaActual + "/400";

  imagen.style.display = "block";
  texto.style.display = "none";
  contenedor.classList.add("con-imagen");
});

const input = document.getElementById("input-usuario");

input.addEventListener("input", function () {
  input.style.width = Math.max(input.value.length + 8, 30) + "ch";

  input.style.height = "auto";
  input.style.height = (input.scrollHeight + 12) + "px";
});

const botonGuardar = document.getElementById("boton-guardar");

botonGuardar.addEventListener("click", function () {
  if (!semillaActual) {
    alert("Primero pincha en el cuadrado para elegir una imagen.");
    return;
  }
  if (!input.value.trim()) {
    alert("Escribe una curiosidad antes de guardar.");
    return;
  }

  fetch("guardar.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      texto: input.value,
      semilla: semillaActual
    })
  })
    .then(respuesta => respuesta.text())
    .then(resultado => {
      alert(resultado);
    })
    .catch(error => {
      alert("Error al guardar: " + error);
    });
});
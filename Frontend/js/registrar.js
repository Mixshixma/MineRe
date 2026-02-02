// RECUERDA: Cambia esta URL por la que te dé Render al desplegar
const API_URL = "https://tu-app-en-render.com/app/controllers/AnuncioController.php?action=crear";

document.getElementById("formAnuncio").addEventListener("submit", async (e) => {
    e.preventDefault();

    // Recopilamos los datos de los inputs
    const datos = {
        titulo: document.getElementById("titulo").value,
        categoria: document.getElementById("categoria").value,
        precio: document.getElementById("precio").value,
        estado: document.getElementById("estado").value,
        descripcion: document.getElementById("descripcion").value,
        pais: document.getElementById("pais").value,
        contacto: document.getElementById("contacto").value,
        imagen_url: document.getElementById("imagen_url").value
    };

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        });

        const resultado = await response.json();

        if (resultado.success) {
            // Guardamos el token para que exito.html lo pueda leer
        localStorage.setItem('ultimo_token', resultado.token);
        // Redirigimos a la página de éxito
         window.location.href = "exito.html";
        } else {
            alert("Error: " + resultado.error);
        }
    } catch (error) {
        console.error("Error al enviar:", error);
        alert("No se pudo conectar con el servidor de Render.");
    }
});
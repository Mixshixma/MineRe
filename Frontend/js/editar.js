const API_URL = "https://tu-app-en-render.com/app/controllers/AnuncioController.php";

document.addEventListener("DOMContentLoaded", async () => {
    // 1. Obtener el ID desde la URL
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    
    if (!id) {
        alert("ID no encontrado");
        window.location.href = "carteles.html";
        return;
    }

    // 2. Cargar los datos actuales del anuncio
    try {
        const response = await fetch(`${API_URL}?action=listar`); // Podrías crear una acción 'obtener' específica, pero 'listar' sirve si filtras aquí
        const anuncios = await response.json();
        const anuncio = anuncios.find(a => a.id == id);

        if (anuncio) {
            document.getElementById("anuncio_id").value = anuncio.id;
            document.getElementById("titulo").value = anuncio.titulo;
            document.getElementById("categoria").value = anuncio.categoria;
            document.getElementById("precio").value = anuncio.precio;
            document.getElementById("estado").value = anuncio.estado;
            document.getElementById("descripcion").value = anuncio.descripcion;
            document.getElementById("pais").value = anuncio.pais;
            document.getElementById("contacto").value = anuncio.contacto;
            document.getElementById("imagen_url").value = anuncio.imagen_url;
        }
    } catch (error) {
        console.error("Error al cargar datos:", error);
    }
});

// 3. Manejar el envío del formulario
document.getElementById("formEditar").addEventListener("submit", async (e) => {
    e.preventDefault();

    const datos = {
        id: document.getElementById("anuncio_id").value,
        token_usuario: document.getElementById("token_usuario").value,
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
        const response = await fetch(`${API_URL}?action=actualizar`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datos)
        });

        const res = await response.json();
        if (res.success) {
            alert("¡Actualizado correctamente!");
            window.location.href = "carteles.html";
        } else {
            alert("Error: " + res.error);
        }
    } catch (error) {
        alert("Error de conexión con el servidor.");
    }
});
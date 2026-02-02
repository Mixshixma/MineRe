const API_URL = "https://tu-app-en-render.com/app/controllers/AnuncioController.php";

document.addEventListener("DOMContentLoaded", () => {
    cargarAnuncios();

    // Escuchar el formulario de filtros
    document.getElementById("filterForm").addEventListener("submit", (e) => {
        e.preventDefault();
        const pais = document.getElementById("f_pais").value;
        const cat = document.getElementById("f_cat").value;
        const est = document.getElementById("f_est").value;
        cargarAnuncios(pais, cat, est);
    });
});

async function cargarAnuncios(pais = '', cat = '', est = '') {
    const contenedor = document.getElementById("lista-anuncios");
    const loading = document.getElementById("loading");
    
    try {
        // Construimos la URL con parámetros para el controlador
        const response = await fetch(`${API_URL}?action=listar&f_pais=${pais}&f_cat=${cat}&f_est=${est}`);
        const anuncios = await response.json();

        loading.style.display = 'none';
        contenedor.innerHTML = ""; // Limpiar

        if (anuncios.length === 0) {
            contenedor.innerHTML = `<div class="alert alert-warning">No hay anuncios.</div>`;
            return;
        }

        anuncios.forEach(row => {
            contenedor.innerHTML += `
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 card-custom">
                        <span class="badge bg-primary badge-category">${row.categoria}</span>
                        <img src="${row.imagen_url || 'https://via.placeholder.com/300x200'}" class="card-img-top" style="height: 200px; object-fit: contain;">
                        <div class="card-body">
                            <h5 class="card-title">${row.titulo}</h5>
                            <div class="mb-2">
                                <span class="price-tag">$${parseFloat(row.precio).toFixed(2)}</span>
                                <span class="badge bg-light text-dark border">${row.estado}</span>
                            </div>
                            <p class="card-text text-secondary small">${row.descripcion.substring(0, 100)}...</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 pb-3">
                            <button onclick="borrarConToken(${row.id})" class="btn btn-outline-danger btn-sm w-100">Eliminar</button>
                        </div>
                    </div>
                </div>
            `;
        });
    } catch (error) {
        console.error("Error:", error);
        loading.innerText = "Error al conectar con el servidor.";
    }
}

async function borrarConToken(id) {
    let token = prompt("Introduce el código de seguridad:");
    if (!token) return;

    const response = await fetch(`${API_URL}?action=eliminar`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id, token: token })
    });

    const result = await response.json();
    if (result.success) {
        alert("Eliminado con éxito");
        location.reload();
    } else {
        alert("Error: " + result.error);
    }
}
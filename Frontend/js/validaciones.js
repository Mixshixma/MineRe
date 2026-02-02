document.getElementById('formAnuncio').addEventListener('submit', function(e) {
    let titulo = document.getElementById('titulo').value;
    let precio = document.getElementById('precio').value;
    let contacto = document.getElementById('contacto').value;

    if (titulo.trim() === "" || precio <= 0 || contacto.trim() === "") {
        e.preventDefault(); // Detiene el envío del formulario
        alert("Por favor, completa los campos obligatorios y asegúrate que el precio sea mayor a 0.");
    }
});
<!-- resources/views/juego.blade.php -->

<div id="setup-container">
    <label for="tema">¿Sobre qué quieres jugar?</label>
    <input type="text" id="tema" placeholder="Ej: Películas de ciencia ficción">
    <button id="empezarBtn">Empezar</button>
</div>

<!-- Contenedor del juego, oculto por defecto -->
<div id="juego-container" style="display: none; margin-top: 20px;">
    <h3>Pista: <span id="pistaTexto"></span></h3>
    
    <!-- Aquí se mostrarán los guiones (ej: _ _ _ _ _) -->
    <div id="palabraOculta" style="font-size: 24px; letter-spacing: 5px; margin: 20px 0;"></div>
    
    <!-- Aquí los alumnos pueden construir el teclado virtual posteriormente -->
</div>

<script>
    document.getElementById('empezarBtn').addEventListener('click', function() {
        const tema = document.getElementById('tema').value;
        const btn = this;
        
        // Deshabilitar botón mientras carga
        btn.disabled = true;
        btn.innerText = 'Generando...';

        fetch('/generar-palabra',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                // El token CSRF es obligatorio en Laravel para peticiones POST
                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            },
            body: JSON.stringify({ tema: tema })
        })
        .then(response => response.json())
        .then(data => {
            // Restaurar botón
            btn.disabled = false;
            btn.innerText = 'Empezar';

            // Mostrar el contenedor del juego
            document.getElementById('juego-container').style.display = 'block';

            // Insertar la pista generada por Gemini
            document.getElementById('pistaTexto').innerText = data.pista;

            // Generar los guiones según la longitud devuelta
            const palabraDiv = document.getElementById('palabraOculta');
            palabraDiv.innerHTML = ''; // Limpiamos por si es una partida nueva
            
            for (let i = 0; i < data.longitud; i++) {
                palabraDiv.innerHTML += '_ ';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al contactar con el oráculo de Gemini.');
            btn.disabled = false;
            btn.innerText = 'Empezar';
        });
    });
</script>
<center>
<div class="container mt-5">
        <h1 class="mb-4"><?php echo $titulo ?? '' ?></h1>
        <h3>Paga por lo que usas!</h3>
        <form id="payment-form">
        <div class="mb-3">
            <label for="services" class="form-label">Cantidad de Servicios:</label>
            <input type="number" class="form-control" id="services" min="1" required>
        </div>
        <br>
        <br>
        <div class="mb-3">
            <label for="users" class="form-label">Cantidad de Usuarios:</label>
            <input type="number" class="form-control" id="users" min="1" required>
        </div>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Calcular</button>
        </form>
        <div id="result" class="mt-4"></div>
    </div>
    <script>
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
        resultDiv.innerHTML = `<h3>Total a Pagar: $${total}</h3>`;
    }
    
    // Asignar el evento 'submit' al formulario
    document.getElementById('payment-form').addEventListener('submit', handleSubmit);
    </script>
</center>
<!-- <h1><?php echo $titulo ?></h1> -->
<div class=" contenedor login">
    <?php /* include_once __DIR__ .'/../templates/nombre-sitio.php'; */ ?>
    
        <h2 class="descripcion-pagina">Iniciar Sesión</h2>

        <?php /*include_once __DIR__ .'/../templates/alertas.php';*/ ?>

        <form class="formulario" method="POST" action="/login" >
            <div class="contenido">
                <div class="campo">
                    <label for="email">Email</label>
                    <input 
                        type="email"
                        id="email"
                        placeholder="Ingresar Email"
                        name="email"
                    />
                </div>

                <div class="campo">
                    <label for="password">Password</label>
                    <input 
                        type="password"
                        id="password"
                        placeholder="Ingresar Password"
                        name="password"
                    />
                </div>

                <input type="submit" class="boton" value="Iniciar Sesión">
            </div>    
        
        </form>

        <div class="acciones">
            <a href="/crear-cuenta">¿Aún no tienes una cuenta? Obtener una</a>
            <a href="/olvide">¿Olvidaste tu Password?</a>
        </div>
   </div>
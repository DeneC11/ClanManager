<?php
session_start();
/**
 * genera y almacena un token CSRF en la sesion de usuario
 * @param none
 * @return string el toquen CSRF generado (64 caracteres hexadecimales) y si ya existe lo mantiene
 */
function generarToneknCSRF(){
    if(empty($_SESSION['csrfToken'])){
        $_SESSION['csrfToken']=bin2hex(random_bytes(32));
    }
    return $_SESSION['csrfToken'];
}
// genero token CSRF para usar en formularios
$csrfToken=generarToneknCSRF();
/**
 * valida el token CSRF enviado, comparandolo con el almacenado en la sesion(servidor)
 * utilizamos hash_equals para prevenir ataques timing
 * @param string $token, toquen CSRF recibido
 * @return bool true, si los tokens coinciden. false , en el caso contrario
 */
function validateCSRFToken($token){
    return isset($_SESSION['csrfToken']) && hash_equals($_SESSION['csrfToken'],$token);
}
/**
 * verifica si el usuario ha iniciado sesion y lo redirige al login si NO
 * la urlilizamos en TODAS las paginas privadas
 * @param ninguno
 * @return void no retorna ningun valor, redirige o continua la ejecución
 */
function requireLogin(){
    // alguien ha iniciado sesion?
    if(session_status()===PHP_SESSION_NONE){
        // PHP_SESSION_NONE -> no hay una sesion activa
        // PHP_SESSION_ACTIVE -> hay una sesion activa(ya se llamo al session_start()
        session_start();
    }
    if(!isset($_SESSION['usuario_id'])){
        // usuario no validado, alguien intenta entrar sin validarse
        // setFlatMessage('danger', 'Debes iniciar sesión para acceder a esta página');
        header('Location:login.php');
        exit;
    }
}

/**
 * generar un hash seguro para una contraseña utilizando el algoridmo Argo2id
 * @param string $password, contraseña en texto plano
 * @return string hash generado
 */
function hashPassword(string $password):string{
    $options =[
        'memory cost' => 1<<16, //coge el 1 y desplázalo 16 bits a la izq
        // 65.536 KB = 64 MB
        'time_cost'   => 2 ,  // número de iteraciones
        'threads'     => 1    // hilos (threads)  multiprocesador
    ];
    return password_hash($password, PASSWORD_ARGON2ID, $options);
}
?>
<script>
/**
 * validacion de formulario unico de bootsrap
 * @param nothing, se aplica automaticamente a un formulario con una clase '.needs-validation'
 * @return nothing 
 */
function aplicarValidacionBootstrap() {
    'use strict';
    const form = document.querySelector('.needs-validation');
    if (!form) return;
    
    form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
}
</script>
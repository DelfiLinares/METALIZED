<?php
session_start(); // Asegúrate de iniciar la sesión para destruirla
session_unset(); // Elimina todas las variables de sesión
session_destroy(); 
echo "Sesión cerrada";
?>

<?php
$host = "127.0.0.1"; 
$port = 12345;       

// Crear el socket
$client_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($client_socket === false) {
    echo "Error al crear el socket: " . socket_strerror(socket_last_error()) . "\n";
    exit();
}

// Conectar al servidor
$result = socket_connect($client_socket, $host, $port);
if ($result === false) {
    echo "Error al conectar: " . socket_strerror(socket_last_error($client_socket)) . "\n";
    exit();
}

// Recibir el mensaje del servidor
$response = socket_read($client_socket, 1024);
echo "Respuesta del servidor: $response\n";

// Enviar un mensaje al servidor
$message = "¡Hola servidor, soy el cliente!\n";
socket_write($client_socket, $message, strlen($message));

// Cerrar el socket
socket_close($client_socket);
?>
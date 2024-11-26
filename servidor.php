<?php
$host = "127.0.0.1"; 
$port = 12345;      

$server_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($server_socket === false) {
    echo "Error al crear el socket: " . socket_strerror(socket_last_error()) . "\n";
    exit();
}

$result = socket_bind($server_socket, $host, $port);
if ($result === false) {
    echo "Error al enlazar el socket: " . socket_strerror(socket_last_error($server_socket)) . "\n";
    exit();
}

$result = socket_listen($server_socket, 5);
if ($result === false) {
    echo "Error al escuchar el socket: " . socket_strerror(socket_last_error($server_socket)) . "\n";
    exit();
}

echo "Esperando conexiones en $host:$port...\n";

$client_socket = socket_accept($server_socket);
if ($client_socket === false) {
    echo "Error al aceptar la conexión: " . socket_strerror(socket_last_error($server_socket)) . "\n";
    exit();
}

echo "Cliente conectado.\n";

$message = "¡Hola desde el servidor!\n";
socket_write($client_socket, $message, strlen($message));

$input = socket_read($client_socket, 1024);
echo "Mensaje recibido del cliente: $input\n";

socket_close($client_socket);
socket_close($server_socket);
?>
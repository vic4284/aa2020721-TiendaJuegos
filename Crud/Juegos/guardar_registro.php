<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];

    // Crear conexión
    $conn = new mysqli("localhost", "root", "", "registro");

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Consulta SQL para insertar en la tabla "juegos"
    $sql = "INSERT INTO juegos (id, nombre, precio) VALUES ('$id', '$nombre', '$precio')";

    if ($conn->query($sql) === true) {
        // Redirigir al index con mensaje de éxito
        header("Location: index.php?message=Registro exitoso");
    } else {
        // Mostrar error si la consulta falla
        echo "Error al registrar el juego: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>

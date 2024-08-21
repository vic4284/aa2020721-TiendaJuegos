<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];

    // Crear conexión
    $conn = new mysqli("localhost", "root", "", "registro");

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Consulta SQL para insertar en la tabla "juegos" usando una sentencia preparada
    $sql = "INSERT INTO juegos (nombre, precio) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sd", $nombre, $precio); // 's' para string (nombre), 'd' para double (precio)
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Redirigir al index con mensaje de éxito
            header("Location: index.php?message=Registro exitoso");
        } else {
            echo "Error al registrar el juego: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];

    $conn = new mysqli("localhost", "root", "", "registro");

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    $sql = "UPDATE juegos SET nombre = ?, precio = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sdi", $nombre, $precio, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: index.php?message=Actualización exitosa");
        } else {
            echo "Error al actualizar el registro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la sentencia: " . $conn->error;
    }

    $conn->close();
}
?>

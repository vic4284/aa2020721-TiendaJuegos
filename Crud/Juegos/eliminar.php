<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    
    $conn = new mysqli("localhost", "root", "", "registro");

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    $sql = "DELETE FROM juegos WHERE id = $id";

    if ($conn->query($sql) === true) {
        header("Location: index.php");
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    $conn->close();
}
?>

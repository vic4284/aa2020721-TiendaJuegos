<?php
if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    if ($id <= 0) {
        echo "ID no válido.";
        exit;
    }

    $conn = new mysqli("localhost", "root", "", "registro");

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM juegos WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Mostrar formulario para actualizar
            ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Actualizar Juego</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                        text-align: center;
                    }

                    h1 {
                        color: #333;
                    }

                    form {
                        max-width: 300px;
                        margin: 20px auto;
                        background: #f5f5f5;
                        padding: 20px;
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }

                    label {
                        display: block;
                        margin-bottom: 5px;
                        font-weight: bold;
                    }

                    input {
                        width: 100%;
                        padding: 8px;
                        margin-bottom: 10px;
                        box-sizing: border-box;
                    }

                    input[type="submit"] {
                        background-color: #40C815;
                        color: #fff;
                        cursor: pointer;
                        border: none;
                        padding: 10px;
                        border-radius: 5px;
                    }

                    input[type="submit"]:hover {
                        background-color: #0056b3;
                    }
                </style>
            </head>
            <body>
                <h1>Actualizar Juego</h1>
                <form method="post" action="guardar_actualizacion.php">
                    <label>ID:</label>
                    <input type="number" name="id" value="<?php echo $row['id']; ?>" readonly>
                    <br>
                    <label>Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required>
                    <br>
                    <label>Precio:</label>
                    <input type="number" step="0.01" name="precio" value="<?php echo $row['precio']; ?>" required>
                    <br>
                    <input type="submit" value="Guardar Actualización">
                </form>
            </body>
            </html>
            <?php
        } else {
            echo "No se encontró el registro con el ID proporcionado.";
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la sentencia: " . $conn->error;
    }

    $conn->close();
} else {
    echo "ID no proporcionado.";
}
?>

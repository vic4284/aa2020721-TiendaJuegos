<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Resultados de Búsqueda</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $busqueda = $_POST["busqueda"];

        $conn = new mysqli("localhost", "root", "", "registro");

        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        // Si el valor de búsqueda es un número, se asume que está buscando por precio
        if (is_numeric($busqueda)) {
            $sql = "SELECT * FROM juegos WHERE precio LIKE '%$busqueda%'";
        } else {
            $sql = "SELECT * FROM juegos WHERE nombre LIKE '%$busqueda%'";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Fecha de Registro</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["precio"] . "</td>";
                echo "<td>" . $row["fecha_registro"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron registros coincidentes.";
        }

        $conn->close();
    }
    ?>

</body>
</html>

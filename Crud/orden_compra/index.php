<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Juegos y Órdenes de Compra</title>
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

        a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #40C815;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }

        .section {
            margin-bottom: 40px;
        }

        .actions {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

    <div class="section">
        <h1>Registro de Juegos</h1>
        <a href="registrar.php">Agregar Juego</a>
        <a href="buscar.php">Buscar Juego</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli("localhost", "root", "", "registro");

                if ($conn->connect_error) {
                    die("Error en la conexión a la base de datos: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM juegos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nombre"] . "</td>";
                        echo "<td>" . $row["precio"] . "</td>";
                        echo "<td>" . $row["fecha_registro"] . "</td>";
                        echo "<td><a href='eliminar.php?id=" . $row["id"] . "'>Eliminar</a></td>";
                        echo "<td><a href='actualizar.php?id=" . $row["id"] . "'>Actualizar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay registros de juegos.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <div class="section">
        <h1>Órdenes de Compra</h1>
        <a href="registrar.php">Realizar Nueva Compra</a>
        <table>
            <thead>
                <tr>
                    <th>ID Orden</th>
                    <th>Juego</th>
                    <th>Nombre Cliente</th>
                    <th>Cantidad</th>
                    <th>Precio Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli("localhost", "root", "", "registro");

                if ($conn->connect_error) {
                    die("Error en la conexión a la base de datos: " . $conn->connect_error);
                }

                $sql = "SELECT oc.id, j.nombre AS juego, oc.nombre_cliente, oc.cantidad, oc.precio_total, oc.fecha
                        FROM orden_compras oc
                        INNER JOIN juegos j ON oc.id_juego = j.id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["juego"] . "</td>";
                        echo "<td>" . $row["nombre_cliente"] . "</td>";
                        echo "<td>" . $row["cantidad"] . "</td>";
                        echo "<td>$" . $row["precio_total"] . "</td>";
                        echo "<td>" . $row["fecha"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay órdenes de compra registradas.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>

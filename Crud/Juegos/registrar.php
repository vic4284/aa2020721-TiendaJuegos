<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Juego</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
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
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Registrar Nuevo Juego</h1>
    <form method="post" action="guardar_registro.php">
        <label>ID:</label>
        <input type="number" name="id" required>
        <br>
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" required>
        <br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>

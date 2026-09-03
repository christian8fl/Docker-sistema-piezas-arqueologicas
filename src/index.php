<?php
$host = getenv('DB_HOST') ?: 'db';
$db   = getenv('DB_NAME') ?: 'patrimonio_db';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: 'rootpassword';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $stmt = $pdo->query("SELECT * FROM piezas_arqueologicas");
    $piezas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Patrimonio Cultural - Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2 class="mb-4">Gestión de Hallazgos Arqueológicos</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre/Objeto</th>
                <th>Sitio / Ubicación</th>
                <th>Coordenadas</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($piezas as $pieza): ?>
            <tr>
                <td><?= $pieza['id'] ?></td>
                <td><?= htmlspecialchars($pieza['nombre']) ?></td>
                <td><?= htmlspecialchars($pieza['sitio']) ?></td>
                <td><?= htmlspecialchars($pieza['coordenadas']) ?></td>
                <td><?= $pieza['fecha_hallazgo'] ?></td>
                <td><?= $pieza['estado_conservacion'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
<?php
$host = getenv('DB_HOST') ?: 'db';
$db   = getenv('DB_NAME') ?: 'patrimonio_db';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: 'rootpassword';

try {
    // Se añade utf8mb4 para corregir las tildes y caracteres especiales
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $stmt = $pdo->query("SELECT * FROM piezas_arqueologicas");
    $piezas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error de conexión: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrimonio Cultural - Registro de Hallazgos</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <!-- Barra de navegación institucional -->
    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <span class="navbar-brand mb-0 h1">
                <i class="bi bi-bank"></i> Dirección Nacional de Patrimonio Cultural
            </span>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold text-dark">Gestión de Hallazgos Arqueológicos</h2>
                <p class="text-muted">Inventario y control de piezas registradas en exploraciones de campo.</p>
            </div>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i> <?= $error ?>
            </div>
        <?php endif; ?>

        <!-- Tarjeta contenedora de la tabla -->
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre / Objeto</th>
                                <th>Sitio / Ubicación</th>
                                <th>Coordenadas</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($piezas)): ?>
                                <?php foreach ($piezas as $pieza): ?>
                                <tr>
                                    <td><span class="badge bg-secondary">#<?= $pieza['id'] ?></span></td>
                                    <td class="fw-bold text-primary"><?= htmlspecialchars($pieza['nombre']) ?></td>
                                    <td><?= htmlspecialchars($pieza['sitio']) ?></td>
                                    <td><code><?= htmlspecialchars($pieza['coordenadas']) ?></code></td>
                                    <td><?= $pieza['fecha_hallazgo'] ?></td>
                                    <td>
                                        <?php 
                                            $estado = $pieza['estado_conservacion'];
                                            $badgeClass = 'bg-secondary';
                                            if ($estado === 'Excelente') $badgeClass = 'bg-success';
                                            elseif ($estado === 'Regular') $badgeClass = 'bg-warning text-dark';
                                            elseif ($estado === 'Fragmentado') $badgeClass = 'bg-danger';
                                        ?>
                                        <span class="badge <?= $badgeClass ?> px-3 py-2"><?= $estado ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No hay registros de piezas arqueológicas disponibles.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
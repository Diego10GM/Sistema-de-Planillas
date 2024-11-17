<?php
include '../../php/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
</head>
<body>
    <?php include '../../menu.php'; ?>

    <div class="container mt-5 pt-5" style="margin-left: 270px;">
        <div class="main-container">
            <h2 class="main-title">Ventas Registradas</h2>
            
            <!-- Botón para agregar nueva venta -->
            <a href="registrar_venta.php" class="btn btn-agregar mb-3">
                <i class="fas fa-plus"></i> Agregar Nueva Venta
            </a>

            <!-- Tabla de ventas -->
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Empleado</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th>Comisión</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Aquí irá tu código PHP para mostrar las ventas desde la base de datos
                        $sql = "SELECT v.*, e.nombre FROM ventas v 
                               JOIN empleados e ON v.empleado_id = e.id 
                               ORDER BY v.fecha DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row['id']."</td>";
                                echo "<td>".$row['nombre']."</td>";
                                echo "<td>Q ".number_format($row['monto'], 2)."</td>";
                                echo "<td>".date('d/m/Y', strtotime($row['fecha']))."</td>";
                                echo "<td>Q ".number_format($row['comision'], 2)."</td>";
                                echo "<td>
                                        <button class='btn btn-editar btn-sm' onclick='editarVenta(".$row['id'].")'>Editar</button>
                                        <button class='btn btn-eliminar btn-sm' onclick='eliminarVenta(".$row['id'].")'>Eliminar</button>
                                     </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No hay ventas registradas</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editarVenta(id) {
            window.location.href = 'editar_venta.php?id=' + id;
        }

        function eliminarVenta(id) {
            if(confirm('¿Está seguro de que desea eliminar esta venta?')) {
                window.location.href = 'eliminar_venta.php?id=' + id;
            }
        }
    </script>
</body>
</html>
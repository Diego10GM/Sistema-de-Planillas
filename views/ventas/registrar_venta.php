<?php
include '../../php/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
</head>
<body>
    <?php include '../../menu.php'; ?>

    <div class="container mt-5 pt-5" style="margin-left: 270px;">
        <div class="main-container">
            <h2 class="main-title">Registrar Nueva Venta</h2>

            <div class="form-container">
                <form action="../../php/procesar_venta.php" method="POST">
                    <div class="mb-3">
                        <label for="empleado" class="form-label">Empleado</label>
                        <select class="form-select" id="empleado" name="empleado" required>
                            <option value="">Seleccione un empleado</option>
                            <?php
                            $sql = "SELECT id, nombre FROM empleados WHERE activo = 1 ORDER BY nombre";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="monto" class="form-label">Monto de la Venta</label>
                        <input type="number" class="form-control" id="monto" name="monto" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-agregar">Registrar Venta</button>
                    <a href="ver_ventas.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
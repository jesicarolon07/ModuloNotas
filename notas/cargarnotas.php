<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Nota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/styletablas.css">
</head>

<body>
    <?php
        require('../conexion/conexion.php');
        include("../header/sidebar.php");
        include("../header/headernosearch.php");

        if(!$conn){
            die("Error: No se pudo conectar a la Base de Datos");
        }

        $queryM ="SELECT id_materia, denominacion_materia FROM materia";
        $resultM = mysqli_query($conn, $queryM);
        $queryE ="SELECT id_estudiante, nombres, apellidos FROM estudiantes";
        $resultE = mysqli_query($conn, $queryE);
    ?>
    <div class="contenedor">
        <div class="container mt-4">
            <h2></h2>
            <form>
                <div>
                    <label></label>
                    <select>
                        <option></option>

                    </select>
                </div>

                <div class="mb-3">
                    <label for="materia">Seleccionar Materia</label>
                    <select id="materia" name="materia" class="form-select" aria-label="Disabled select example" disabled>
                        <option value="">Seleccionar la materia del estudiante</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="estudiante">Seleccionar Estudiante</label>
                    <select id="estudiante" name="estudiante" class="form-select" aria-label="Disabled select example" disabled>
                        <option value="">Seleccionar al estudiante</option>
                    </select>
                </div>

                <div>
                    <label></label>
                    <input>
                </div>

                <div>
                    <label></label>
                    <select class="form-select" aria-label="Disabled select example" disabled>
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div>
                    <label></label>
                    <select class="form-select" aria-label="Disabled select example" disabled>
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div>
                    <label></label>
                    <select class="form-select" aria-label="Disabled select example" disabled>
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
              
            </form>
        </div>
    </div>
</body>
</html>
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

                <div class="mb-3">
                    <label for="nota">Nota</label>
                    <input type="number" id="nota" step="0.1" min="0" max="10" required class="form-control" >
                </div>

                <div class="mb-3">
                    <label for="tipo_nota"> Tipo de Nota</label>
                    <select id="tipo_nota" name="tipo_nota" class="form-select" aria-label="Disabled select example" disabled>
                        <option value="">Seleccionar tipo de nota</option>
                        <option value="trabajo_practico">Trabajo practico</option>
                        <option value="parcial">Parcial</option>
                        <option value="oral">Oral</option>
                    </select>
                </div>

                <div>
                    <label for="anio">Año</label>
                    <select id="anio" name="anio"  class="form-select" aria-label="Disabled select example" disabled>
                      
                        <option value="">Seleccionar tipo de año</option>
                        <option value="primer_anio">Primer Año</option>
                        <option value="segundo_anio">Segundo Año</option>
                        <option value="tercer_anio">Segundo Año</option>
                    </select>
                </div>

                <div>
                    <label for="periodo">Periodo</label>
                    <select id="periodo" name="periodo" class="form-select" aria-label="Disabled select example" disabled>

                        <option value="">Seleccionar periodo</option>
                        <option value="cuatrimestral1">Primer Cuatrimestre</option>
                        <option value="cuatrimestral2">Segundo Cuatrimestre</option>
                        <option value="cuatrimestral3">Tercer Cuatrimestre</option>
                        <option value="bimestral1">Primer Bimestre</option>
                        <option value="bimestral2">Segundo Bimestre</option>
                        <option value="bimestral3">Tercer Bimestre</option>
                        <option value="bimestral4">Cuarto Bimestre</option>
                        <option value="semestral1">Primer Semestre</option>
                        <option value="semestral2">Segundo Semestre</option>
                        <option value="semestral3">Tercer Semestre</option>
                    </select>
                </div>
                <button></button>
                <a></a>
              
            </form>
        </div>
    </div>
</body>
</html>
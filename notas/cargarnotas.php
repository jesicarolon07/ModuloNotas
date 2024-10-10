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

<style>
    .contenedor{
        max-width: 800px;
        margin:  auto;
        display: block;
        padding:50px; 
        background-color: #f3f5f8;

    }
    .texto3{
       
        padding:5px; 
        text-align:center;
    }
    .estilo{
            position: absolute;
            top: 30%;
            left: 20%;
            transform: translate(-50%, -50%);
           display: flex;
          justify-content: center;
          font-size: 10px;
          color: #0091FF;
        }
        .text{
            font-size: 4em;
            margin: 0 5px;
            animation: fadeIn 1.5s forwards;
        }
        .text1 { animation-delay: 0s; }
        .text2 { animation-delay: 0.2s; }
        .text3 { animation-delay: 0.4s; }
        .text4 { animation-delay: 0.6s; }
        .text5 { animation-delay: 0.8s; }
        .text6 { animation-delay: 1s; }
        .text7 { animation-delay: 1.2s; }
        .text8 { animation-delay: 0.8s; }
        .text9 { animation-delay: 1s; }
        .text10 { animation-delay: 1.2s; }
        
    @keyframes fadeIn {
      0% { opacity: 0; transform: scale(0.5); }
      100% { opacity: 1; transform: scale(1); }
    }

    .cuadrado-gris {
            width: 1150px; 
            height: 10px; 
            background-color: #0091FF; 
            margin: 20px auto; 
            
        }
</style>

<body>
    <?php
        require('../conexion/conexion.php');  
        include("../header/nuevo-header.php");


        if(!$conn){
            die("Error: No se pudo conectar a la Base de Datos");
        }

        
        $queryM ="SELECT id_materia, denominacion_materia FROM materia";
        $resultM = mysqli_query($conn, $queryM);
        $queryE ="SELECT id_estudiante, nombres, apellidos FROM estudiantes";
        $resultE = mysqli_query($conn, $queryE);
    ?>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $materia = $_POST['materia'];
            $estudiante = $_POST['estudiante'];
            $anio = $_POST['anio'];
            $nota = $_POST['nota'];
            $tipo_nota = $_POST['tipo_nota'];
            $periodo = $_POST['periodo'];
            
            if(empty($materia) || empty($estudiante) || empty($anio) || empty($nota) || empty($tipo_nota) || empty($periodo)){
                die("Error: Todos los campos son obligatorios" );

            }
            
            $query ="INSERT INTO notas (id_materia, id_estudiante, anio, nota, tipo_nota, periodo) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param( $stmt, 'iissss',$materia, $estudiante, $anio, $nota, $tipo_nota, $periodo);
            if(mysqli_stmt_execute($stmt)){
                echo "Los datos se guardaron correctamente";
            }else{
                echo "Error al guardart datos". mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);

    ?>
    <div class="estilo">
        <?php
        $texts = ['T', 'a', 'b', 'l', 'a', 'N', 'o','t','a','s'];
        foreach ($texts as $index => $char): ?>
        <div class="text text<?php echo $index + 1; ?>">
            <?php echo $char; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <br>  <br>  <br>  <br> 
    <div class="cuadrado-gris"></div>
    <br>   
    <div class="contenedor">
        <div class="container mt-4">
            
            <form method="POST" action="cargarnotas.php">

                <div class="mb-3">
                    <div class="texto3"><h3> Cargar Notas</h3></div>
                    <br><br>
                    <label for="materia">Seleccionar Materia</label>
                    <select id="materia" name="materia" required class="form-control">
                        <option value="">Seleccionar la materia del estudiante</option>
                        <?php 
                            if($resultM && mysqli_num_rows($resultM) > 0){
                                while($row= mysqli_fetch_assoc($resultM)){
                                    echo "<option value='". $row['id_materia']. "'>" . $row['denominacion_materia']. "</option>";
                                }
                            }else{
                                echo "<option value=''>No hay materias disponibles</option>";
                            }
                        ?>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="estudiante">Seleccionar Estudiante</label>
                    <select id="estudiante" name="estudiante" required class="form-control" >
                        <option value="">Seleccionar al estudiante</option>

                        <?php
                        
                            if($resultE && mysqli_num_rows($resultE) > 0 ){
                                while ($row = mysqli_fetch_assoc($resultE)){
                                    echo "<option value='" . $row['id_estudiante'] . "'>" . $row['nombres'] . " " . $row['apellidos'] . "</option>";
                                }
                            } else{
                                echo "<option value=''>No hay estudiantes disponibles</option>";
                            }
                    
                        
                        ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="nota">Nota</label>
                    <input type="number" id="nota" name="nota" step="0.1" min="0" max="10" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="tipo_nota"> Tipo de Nota</label>
                    <select id="tipo_nota" name="tipo_nota" required class="form-control">
                        <option value="">Seleccionar tipo de nota</option>
                        <option value="trabajo_practico">Trabajo practico</option>
                        <option value="parcial">Parcial</option>
                        <option value="oral">Oral</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="anio">Año</label>
                    <select id="anio" name="anio"  required class="form-control">
                      
                        <option value="">Seleccionar tipo de año</option>
                        <option value="primer_anio">Primer Año</option>
                        <option value="segundo_anio">Segundo Año</option>
                        <option value="tercer_anio">Tercer Año</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="periodo">Periodo</label>
                    <select id="periodo" name="periodo"  required class="form-control">

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
                <button type="submit" class="btn btn-info  mt-3">Enviar Notas</button>
                <a href="./tablanotas.php" class="btn btn-info  mt-3">Volver a Listado</a>
              
            </form>
        </div>
    </div>
    <br>

    <script>
        document.addEventListener ('keydown', function (e) ){
            if(e.key === 'Enter'){
                e.preventDefault();
                const formulario = e.target.form;
                const array = Array.prototype.indexOf.call(formulario, e.target);
                const nextElement = formulario.elements[array+1];

                if(nextElement){
                    nextElement.focus();
                }
               

            }

        }
     
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=1, initial-scale=1.0">
        <title>ModuloNotas-ISFT 225</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link rel="stylesheet" href="../styles/style.css">
        <link rel="stylesheet" href="../styles/styletablas.css">
    </head>
    <?php
    include "../variablesPath/variablesPath.php";
    require(rutas::$pathConetion);
    include(rutas::$pathNuevoHeader);
    ?>
    <style>
    .table th, td {
        font-size: 16px;
        background-color:  #ddd;
        text-align: center;
    }
    .table th{
        border: #acabb0 2px solid;
    }
    .boton{
        font-size: 16px;
        border: none; 
        color: #160f6b; 
        padding: 5px 15px; 
        cursor: pointer; 
        border-radius: 7px; 
        border: #160f6b 2px solid;
    }
    .boton:hover{
        background-color:  #ddd;
        color: #160f6b;
    }
    .thead {
        color: #160f6b;
    }
    .botones{
        text-align: center ;
        display: flex;
        justify-content: flex-end;
    }
    .contenedor{
        max-width: 1100px;
        float: right;
    }
    .estilo{
        position: relative; 
        display: flex;
        justify-content: start;
        align-items: center;
        flex-wrap: wrap; 
        font-size: 10px;
        color: black;
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
    </style>
    
    <body>
        <?php
          
           
           $busqueda= "";
           $result = null;

           if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $filtrar = $_POST['filtrar'];
            $busqueda = strtolower($_POST['busqueda']);

            switch($filtrar){
                case 'apellidos':
                $query = "SELECT 
                n.id_nota, 
                n.anio,
                n.nota, 
                n.tipo_nota, 
                n.periodo, 
                m.denominacion_materia, 
                e.nombres,
                e.dni_estudiante, 
                e.apellidos 
                FROM notas n
                JOIN materia m ON n.id_materia = m.id_materia
                JOIN estudiantes e ON n.id_estudiante = e.id_estudiante
                WHERE LOWER(e.apellidos) LIKE '%$busqueda%' ";
                
                break;
                case 'Periodo':
                    $query = "SELECT 
                    n.id_nota, 
                    n.anio,
                    n.nota, 
                    n.tipo_nota, 
                    n.periodo, 
                    m.denominacion_materia, 
                    e.nombres, 
                    e.dni_estudiante, 
                    e.apellidos 
                    FROM notas n
                    JOIN materia m ON n.id_materia = m.id_materia
                    JOIN estudiantes e ON n.id_estudiante = e.id_estudiante
                    WHERE LOWER( n.periodo) LIKE '%$busqueda%' ";
                    break;
                case'Materias':
                    $query = "SELECT 
                    n.id_nota, 
                    n.anio,
                    n.nota, 
                    n.tipo_nota, 
                    n.periodo, 
                    m.denominacion_materia, 
                    e.nombres, 
                    e.dni_estudiante, 
                    e.apellidos 
                    FROM notas n
                    JOIN materia m ON n.id_materia = m.id_materia
                    JOIN estudiantes e ON n.id_estudiante = e.id_estudiante
                    WHERE LOWER(m.denominacion_materia) LIKE '%$busqueda%' ";
                    break;
                case 'Año':
                    $query = "SELECT 
                    n.id_nota, 
                    n.anio,
                    n.nota, 
                    n.tipo_nota, 
                    n.periodo, 
                    m.denominacion_materia, 
                    e.nombres, 
                    e.dni_estudiante, 
                    e.apellidos 
                    FROM notas n
                    JOIN materia m ON n.id_materia = m.id_materia
                    JOIN estudiantes e ON n.id_estudiante = e.id_estudiante
                    WHERE LOWER(n.anio) LIKE '%$busqueda%' ";
                    break;

                default:
                $query = "SELECT 
                n.id_nota, 
                n.anio,
                n.nota, 
                n.tipo_nota, 
                n.periodo, 
                m.denominacion_materia, 
                e.nombres, 
                e.dni_estudiante, 
                e.apellidos 
                FROM notas n
                JOIN materia m ON n.id_materia = m.id_materia
                JOIN estudiantes e ON n.id_estudiante = e.id_estudiante";
                break;
            }
            $result = mysqli_query($conn, $query);
           }else{
            $query = "SELECT 
            n.id_nota, 
            n.anio,
            n.nota, 
            n.tipo_nota, 
            n.periodo, 
            m.denominacion_materia, 
            e.nombres, 
            e.dni_estudiante, 
            e.apellidos 
            FROM notas n
            JOIN materia m ON n.id_materia = m.id_materia
            JOIN estudiantes e ON n.id_estudiante = e.id_estudiante";
           
            $result = mysqli_query($conn, $query);

           }
          
   
          
        ?>

        <div class="container mt-4">
            <div class="estilo">
                <?php
                $texts = ['T', 'a', 'b', 'l', 'a', 'N', 'o','t','a','s'];
                foreach ($texts as $index => $char): ?>
                <div class="text text<?php echo $index + 1; ?>">
                <?php echo $char; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <br><hr style="border: none; height: 2px; background-color: black; width: 105%; "> <br>
      



        <div class="contenedor">
            <br><br><br> 
            <div class="cuadrado-gris"></div><br><br>  

            <form method="POST" action="./tablanotas.php">

                <div class="d-flex gap-1">
                    <input id="busqueda" name="busqueda" type="text" class="form-control" placeholder="Búsqueda">
                    <select name="filtrar" class="form-select">
                        <option value="apellidos">Apellidos</option>
                        <option value="Periodo">Periodo</option>
                        <option value="Materias">Materias</option>
                        <option value="Año">Año</option></select>
                        <button type="submit" class="boton">Buscar</button>
                </div>
            </form><br></br>

            <a href="./tablanotas.php" class="boton  mt-3">volver a Listado</a>
            <a href="./cargarnotas.php" class="boton  mt-3">Ingresar Nueva Nota</a></br></br><br>
            <form method="POST" action="tablanotas.php">
                <table class="table table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID Notas</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Año</th>
                            <th>Materias</th>
                            <th>Tipo de Nota</th>
                            <th>Nota</th>
                            <th>Periodo</th>
                            <th>BarraProgreso</th>
                            <!--  <th>Promedio </th> -->
                            <th>Accion</th>
                                    
                        </tr> 
                    </thead> 
                        

                        <?php 
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {?>

                                    <?php

                                    $nota= $row['nota'];
                                    $porcentaje = ($nota/10)*100;

                                    if($nota >= 9){

                                        $color = 'bg-success';

                                     } elseif ($nota >= 7){

                                         $color = 'bg-info';

                                     }elseif ($nota >= 5){

                                         $color = 'bg-warning';

                                     }else{

                                         $color = 'bg-danger';
                                     }
                        
                                    ?>

                                    <tr>
                                        <td><?php echo $row['id_nota']; ?></td>
                                        <td><?php echo $row['nombres']; ?></td>
                                        <td><?php echo $row['apellidos']; ?></td>
                                        <td><?php echo $row['anio']; ?></td>
                                        <td><?php echo $row['denominacion_materia']; ?></td>
                                        <td><?php echo $row['tipo_nota'];?></td>
                                        <td><?php echo $row['nota'];?></td>
                                        <td><?php echo $row['periodo']; ?></td>
                                        <td> 
                                            <div class="progress" role="progressbar" aria-label="Barra de progreso de la nota" aria-valuenow="<?php echo $porcentaje; ?>" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar progress-bar-striped <?php echo $color; ?>" style="width: <?php echo $porcentaje; ?>%"></div>
                                            </div> 
                                        </td>
                                        <!-- <td><?php /*echo $row['promedio'];*/ ?></td> -->
                                        <td><button type="submit" class="boton  mt-3">Editar</button></td>
                                    </tr>
                            
                        <?php } }} ?> 
                </table>    
            </form>
    
        

        </div>
           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


    </body>
</html>
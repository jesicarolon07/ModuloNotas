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
    <style>
        .table th, td {
            font-size: 16px;
        }
      
        .boton{
            font-size: 16px;
            border: none; 
            color: #fff; 
            padding: 12px 20px; 
            cursor: pointer; 
            border-radius: 5px; 
            background-color:  #0091FF;
        }
        .boton:hover{
            background-color:  #ddd;
            color: black;
           
        }
       
        .contenedor{
            max-width: 1100px;
            float: right;
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

           
           $busqueda= "";
           $result = null;

           if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $filtrar = $_POST['filtrar'];
            $busqueda = strtolower($_POST['busqueda']);

            switch($filtrar){
                case 'Apellido':
                $query = "SELECT 
                n.id_nota, 
                n.anio,
                n.nota, 
                n.tipo_nota, 
                n.periodo, 
                m.denominacion_materia, 
                e.nombres, 
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
           

            <div class="contenedor">
               <br>  <br>  <br> 
               <div class="cuadrado-gris"></div>
               <br>  <br>  
                <form method="POST" action="./tablanotas.php">

               
                    <div class="d-flex gap-1">
                        <input id="busqueda" name="busqueda" type="text" class="form-control" placeholder="Búsqueda">
                        <select name="filtrar" class="form-select">
                            <option value="Apellidos">Apellidos</option>
                            <option value="Periodo">Periodo</option>
                            <option value="Materias">Materias</option>
                            <option value="Año">Año</option>
                        </select>
                        <button type="submit" class="boton">Buscar</button>
                    </div>
                   
                  

                </form>
                <br></br>
                <a href="./tablanotas.php" class="boton  mt-3">volver a Listado</a>
                <a href="./cargarnotas.php" class="boton  mt-3">Ingresar Nueva Nota</a>
                </br></br><br>

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
           
        </div>
                                
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


    </body>
</html>
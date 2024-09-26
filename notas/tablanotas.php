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
        .btn{
            font-size: 16px;
        }
        .contenedor{
            max-width: 850px;
            float: right;
        }
    
    </style>
    
    <body>
        <?php
           require('../conexion/conexion.php');
           include("../header/sidebar.php");
           include('../header/headernosearch.php');

           
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
            JOIN estudiantes e ON n.id_estudiante = e.id_estudiante
           
            $result = mysqli_query($conn, $query);

           }
          
   
          
        ?>

        <div class="container mt-4">

            <div class="contenedor">
                <h2>Tabla de Notas</h2>
                <form method="POST" action="./tablanotas.php">
                    <div class="d-flex gap-1">
                        <input id="busqueda" name="busqueda" type="text" class="form-control bg-transparent focus-ring-none border-0 p-2" placeholder="Busqueda" aria-label="Example text with button addon" aria-describedby="button-addon1">            
                        <select class="form-select form-select-lg mb-3" name="filtrar" id="filtrar" aria-label="filtro">
                            <option value="Apellidos">Apellidos</option>
                            <option value="Periodo">Periodo</option>
                            <option value="Materias">Materias</option>
                            <option value="Año">Año</option>
                        </select>
                        <button type="submit" class="btn btn-primary custom-button m-2 mt-4">Buscar</button>

                    </div>
                </form>


                <a href="./tablanotas.php" class="btn btn-primary custom-button m-2 mt-4">volver a Listado</a>
                <a href="./nota5.php" class="btn btn-primary custom-button mt-3">Ingresar Nueva Nota</a>
                </br></br>  

                <form method="POST" action="tablanotas.php">
                    <table class="table table-bordered">
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
                              <!--  <th>Promedio </th> -->
                                <th>Accion</th>
                                    
                            </tr> 
                        </thead> 
                        
                        <?php 
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {?>
                                    <tr>
                                        <td><?php echo $row['id_nota']; ?></td>
                                        <td><?php echo $row['nombres']; ?></td>
                                        <td><?php echo $row['apellidos']; ?></td>
                                        <td><?php echo $row['anio']; ?></td>
                                        <td><?php echo $row['denominacion_materia']; ?></td>
                                        <td><?php echo $row['tipo_nota'];?></td>
                                        <td><?php echo $row['nota'];?></td>
                                        <td><?php echo $row['periodo']; ?></td>
                                        <!-- <td><?php /*echo $row['promedio'];*/ ?></td> -->
                                        <td><button type="submit" class="btn btn-primary custom-button m-2 mt-4">Editar</button></td>
                                    </tr>
                        <?php } }}?> 

                    </table>    
                </form>
    
        

            </div>
        </div>


    </body>
</html>
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
    /*   n.promedio,  */ 
            $result = mysqli_query($conn, $query);
        ?>

        <div class="container mt-4">

            <div class="contenedor">
                <h2>Tabla de Notas</h2>
                <div class="Buscador">
                    <ul class="navbar-nav mt-3 ">
                        <li class="Select">
                            <select class="form-select form-select-lg mb-3" name="filtrar" id="filtrar" aria-label="filtro">
                                <option class="disabled" selected>Filtro</option>
                                <option value="Nombre">Apellidos</option>
                                <option value="Modalidad">Periodo</option>
                                <option value="Estado">Materias</option>
                                <option value="anio">Año</option>
                                
                            </select>
                        </li>

                        <li>
                            <div class="Button_Busqueda">
                                <div class="input-group">
                               
                                    <input id="busqueda" name="busqueda" type="text" class="form-control bg-transparent focus-ring-none border-0 p-2" placeholder="Busqueda" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                    <button class="bg-light border-0" type="submit" id="button-addon1">
                                        <svg class="mx-1" width="23" height="23" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.2287 10.3421C13.197 9.02083 13.6307 7.38264 13.443 5.7553C13.2554 4.12796 12.4601 2.63149 11.2165 1.56528C9.97285 0.499068 8.37249 -0.0582491 6.73557 0.00482408C5.09866 0.0678972 3.54592 0.746709 2.38801 1.90545C1.23009 3.0642 0.552388 4.61742 0.490486 6.25438C0.428585 7.89134 0.987047 9.49131 2.05415 10.7342C3.12124 11.9771 4.61828 12.7712 6.24576 12.9577C7.87323 13.1442 9.51112 12.7094 10.8317 11.7401H10.8307C10.8607 11.7801 10.8927 11.8181 10.9287 11.8551L14.7787 15.7051C14.9662 15.8928 15.2206 15.9983 15.4859 15.9983C15.7512 15.9984 16.0056 15.8932 16.1932 15.7056C16.3809 15.5181 16.4863 15.2638 16.4864 14.9985C16.4865 14.7332 16.3812 14.4788 16.1937 14.2911L12.3437 10.4411C12.308 10.405 12.2695 10.3725 12.2287 10.3421ZM12.4867 6.49815C12.4867 7.22042 12.3445 7.93562 12.0681 8.60291C11.7917 9.2702 11.3865 9.87651 10.8758 10.3872C10.3651 10.898 9.75879 11.3031 9.0915 11.5795C8.42421 11.8559 7.70901 11.9981 6.98674 11.9981C6.26447 11.9981 5.54927 11.8559 4.88198 11.5795C4.21469 11.3031 3.60837 10.898 3.09765 10.3872C2.58693 9.87651 2.1818 9.2702 1.9054 8.60291C1.629 7.93562 1.48674 7.22042 1.48674 6.49815C1.48674 5.03946 2.0662 3.64051 3.09765 2.60906C4.1291 1.57761 5.52805 0.998147 6.98674 0.998147C8.44543 0.998147 9.84437 1.57761 10.8758 2.60906C11.9073 3.64051 12.4867 5.03946 12.4867 6.49815Z" fill="#8A8A8A" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>


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
                                        <td><button type="submit" class="btn btn-success">Editar</button></td>
                                    </tr>
                        <?php } }}?> 

                    </table>    
                </form>
    
        

            </div>
        </div>


    </body>
</html>
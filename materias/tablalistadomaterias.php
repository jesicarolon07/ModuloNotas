<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Materias-ISFT 225</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link rel="stylesheet" href="../styles/style.css">
        <link rel="stylesheet" href="../styles/styletablas.css">
    </head>

    <body>
        <?php
           require('../conexion/conexion.php');
           $msge= "";
           $busqueda = "";
           $result = null;

          

           if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $filtrar = $_POST['filtrar'];
                $busqueda = $_POST['busqueda'];
                $busqueda = strtolower($busqueda);
                switch($filtrar){

                    case $filtrar === "Denominación Materia":
                    $sql = "SELECT personal.id_personal, concat(personal.apellido_personal, ' ', personal.nombre_personal) as nombrecompleto, materia.id_materia, materia.cod_num, materia.denominacion_materia, materia.tipo_aprobacion, materia.correlatividades 
                    FROM personal 
                    INNER JOIN materia_profesor ON personal.id_personal = materia_profesor.id_personal 
                    INNER JOIN materia ON materia_profesor.id_materia = materia.id_materia
                    WHERE LOWER(materia.denominacion_materia) LIKE '$busqueda%'";
                    break;

                    case $filtrar ==="Tipo Aprobacion":
                    $sql = "SELECT personal.id_personal, concat(personal.apellido_personal, ' ', personal.nombre_personal) as nombrecompleto, materia.id_materia, materia.cod_num, materia.denominacion_materia, materia.tipo_aprobacion, materia.correlatividades 
                    FROM personal 
                    INNER JOIN materia_profesor ON personal.id_personal = materia_profesor.id_personal 
                    INNER JOIN materia ON materia_profesor.id_materia = materia.id_materia
                    WHERE lower(materia.tipo_aprobacion) LIKE '$busqueda%'";
                    break;

                    case $filtrar === "Correlativas":
                        $sql = "SELECT personal.id_personal, concat(personal.apellido_personal, ' ', personal.nombre_personal) as nombrecompleto, materia.id_materia, materia.cod_num, materia.denominacion_materia, materia.tipo_aprobacion, materia.correlatividades 
                        FROM personal 
                        INNER JOIN materia_profesor ON personal.id_personal = materia_profesor.id_personal 
                        INNER JOIN materia ON materia_profesor.id_materia = materia.id_materia
                        WHERE LOWER(materia.correlatividades)  LIKE '$busqueda%'";
                        break;

                }
                $result = $conn->query($sql);
            }else {
                $sql = "SELECT personal.id_personal, concat(personal.apellido_personal, ' ', personal.nombre_personal) as nombrecompleto, materia.id_materia, materia.cod_num, materia.denominacion_materia, materia.tipo_aprobacion, materia.correlatividades 
                FROM personal 
                INNER JOIN materia_profesor ON personal.id_personal = materia_profesor.id_personal 
                INNER JOIN materia ON materia_profesor.id_materia = materia.id_materia";
                $result = $conn->query($sql);
            }

           include '../header/header.php';
          
        ?>


            <main>
                <div class="d-flex flex-nowrap sidebar-height">
                    <?php include "../header/sidebar.php"; ?>
                    <div class="col-9 offset-3 bg-light-subtle pt-5">
                        <div class="d-block p-3 m-4 h-100 ">
                            <h3 class="card-footer-text mt-2 mb-5 p-2">Materias</h3>
                            <div class="m-4">
                                <h2 class="text-dark-subtle title">Listado de Materias</h2>
                            </div>
                            <div class="container table-responsive">
                            <form method="POST" action="./tablalistadomaterias.php">
                            <div class="d-flex gap-1">
                                <input id="busqueda" name="busqueda" type="text" class="form-control" placeholder="Búsqueda">
                                <select name="filtrar" class="form-select">
                                    <option value="Denominación Materia">Denominación Materia</option>
                                    <option value="Tipo Aprobacion">Tipo Aprobacion</option>
                                    <option value="Correlativas">Correlativas</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </form>
                                <a href="tablalistadodematerias.php" class="btn btn-primary custom-button mt-3">Configuraciones Materia</a>
                                <table class="table table-bordered table-striped mt-3">
                                    <a href="./tablalistadomaterias.php" class="btn btn-primary custom-button m-2 mt-4">Volver a Listador</a>
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID Materia</th> 
                                            <th>Año<br>Carrera</th>
                                            <th>Denomiacion<br>Materia</th>
                                            <th>Tpos<br>Aprobacion</th>
                                           <th>Correlativas</th>
                                           <th>Nombre Profesor</th>
                                           <th>Ver<br>Correlativas</th>
                                           <th>Ver<br>Materias</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($result && $result->num_rows > 0){
                                                while($row = $result -> fetch_assoc()){
                                                    echo "<tr>";
                                                    echo "<td class='d-none'>" . $row['id_materia'] . "</td>";
                                                    echo "<td>". $row['cod_num'] . "</td>";
                                                    echo "<td>". $row['denominacion_materia'] . "</td>";
                                                    echo "<td>". $row['tipo_aprobacion'] . "</td>";
                                                    echo "<td>". $row['correlatividades'] . "</td>";
                                                    echo "<td>". $row['nombrecompleto'] . "</td>";



                                                    echo "<td><a href='vermateriascorrelativas.php?id_materia=" . $row['id_materia'] . "' class='btn btn-custom-view' title='Ver Materias Correlativas'>";
                                                    echo "<i class='fa-solid fa-book' style='color: #0077FF;'></i>";
                                                    echo "</a></td>";
                                                    echo "<td><a href='vermateria.php?id_materia=" . $row["id_materia"] . "' class='btn btn-custom-view' title='Ver materia'>";
                                                    echo "<i class='fas fa-eye'></i>";
                                                    echo "</a></td>";
                                                    echo "</tr>";
                                                }
                                            }else{
                                                echo "<tr><td colspan='8'>No hay materias registradas</td></tr>";
                                            }
                                            $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
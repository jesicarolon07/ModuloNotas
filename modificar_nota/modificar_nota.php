

<?php

  include_once "../variablesPath/variablesPath.php";
  require_once(rutas::$pathConetion);
  include_once(rutas::$pathNuevoHeader);
 
?>

 
<?php
$id_nota = $_GET ['id_nota'];
$query = "SELECT * FROM notas WHERE id_nota = $id_nota";
$result = mysqli_query($conn, $query);
$nota= mysqli_fetch_assoc($result);
if($_SERVER["REQUEST_METHOD" == "POST"]){
    $id_nota= $_POST["id_nota"];
    $anio = $_POST["anio"];
    $nota= $_POST["nota"];
    $tipo_nota= $_POST["tipo_nota"];
    $periodo=$_POST["periodo"];

}
$query_modificar = "UPDATE notas SET anio='$anio', nota='$nota', tipo_nota='$tipo_nota', periodo='$periodo' WHERE id_nota=$id_nota";
if($conn->query($query_modificar) === TRUE){ 
    echo "<div class='alert alert-success' role='alert'>Nota modificada correctamente.</div>";
}else{
    echo "<div class='alert alert-danger' role='alert'>Error al modificar la nota: " . $conn->error . "</div>";
}


?>
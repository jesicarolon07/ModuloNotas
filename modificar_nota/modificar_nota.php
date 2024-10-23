

<?php

  include "../variablesPath/variablesPath.php";
  require(rutas::$pathConetion);
  include(rutas::$pathNuevoHeader);
  include(rutas::$pathcargarnota);
  include(rutas::$pathtablanota);
?>

 
<?php
$query_modificar = "UPDATE notas SET anio='$anio', nota='$nota', tipo_nota='$tipo_nota', periodo='$periodo' WHERE id_nota=$id_nota";
if($conn->query($query_modificar) === TRUE){ 
    echo "<div class='alert alert-success' role='alert'>Nota modificada correctamente.</div>";
}else{
    echo "<div class='alert alert-danger' role='alert'>Error al modificar la nota: " . $conn->error . "</div>";
}



echo "<div class='modal fade' id='editModal" . $row["id_nota"] . "' tabindex='-1' aria-labelledby='editModalLabel" . $row["id_nota"] . "' aria-hidden='true'>";
echo "<form method='post' action=''>";
echo "<input type='hidden' name='id_nota' value='" . $row["id_nota"] . "'>";
echo "<input type='text' class='form-control' id='anio" . $row["id_nota"] . "' name='anio' value='" . $row["anio"] . "'>";
echo "/form";
echo "/div";
?>
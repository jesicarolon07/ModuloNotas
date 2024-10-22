<?php
$query_modificar = "UPDATE notas SET anio='$anio', nota='$nota', tipo_nota='$tipo_nota', periodo='$periodo' WHERE id_nota=$id_nota";
if($conn->query($query_modificar) === TRUE){ 
    echo "<div class='alert alert-success' role='alert'>Nota modificada correctamente.</div>";
}else{
    echo "<div class='alert alert-danger' role='alert'>Error al modificar la nota: " . $conn->error . "</div>";
}
?>
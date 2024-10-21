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
<?php
     include "../variablesPath/variablesPath.php";
     require(rutas::$pathConetion);
     include(rutas::$pathNuevoHeader);
  
    /*require(rutas::$pathConetion);
    include(rutas::$pathNuevoHeader);*/
  ?>
<style>
    .contenedor{
        max-width: 800px;
        margin:  auto;
        display: block;
        padding:50px; 
        background-color: #f3f5f8;
       
    }
    .boton{
            font-size: 16px;
            border: none; 
            color: #fff; 
          padding: 5px 15px; 
            cursor: pointer; 
            border-radius: 5px; 
            border: #160f6b 2px solid;
            color: #160f6b; 
            
            

           

        }
    .boton:hover{
        background-color:  #ddd;
        color: black;
    
        }
    .botones{
        text-align: center ;
        display: flex;
        justify-content: space-evenly;
    }
    .texto3{
       
        padding:5px; 
        text-align:center;
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
        animation: fadeIn 1.5s forwards;/*fadeIn: Nombre de la animación 
        Al terminar la animación, el elemento permanecerá en el estado final (en este caso, totalmente visible y con tamaño completo). */
    }
    .text1 { animation-delay: 0s; }/*Especifica el tiempo que el navegador esperará antes de iniciar la animación */
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
      0% { opacity: 0; transform: scale(0.5); }/*@keyframes define la animación llamada fadeIn
      En este caso, la animación tiene dos etapas clave:
      0%: Cuando la animación comienza, el elemento es completamente invisible (opacity: 0) y reducido a la mitad de su tamaño (transform: scale(0.5)).
      100%: Al finalizar la animación, el elemento es completamente visible (opacity: 1) y tiene su tamaño normal (transform: scale(1)). */
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

                /*Determina si una variable es considerada vacía. Una variable se considera vacía si no existe o si su valor es igual a false. 
                empty() no genera una advertencia si la variable no existe. */
                
                die("Error: Todos los campos son obligatorios" );

            }
            
            $query ="INSERT INTO notas (id_materia, id_estudiante, anio, nota, tipo_nota, periodo) VALUES (?, ?, ?, ?, ?, ?)";

            /*se utiliza en consultas SQL para insertar valores en una tabla. Los signos de interrogación (?) son marcadores de 
            posición para los valores que se van a insertar, los cuales se proporcionan posteriormente en la consulta. 
            Esto permite la inserción dinámica de datos y es útil en sentencias como INSERT o en operaciones que trabajan con subconsultas.
            Values es Una expresión que define un sólo valor de una tabla de resultados de una columna. Una o más expresiones que definen los valores
             para una o varias columnas de la tabla de resultados.
             Prepara la consulta SQL y devuelve un manejador de sentencia para ser utilizado por operaciones
             adicionales sobre la sentencia. La consulta debe constar de una única sentencia SQL. Los marcadores de 
             parámetros deben estar ligados a variables de aplicación utilizando mysqli_stmt_bind_param() y/o mysqli_stmt_bind_result()
             antes de ejecutar la sentencia u obtener las filas. */

            $stmt = mysqli_prepare($conn, $query);
            /*prepara una sentencia SQL para su ejecución */
            mysqli_stmt_bind_param( $stmt, 'iissss',$materia, $estudiante, $anio, $nota, $tipo_nota, $periodo);
            /*es usada para enlazar variables para los marcadores de parámetros en la sentencia SQL que fue pasada
             a mysqli_prepare(). 
             */

            if(mysqli_stmt_execute($stmt)){

            /* ejecuta una consulta que había sido previamente preparada usando la función mysqli_prepare() representada por el objeto stmt . 
            Cuando se ejecuta cualquier marcador de parámetro que exista será automáticamente remplazado con los datos apropiados. */

                echo "Los datos se guardaron correctamente";
            }else{
                echo "Error al guardart datos". mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
            /*también desasigna el gestor de sentencias. Si la sentencia actual tiene resultados pendientes o no leídos, esta función 
            los cancelará, por lo que se podrá ejecutar la siguiente consulta. */
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
    <br><hr style="border: none; height: 2px; background-color: black; width: 100%; "> <br>
      
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
                <div class="dynamicFields">
                    <div class="mb-3">
                        <label for="tipo_nota"> Tipo de Nota</label>
                        <select id="tipo_nota" name="tipo_nota" required class="form-control">
                            <option value="">Seleccionar tipo de nota</option>
                            <option value="trabajo_practico">Trabajo practico</option>
                            <option value="parcial">Parcial</option>
                            <option value="oral">Oral</option>
                        </select>
                        <button type="button" class="btn btn-danger remove-field">-</button>
                        <button type="button" class="btn btn-success mt-3" id="addField">+</button>

                </div>

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
                </div><br><br>
                <div class="botones">
                    <button type="submit" class="boton  mt-3">Enviar Notas</button>
                    <a href="./tablanotas.php" class="boton  mt-3">Volver a Listado</a>
                </div>
              
            </form>
        </div>
    </div>
    <br>

    <script>
        document.addEventListener ('keydown', function (e) ){
        /*se utiliza para agregar un evento que detecta cuando una tecla es presionada en el teclado.
         Dentro de la función proporcionada, puedes utilizar el objeto e para acceder a información sobre la tecla que fue presionada, 
         como su código y valor, lo que permite realizar acciones específicas en respuesta a dicho evento.
         el .addEventListener por un lado tiene el parametro1 que dice el metodo y el parametro2 que dice la funcion o objeto.
         detecta cuando una tecla es presionada. El evento que se escucha es 'keydown', que se activa en el momento en que se
         presiona cualquier tecla en el teclado.
         e es el objeto del evento, que contiene información sobre el evento que acaba de ocurrir, incluyendo qué tecla fue presionada.
         */
            if(e.key === 'Enter'){

                /*La propiedad key del objeto de evento permite obtener el carácter, mientras que la propiedad
                code del evento permite obtener el “código físico de la tecla”. 
                Dentro de la función, se utiliza una condición para verificar si la tecla presionada es la tecla "Enter".
                La propiedad e.key devuelve el valor de la tecla presionada, y si es igual a 'Enter', el código dentro del bloque if se ejecutará.
                */

                e.preventDefault();
                /*Este método cancela el comportamiento por defecto que tendría la tecla "Enter" dentro de un formulario. Por ejemplo, 
                en muchos formularios, al presionar "Enter", se suele enviar el formulario. Con preventDefault(), se evita que esto suceda.
                es para evitar que nuestros formularios se envíen con el método que tienen configurado por defecto: recargar la página y añadir
                el valor de nuestro formulario como parámetros en la URL.
                */
                const formulario = e.target.form;

                /*e.target se refiere al elemento que disparó el evento, en este caso, el campo del formulario donde se presionó la tecla "Enter".
                .form devuelve el formulario al que pertenece ese elemento. Aquí, se almacena el formulario completo en la constante formulario.
                es el comando que nos permite acceder a la propiedad target de un objeto event. Puedes conocer esta propiedad al pintar un evento 
                recibido en tu navegador usando console. */

                const array = Array.prototype.indexOf.call(formulario, e.target);
                /*Encuentra la posición del campo actual (donde se presionó "Enter") dentro del formulario. Utiliza Array.prototype.indexOf
                para obtener el índice del campo (e.target) dentro de los elementos del formulario (formulario.elements).
                
                indexOf() retorna el primer índice en el que se puede encontrar un elemento dado en el array, ó retorna -1 si el elemento no esta presente*/
                const nextElement = formulario.elements[array+1];
                /*Se obtuvo el siguiente elemento dentro del formulario. El valor de array es la posición actual del campo donde 
                se presionó "Enter", por lo que array + 1 corresponde al siguiente campo en el formulario.
                formulario.elements contiene todos los campos del formulario como un array. */

                if(nextElement){
                    nextElement.focus();
                }
                /*i existe un siguiente elemento en el formulario (es decir, no estamos en el último campo), se establece el foco en ese elemento utilizando 
                nextElement.focus(). Esto significa que después de presionar "Enter", el cursor saltará automáticamente al siguiente campo del formulario. */
               

            }

        }
     
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
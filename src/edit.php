<?php
//Incluye fichero con parámetros de conexión a la base de datos
include_once("config.php");

/*Comprueba si hemos llegado a esta página PHP a través del formulario de modificaciones. 
En este caso comprueba la información "modifica" procedente del botón Guardae del formulario de Modificaciones
Transacción de datos utilizando el método: POST
*/
if(isset($_POST['modifica'])) {
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$marca = mysqli_real_escape_string($mysqli, $_POST['marca']);
	$modelo = mysqli_real_escape_string($mysqli, $_POST['modelo']);
	$color = mysqli_real_escape_string($mysqli, $_POST['color']);
	$refmotor = mysqli_real_escape_string($mysqli, $_POST['refmotor']);
	$matricula = mysqli_real_escape_string($mysqli, $_POST['matricula']);

	if(empty($marca) || empty($modelo) || empty($color) || empty($refmotor) || empty($matricula))	{
		if(empty($marca)) {
			echo "<font color='red'>Campo marca vacío.</font><br/>";
		}

		if(empty($modelo)) {
			echo "<font color='red'>Campo modelo vacío.</font><br/>";
		}

		if(empty($color)) {
			echo "<font color='red'>Campo color vacío.</font><br/>";
		}

		if(empty($refmotor)) {
			echo "<font color='red'>Campo refmotor vacío.</font><br/>";
		}

		if(empty($matricula)) {
			echo "<font color='red'>Campo matricula vacío.</font><br/>";
		}
	} //fin si
	else 
	{
//Prepara una sentencia SQL para su ejecución. En este caso una modificación de un registro de la BD.				
		$stmt = mysqli_prepare($mysqli, "UPDATE cars SET marca=?,modelo=?,color=?,refmotor=?,matricula=? WHERE id=?");
/*Enlaza variables como parámetros a una setencia preparada. 
i: La variable correspondiente tiene tipo entero
d: La variable correspondiente tiene tipo doble
s:	La variable correspondiente tiene tipo cadena
*/				
		mysqli_stmt_bind_param($stmt, "sssssi", $marca, $modelo, $color, $refmotor, $matricula, $id);
//Ejecuta una consulta preparada			
		mysqli_stmt_execute($stmt);
//Libera la memoria donde se almacenó el resultado
		mysqli_stmt_free_result($stmt);
//Cierra la sentencia preparada		
		mysqli_stmt_close($stmt);

		header("Location: index.php");
	}// fin sino
}//fin si
?>


<?php
/*Obtiene el id del dato a modificar a partir de la URL. Transacción de datos utilizando el método: GET*/
$id = $_GET['id'];

$id = mysqli_real_escape_string($mysqli, $id);


//Prepara una sentencia SQL para su ejecución. En este caso selecciona el registro a modificar y lo muestra en el formulario.				
$stmt = mysqli_prepare($mysqli, "SELECT marca, modelo, color, refmotor, matricula FROM cars WHERE id=?");
//Enlaza variables como parámetros a una setencia preparada. 
mysqli_stmt_bind_param($stmt, "i", $id);
//Ejecuta una consulta preparada
mysqli_stmt_execute($stmt);
//Enlaza variables a una setencia preparada para el almacenamiento del resultado
mysqli_stmt_bind_result($stmt, $marca, $modelo, $color, $refmotor, $matricula);
//Obtiene el resultado de una sentencia SQL preparada en las variables enlazadas
mysqli_stmt_fetch($stmt);
//Libera la memoria donde se almacenó el resultado		
mysqli_stmt_free_result($stmt);
//Cierra la sentencia preparada
mysqli_stmt_close($stmt);
//Cierra la conexión de base de datos previamente abierta
mysqli_close($mysqli);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<title>Modificación Coches</title>
<!--	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
-->
</head>

<body>
<!--	
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
-->
<div>
	<header>
		<h1>Panel de Control</h1>
	</header>
	
	<main>				
	<ul>
		<li><a href="index.php" >Inicio</a></li>
		<li><a href="add.html" >Alta</a></li>
	</ul>
	<h2>Modificación Coches</h2>
<!--Formulario de edición. 
Al hacer click en el botón Guardar, llama a esta misma página: edit.php-->
	<form action="edit.php" method="post">
		<div>
			<label for="marca">Marca</label>
			<input type="text" name="marca" id="marca" value="<?php echo $marca;?>" required>
		</div>

		<div>
			<label for="modelo">Modelo</label>
			<input type="text" name="modelo" id="modelo" value="<?php echo $modelo;?>" required>
		</div>

		<div>
			<label for="color">Color</label>
			<input type="text" name="color" id="color" value="<?php echo $color;?>" required>
		</div>
		
		<div>
			<label for="refmotor">RefMotor</label>
			<input type="text" name="refmotor" id="refmotor" value="<?php echo $refmotor;?>" required>
		</div>

		<div>
			<label for="matricula">Matricula</label>
			<input type="text" name="matricula" id="matricula" value="<?php echo $matricula;?>" required>
		</div>

		<div >
			<input type="hidden" name="id" value=<?php echo $id;?>>
			<input type="submit" name="modifica" value="Guardar">
			<input type="button" value="Cancelar" onclick="location.href='index.php'">
		</div>
	</form>

	</main>	
	<footer>
	Created by ASIR205 &copy; 2024
  	</footer>
</div>
</body>
</html>

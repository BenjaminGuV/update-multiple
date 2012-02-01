<?php
		//conexion a la mysql
		$conexion = mysql_connect("localhost", "prueba", "prueba");
		//usar la tabla consulta_select
		mysql_select_db("consulta_select", $conexion);


		$sql =  sprintf( "SELECT * FROM usuarios WHERE id = 1" );

		$result = mysql_query( $sql, $conexion );

		while ( $row =@ mysql_fetch_assoc($result) ) {
			$usuarios["nombre"] = $row["nombre"];
		}

		$sql =  sprintf( "SELECT * FROM comidas WHERE usuarios_id = 1" );

		$result = mysql_query( $sql, $conexion );
		$i = 0;
		while ( $row =@ mysql_fetch_assoc($result) ) {
			$comidas["nombre"][$i] = $row["nombre"];
			$i++;
		}


?>
<html>
<head>
	<title>Formulario</title>
</head>
<body>
	<form method="post" action="procesar.php">
		<fieldset>
			<legend>Formulario Multiple</legend>
			<dl>
				<dt>Nombre:</dt>
				<dl><input type="text" name="nombre" value="<?php echo $usuarios['nombre']; ?>"></dl><br>
				<dt>Comida 1:</dt>
				<dl><input type="text" name="comida1" value="<?php echo $comidas["nombre"][0]; ?>"></dl><br>
				<dt>Comida 2:</dt>
				<dl><input type="text" name="comida2" value="<?php echo $comidas["nombre"][1]; ?>"></dl><br>
				<dt>Comida 3:</dt>
				<dl><input type="text" name="comida3" value="<?php echo $comidas["nombre"][2]; ?>"></dl><br>
				<dt>Comida 4:</dt>
				<dl><input type="text" name="comida4" value="<?php echo $comidas["nombre"][3]; ?>"></dl><br>
				<dt>Comida 5:</dt>
				<dl><input type="text" name="comida5" value="<?php echo $comidas["nombre"][4]; ?>"></dl><br>
			</dl>
			<input type="submit" value="Actualizar">
		</fieldset>
	</form>
</body>
</html>
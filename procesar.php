<?php
	//Creamos una clase temporal
	class Vario
	{
		private $_comida = array();
		private $_comidaId = array();
		private $_num = 0;
		private $_numc = 0;

		//creamos el array de comidas
		public function setArrayComida( $comidas )
		{
			$this->_comida[$this->_num] = $comidas;

			$this->_num++;

			return $this->_comida;
		}

		//obtenemos los id de la tabla comida

		public function setArrayComidaId( $comidasId )
		{
			$this->_comidaId[$this->_numc] = $comidasId;
			$this->_numc++;

			return $this->_comidaId;
		}

		public function crearUpdate()
		{
			$sql = "UPDATE comidas SET nombre = CASE id ";
			$sqlfin = " END WHERE id IN ( ";
			$lim = sizeof( $this->_comidaId );

			for ($i=0; $i < $lim; $i++) { 
				$sql .= "WHEN '" . $this->_comidaId[ $i ] . "' THEN '" . $this->_comida[ $i ] . "' ";
				if ( $lim - 1 == $i ) {
					$sqlfin .= $this->_comidaId[$i] . ");";
				} else {
					$sqlfin .= $this->_comidaId[$i] . ", ";
				}
				
			}

			$sql = $sql . $sqlfin;

			return $sql;

		}

	}


	if ($_POST) {

		
		//conexion a la mysql
		$conexion = mysql_connect("localhost", "prueba", "prueba");
		//usar la tabla consulta_select
		mysql_select_db("consulta_select", $conexion);

		$nombre = (isset($_POST["nombre"])) ? trim( $_POST["nombre"] ) : '' ;
		$comida1 = (isset($_POST["comida1"])) ? trim( $_POST["comida1"] ) : '' ;
		$comida2 = (isset($_POST["comida2"] )) ? trim( $_POST["comida2"] ) : '' ;
		$comida3 = (isset($_POST["comida2"] )) ? trim( $_POST["comida3"] ) : '' ;
		$comida4 = (isset($_POST["comida2"] )) ? trim( $_POST["comida4"] ) : '' ;
		$comida5 = (isset($_POST["comida2"] )) ? trim( $_POST["comida5"] ) : '' ;

		$nombre = mysql_real_escape_string($nombre);
		$comida1 = mysql_real_escape_string($comida1);
		$comida2 = mysql_real_escape_string($comida2);
		$comida3 = mysql_real_escape_string($comida3);
		$comida4 = mysql_real_escape_string($comida4);
		$comida5 = mysql_real_escape_string($comida5);

		$sql = sprintf( "UPDATE usuarios SET nombre = '%s' WHERE id = '%d'", $nombre, 1 );

		$result = mysql_query($sql);

		$varios = new Vario;

		//conseguir las id de las comidas para el usuario con id = 1

		$sql = sprintf( "SELECT * FROM comidas WHERE usuarios_id = 1" );

		$result = mysql_query( $sql, $conexion );

		while ( $row =@ mysql_fetch_assoc($result) ) {
			$varios->setArrayComidaId( $row["id"] );
		}

		//creamos el array de comida
		$varios->setArrayComida($comida1);
		$varios->setArrayComida($comida2);
		$varios->setArrayComida($comida3);
		$varios->setArrayComida($comida4);
		$varios->setArrayComida($comida5);

		$sql = $varios->crearUpdate();

		$result = mysql_query( $sql, $conexion );

		$resultado = "-Se ha actualizado-";

	}else {
		$resultado = "-No se entro adecuadamente-";
	}

?>
<html>
<head>
	<title></title>
</head>
<body>
	<h1><?php echo $resultado; ?></h1>
</body>
</html>
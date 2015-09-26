<?php
	$user = $_SESSION['Usuario'];
	$iduser = $_SESSION['id_usuario'];
	
	$conexion =mysql_connect("localhost","anthonyprz") or die ("Problemas al conectar el servidor");
 	mysql_select_db("Listas", $conexion) or die ("error al tratar de conectar");
	
	

	
	//nuevo
	   $result3 = mysql_query("select * from usuario_lista where id_usuario = '".$iduser."'", $conexion );
	   while ($row3 = mysql_fetch_array($result3)) {
	   
	   
	   $result = mysql_query("SELECT * FROM lista where id_lista = '".$row3[2]."'", $conexion);
	   
	  echo "<div class='narchivadas'>";
	   
		while ($row = mysql_fetch_array($result)) {
				echo "<div class='CSSTableGenerator'>";
			    echo "<table border='0' class='Tlistas'>";
			    echo "<tr>";
    			echo "<form action='php/borrarl.php' method='post'>";
    			echo "<input type='text' value='$row[0]' name='idl' hidden>";
			    echo "<th>".$row[1]."</th><th><input type='submit' value='✘' class='btn'></th>";
			    echo "</form>";
			    echo "</tr>";
			    $result2 = mysql_query("SELECT * FROM tarea WHERE id_lista= '$row[0]' and archivada = 0", $conexion);
			    $X = 1;
			    while ($row2 = mysql_fetch_array($result2)) {
    			    echo "<tr>";
    			    echo "<form action='php/borrart.php' method='post'>";
    			    echo "<input type='text' value='$row2[0]' name='idt' hidden>";
    			    echo "<td>Tarea Nº".$X.": ".$row2[1]."</td><td><input class='btn' type='submit' value='archivar'></td>";
    			    echo "</form>";
    			    echo "</tr>";
    			    $X++;
			    }
			    echo "</table>";
			    echo "</div>";
			    echo "</br>";
			}
			
		 echo "</div><!-- narchivadas -->";
	   }
	   
	   
	   //archivadas-----------------------
	     $result4 = mysql_query("select * from usuario_lista where id_usuario = '".$iduser."'", $conexion );
	    while ($row3 = mysql_fetch_array($result4)) {
	   
	   
	   $result = mysql_query("SELECT * FROM lista where id_lista = '".$row3[2]."'", $conexion);
	   
	  echo "<div class='sarchivadas' hidden>";
	   
		while ($row = mysql_fetch_array($result)) {
				echo "<div class='CSSTableGenerator'>";
			    echo "<table border='0' class='Tlistas'>";
			    echo "<tr>";
    			echo "<form action='php/borrarl.php' method='post'>";
    			echo "<input type='text' value='$row[0]' name='idl' hidden>";
			    echo "<th>$row[1] ✔ </th><th><input type='submit' value='✘' class='btn'></th>";
			    echo "</form>";
			    echo "</tr>";
			    $result2 = mysql_query("SELECT * FROM tarea WHERE id_lista= '$row[0]' and archivada = 1", $conexion);
			    $X = 1;
			    while ($row2 = mysql_fetch_array($result2)) {
    			    echo "<tr>";
    			    echo "<form action='php/anadirt.php' method='post'>";
    			    echo "<input type='text' value='$row2[0]' name='idt' hidden>";
    			    echo "<td>Tarea Nº".$X.": ".$row2[1]."</td><td><input class='btn' type='submit' value='desarchivar'></td>";
    			    echo "</form>";
    			    echo "</tr>";
    			    $X++;
			    }
			    echo "</table>";
			    echo "</div>";
			    echo "</br>";
			}
			
		 echo "</div><!-- sarchivadas -->";
	   }
	
	header("Location: ../principal.php");
	
	
	?>
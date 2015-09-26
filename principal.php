<!DOCTYPE html>
	<head>
		
		<?php session_start(); ?>
		<title>Lista</title>
		<meta charset="utf-8"/>
		<script src="lib/jquery-1.11.3.min.js"></script>
		<script src="lib/jquery.validate.min.js"></script>

		<link rel="StyleSheet" href="css/stilo.css" type="text/css">
		<link rel="icon" type="image/png" href="imagenes/List2.png" />
		<script type="text/javascript">
		
		

$(document).ready(function() {
	
	 $("#linea1").click(function(){
        $("#crearlista").slideToggle("linear");
       
         	
    });
	 $("#linea2").click(function(){
        $("#compartirlista").slideToggle("linear");
        
    });
	 $("#linea3").click(function(){
        $(".narchivadas").slideToggle("linear");
        //document.getElementById("linea3").innerHTML = "<li>NO ARCHIVADAS</li>";
        $(".sarchivadas").slideToggle("linear");
       
       
       
         
        
       
    });

});	
		</script>
		
	</head>
	<body style="margin:0;">
		
		<div id="banner">
			<div id="logout"><a href="index.html">LogOut</a></div>
			<div class="logo">
			<img src="imagenes/List.png"/>	
			</div>
			<!--<div id="logo"></div>-->
			<div id="bannerletras">
				<h1></h1></h1>
			</div>
		</div><!--banner-->

		<div id="nav">
		
	<ul>	
		<li id="linea1">CREAR</li>
		<li id="linea2">COMPARTIR</li>
		<li  id="linea3">ARCHIVADAS</li>
	</ul>	
	<!--<ul>	
		<li id="linea2">COMPARTIR</li>
			
	</ul>
	<ul>	
		<li  id="linea3">ARCHIVADAS</li>	
		</ul>-->
			
	</div><!--nav-->
	<form hidden id="crearlista" method="post" action="php/crearlista.php">	
		<h2>Crear una Lista</h2>
		<input type="text" name="nombrelista" placeholder="Nombre de la Lista"/>
		<br/>
		<input type="text" name="task1" placeholder="task1"/>
		<br/>
		<input type="text" name="task2" placeholder="task2"/>
		<br/>
		<input type="text" name="task3" placeholder="task3"/>
		<br/>
		<input type="text" name="task4" placeholder="task4"/>
		<br/>
		<input type="text" name="task5" placeholder="task5"/>
		<br/>
		<input type="submit"  class='btn' value="Submit"/>
	</form>
	
		<form hidden id="compartirlista" method="post" action="php/compartir.php">	
		<h2>Compartir</h2>
		<input type="text" name="nombrelista" placeholder="Nombre de la Lista"/>
		<br/>
		<input type="text" name="usuarioc" placeholder="¿Con quien la quieres compartir?"/>
		<br/>
		<input type="submit" class='btn' value="Submit"/>
	</form>
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
	
	
	
	
	?>
	</body>
</html>
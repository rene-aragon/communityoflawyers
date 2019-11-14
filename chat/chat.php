<?php
	include "db.php";
	
	$consulta = "SELECT * FROM (SELECT * FROM chat ORDER BY id DESC LIMIT 5) T ORDER BY id ASC";
	$ejecutar = $conexion->query($consulta);
	
	while($fila = $ejecutar->fetch_array()):
?>

    <div class="item in item-visible">
        <div class="image">
            <img src="assets/images/users/user.jpg" alt="John Doe">
        </div>
        <div class="text">
            <div class="heading">
                <a href="#"><?php echo $fila['nombre']; ?></a>
				<span class="date"><?php echo formatearFecha($fila['fecha']); ?></span>
            </div>
            <?php echo $fila['mensaje']; ?>
        </div>
    </div>
	
<?php endwhile; ?>

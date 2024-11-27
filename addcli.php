<?php
	include "header.php";
?>
		<div class="row">
			<div class="col-md-10">
				<h1>CRUD PHP MySQLi</h1>
			</div>
			<div class="col-md-2 text-right">
				<h1><a href="index.php" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</a></h1>
			</div>
		</div>
		<br>
		<form method="post">
		  <div class="form-group">
		    <label for="nm">Nombre</label>
		    <input type="text" class="form-control" name="nm" id="nm" placeholder="Ingresa el nombre" required="true">
		  </div>
		  <div class="form-group">
		    <label for="em">Email</label>
		    <input type="email" class="form-control" name="em" id="em" placeholder="Correo eléctronico" required>
		  </div>
		  <div class="form-group">
		    <label for="ph">Telefono</label>
		    <input type="text" class="form-control" name="ph" id="ph" placeholder="Ingresa el Telefono" required="true">
		  </div>
		  <div class="form-group">
		    <label for="ad">Dirección</label>
		    <textarea class="form-control" name="ad" id="ad" cols="30" rows="3"></textarea>
		  </div>
		  <button type="submit" class="btn btn-primary" name="submit">Agregar</button>
		</form>
		

<?php
	include "footer.php";
?>
<div class="container-fluid imgfond">
              <?php
              $db->select("vbanner","nombre_matrix,img_matrix","WHERE id_categoria={$slider} LIMIT 1");
              if($db->num_rows()>0):
                  $row =$db->fetch_object();
              ?>
		<img src="<?php echo $dominio?>imagenes/banner/imagen1/<?php echo $row->img_matrix?>" alt="<?php echo $row->nombre_matrix?>" title="<?php echo $row->nombre_matrix?>">
             <?php endif;?>
	</div>


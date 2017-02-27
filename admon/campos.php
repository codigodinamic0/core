<?php include ('../lib/funciones.php'); ?>
<?php include ('include_mysqli.php'); ?>
<? 

$db->select("modulo","*","  where id_modulo='5'");
$rowh = $db->fetch_assoc();
?>
<form action="<?= $_SERVER['PHP_SELF'] ?>?op=<?php echo $op ?>&amp;idr=<?= $idr ?>" method="post" enctype="multipart/form-data" name="usuarios" id="usuarios">
							
					<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
<p>
									<label>
                                    <?php $valor = variable(10, 2);
echo $valor[0]; ?>
            <?php echo $modulo ?></label>
									<input name="nombre_modulo" type="text" class="text-input small-input"  id="nombre_modulo" value="<?= $row["nombre_modulo"] ?>" size="32" />
</p>
                             
                             
                             
<p>
									<label>
                                    <?php $valor = variable(46, 2);
echo $valor[0]; ?>
             <?php echo $modulo ?></label>
                                    <textarea name="descripcion_modulo" cols="32" class="text-input small-input" id="descripcion_modulo"><?= $row["descripcion_modulo"] ?>
                                    </textarea>
</p>
									
                                    
     
     
<p>
<label><?php $valor = variable(47, 2);
echo $valor[0]; ?></label>
<?

$cpadre = array();
$db->select("modulo
        INNER JOIN moca ON modulo.id_modulo = moca.modulo
        INNER JOIN campo ON campo.id_campo = moca.campo
        INNER JOIN idmo ON idmo.modulo = modulo.id_modulo
        INNER JOIN idioma ON idioma.id_idioma = idmo.idioma",
        "campo.nombre_campo,
        modulo.nombre_modulo,
        moca.campo,
        moca.modulo,
        modulo.id_modulo,
        moca.id_moca,
        idmo.idioma,
        idioma.idioma,
        idioma.id_idioma,
        idmo.id_idmo",
        "WHERE id_idmo=19
        ORDER BY id_moca ASC");
/*$db->last_query();*/
while ($arraypadre = $db->fetch_array()) {
    $cpadre[] = $arraypadre; 
}
foreach ($cpadre as $row2) {

    if ($row2['nombre_campo'] == 'video_matrix') {
        echo '<p><label>' . $row2['video_matrix'] .
            '</label><input class="text-input small-input" type="text" id="small-input" name="video_matrix" /></p>';
    }

    if ($row2['nombre_campo'] == 'mapa_matrix') {
        echo '<p><label>' . $row2['mapa_matrix'] .
            '</label><input class="text-input small-input" type="text" id="small-input" name="mapa_matrix" /></p>';
    }
    
    if ($row2['nombre_campo'] == 'url_matrix') {
        echo '<p><label>' . $row2['url_matrix'] .
            '</label><input class="text-input small-input" type="text" id="small-input" name="url_matrix" /></p>';
    }
    
    if ($row2['nombre_campo'] == 'referencia_matrix') {
        echo '<p><label>' . $row2['referencia_matrix'] .
            '</label><input class="text-input small-input" type="text" id="small-input" name="referencia_matrix" /></p>';
    }

    if ($row2['nombre_campo'] == 'codigo_matrix') {
        echo '<p><label>' . $row2['codigo_matrix'] .
            '</label><input class="text-input small-input" type="text" id="small-input" name="codigo_matrix" /></p>';
    }

    if ($row2['nombre_campo'] == 'nombre_matrix') {
        echo '<p><label>' . $row2['nombre_campo'] .
            '</label><input class="text-input small-input" type="text" id="small-input" name="nombre_matrix" /></p>';
    }

    if ($row2['nombre_campo'] == 'descripcion_matrix') {
        echo '<p><label>' . $row2['nombre_campo'] .
            '</label><textarea class="text-input textarea" id="textarea" name="descripcion_matrix" cols="79" rows="15"></textarea></p>';
    }

    if ($row2['nombre_campo'] == 'seo_matrix') {
        echo '<p><label>' . $row2['nombre_campo'] .
            '</label><input class="text-input small-input" type="text" id="small-input" name="seo_matrix" /></p>';
    }

    if ($row2['nombre_campo'] == 'contenido_matrix') {
        echo '<p><label>' . $row2['nombre_campo'] .
            '</label><textarea class="text-input textarea" id="textarea" name="contenido_matrix" cols="79" rows="15"></textarea></p>';
    }

    if ($row2['nombre_campo'] == 'precio1_matrix') {
        echo '<p><label>' . $row2['nombre_campo'] .
            '</label><input class="text-input small-input" type="text" id="small-input" name="precio1_matrix" /></p>';
    }

    if ($row2['nombre_campo'] == 'precio_matrix') {
        echo '<p><label>' . $row2['nombre_campo'] .
            '</label><input class="text-input small-input" type="text" id="small-input" name="precio_matrix" /></p>';
    }
    if ($row2['nombre_campo'] == 'codigo_matrix') {
        echo '<p><label>' . $row2['nombre_campo'] .
            '</label><input class="text-input small-input" type="text" id="small-input" name="codigo_matrix" /></p>';
    }
    if ($row2['nombre_campo'] == 'id_idmo') {
        echo '<input class="text-input small-input" type="hidden" id="small-input" name="id_idmo" />';
    }

    if ($row2['nombre_campo'] == 'id_marca') {
        echo '<input class="text-input small-input" type="hidden" id="small-input" name="id_marca" />';
    }

    if ($row2['nombre_campo'] == 'id_icono') {
        echo '<input class="text-input small-input" type="hidden" id="small-input" name="id_icono" />';
    }

    if ($row2['nombre_campo'] == 'id_categoria') {
        echo '<input class="text-input small-input" type="hidden" id="small-input" name="id_categoria" />';
    }

    if ($row2['nombre_campo'] == 'id_subcategoria') {
        echo '<input class="text-input small-input" type="hidden" id="small-input" name="id_subcategoria" />';
    }

    if ($row2['nombre_campo'] == 'id_matrix') {
        echo '<input class="text-input small-input" type="hidden" id="small-input" name="id_matrix" />';
    }








?>

                              <? } ?>

</p>                
  
								
<p>
									<input class="button" type="submit" value="<?php if ($id) {
    $valor = variable(2, 2);
    echo $valor[0];
} else {
    $valor = variable(3, 2);
    echo $valor[0];
} ?> <?php echo $modulo ?>" /> <input name="id" type="hidden" id="id" value="<?= $row["id_modulo"] ?>" />
<br />

                                   
                                    
								</p>
								
				    </fieldset><!-- End .clear -->
							
				  </form>
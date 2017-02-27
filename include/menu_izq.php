<div id="sidebar-left" class="col-xs-12 col-md-2">
    <ul class="nav nav-pills nav-stacked" style="height: 201px; top: 182px;">
        <?php
            $db->select("vproducto p, categoria ch, categoria cp","cp.nombre_categoria, cp.id_categoria, cp.amigable_categoria","WHERE p.id_categoria = ch.id_categoria AND ch.de = cp.id_categoria GROUP BY cp.id_categoria ORDER BY cp.ubica_categoria");
            /*$db->last_query();*/
            $cpadre = array();
            while ($arraypadre = $db->fetch_array()) {
                $cpadre[] = $arraypadre; 
            }
            foreach ($cpadre as $row_padre){
        ?>
                <li <?php if($grupo == $row_padre['id_categoria'] || $de == $row_padre['id_categoria']){ echo "class = 'active'"; } ?>>
                    <a class="top-category" ><span class="click-link"><?php echo $row_padre['nombre_categoria']; ?></span> <span class="caret"></span></a>                              
                    <ul class="sub-category">
                        <?php
                            $db->select("categoria ch, vproducto p","ch.nombre_categoria, ch.id_categoria, ch.amigable_categoria","WHERE ch.id_categoria = p.id_categoria AND ch.de = '{$row_padre['id_categoria']}' GROUP BY ch.id_categoria ORDER BY ch.ubica_categoria");
                            /*$db->last_query();*/
                            while ($row_categoria = $db->fetch_array()){
                        ?>
                               <a <?php if($row_categoria['id_categoria'] == $id_categoria){ echo "class = 'active'"; } ?> href="<?php echo $dominio.$row_categoria['amigable_categoria']; ?>/<?php echo $row_categoria['id_categoria']; ?>/cod10/"><?php echo $row_categoria['nombre_categoria']; ?></a>
                        <?php
                            }
                        ?>                                  
                    </ul>
                </li>
        <?php
            }
        ?>
    </ul>
</div>
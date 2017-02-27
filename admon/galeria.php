<?php 
include('include_mysqli.php');
?>
<?php 
$slider=7; ?>

		<link rel="stylesheet" href="css/galleriffic-1.css" type="text/css" />
        <script type="text/javascript" src="js/jquery.galleriffic.js"></script>
</head>

<body>
<div class="main">
	
	<?php include('header.php'); ?>
     
     <div id="content">
		<div class="main">
			<div class="indent">
				<div class="wrapper">
				  <?php include('menu_izq_galeria.php'); ?>
			  <div class="col-2">
						
                       
                 
                 <?php if ($_GET['id_sublinea']){ ?>
                 
                 <?php 
               
$db->select("sublinea","*","where id_sublinea='" . $_GET['id_sublinea'] . "'");
$row_gal = $db->fetch_assoc();
?>
                        <h2><?php echo $row_gal['nombre_sublinea'];?></h2>
                 
                 <div id="container">
			

				<!-- Start Minimal Gallery Html Containers -->
				<div id="gallery" class="content">
					<div id="controls" class="controls"></div>
					<div class="slideshow-container">
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
					</div>
				</div>
				<div id="thumbs" class="navigation">
					<ul class="thumbs noscript">
                    
                    <?php 

$cpadre = array();
$db->select("producto","*","where id_sublinea='" . $_GET['id_sublinea'] . "'");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row_gal) {
	?>
                    <li>
						<a class="thumb" href="imagenes/banco/<?php echo $row_gal['img_producto']?>" title="<?php echo $row_gal['img_producto']?>">
                        <img src="imagenes/banco/<?php echo $row_gal['img_producto']?>" width="50" height="50" />
                        </a>
						</li>
<?php } ?>
						
					</ul>
				</div>
				<!-- End Minimal Gallery Html Containers -->
				<div style="clear: both;"></div>
			</div>
                 
                 <?php } else { ?>
                 
                 <div id="container">
			

				<!-- Start Minimal Gallery Html Containers -->
				<div id="gallery" class="content">
					<div id="controls" class="controls"></div>
					<div class="slideshow-container">
						<div id="loading" class="loader"></div>
						<div id="slideshow2" class="slideshow"></div>
					</div>
				</div>
				<div id="thumbs2" class="navigation">
					<ul class="thumbs noscript">
                    
                    <?php 

$cpadre = array();
$db->select("producto","*","order by rand()");
/*$db->last_query();*/
    while ($arraypadre = $db->fetch_array()) {
		$cpadre[] = $arraypadre; 
    }
foreach ($cpadre as $row_gal2) {
?>
                    <li>
						
                        <a class="thumb" href="imagenes/banco/<?php echo $row_gal2['img_producto']?>" title="<?php echo $row_gal2['img_producto']?>">
                        <img src="imagenes/banco/<?php echo $row_gal2['img_producto']?>" width="50" height="50" />
                        </a>
						</li>
<?php } ?>
						
					</ul>
				</div>
				<!-- End Minimal Gallery Html Containers -->
				<div style="clear: both;"></div>
			</div>
                 
                 <?php } ?>
                 
                 
                 
                 
                 
                 
			  </div>
			</div>
		</div>

     
     <?php include('footer.php'); ?>
     
</div>
</div>
</div>
<script type="text/javascript">
			// We only want these styles applied when javascript is enabled
			$('div.navigation').css({'width' : '570px', 'float' : 'left' , 'margin-top' : '10px' });
			$('div.content').css('display', 'block');

			$(document).ready(function() {				
				// Initialize Minimal Galleriffic Gallery
				$('#thumbs').galleriffic({
					imageContainerSel:      '#slideshow',
					numThumbs:               15
				});
				
				$('#thumbs2').galleriffic({
					imageContainerSel:      '#slideshow2',
					numThumbs:               15
				});
				
			});
		</script>
</body>
</html>
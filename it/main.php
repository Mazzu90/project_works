<?php 

include 'include/autoload.php';

use Config\Core\Managers\SiteManager;
use Config\Core\Entities\Debugger;
use Config\SiteMap;

$debug = new Debugger('MAIN');

$debug->generic('SETTING PAGE..');

$debug->tryingToConstruct('SITE MANAGER');
$site = new SiteManager();

?>    
    
<!DOCTYPE html>
<html>
    <head>
    	<base href = "<?php  echo SiteMap::root ?>"/>
    	<title><?php echo $site->current_page->properties->title ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>                
        <meta name="description" content="<?php echo $site->current_page->properties->description ?>" />
        <meta name="keywords" content="<?php echo $site->current_page->properties->keywords ?>" />
        <meta name="content-language" content="<?php  echo SiteMap::language ?>" />       
        <link rel="icon" type="image/png" href="/images/iconAutoUnica.png" />
        <link href="/css/master.css" rel="stylesheet"/>
        


        <script src="/js/jquery-1.11.3.min.js"></script>
        <script src="/js/jquery-ui.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/modernizr.custom.js"></script>
        <script src="/assets/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js"></script>        
        <script src="/js/waypoints.min.js"></script>
        <script src="/js/jquery.easypiechart.min.js"></script>
        <script src="/js/classie.js"></script>
        <script src="/js/chosen.jquery.min.js"></script>        
        <!--Owl Carousel-->        
        <script src="/assets/owl-carousel/owl.carousel.min.js"></script>
        <!--bxSlider-->
        <script src="/assets/bxslider/jquery.bxslider.js"></script>        
        <!-- jQuery UI Slider -->       
        <script src="/assets/slider/jquery.ui-slider.js"></script>        
        
        <script src="/js/jquery.smooth-scroll.js"></script>
		<script src="/js/wow.min.js"></script>
		<script src="/js/jquery.placeholder.min.js"></script>
		<script src="/js/theme.js"></script>
        
        <script src="/js/jquery.placeholder.min.js"></script>
        <link rel="stylesheet" href="/css/lightbox.css" />
        <script type="text/javascript" src="/js/lightbox.js"></script>
                                  
    </head>   
   
    <body class="m-ndx m-detail">
    
   	    <?php $site->navbar->show()?>
		
    	
        <?php $site->current_page->show() ?>
        
        
        <?php $site->footer->show()?>
		
    </body>
    
</html>    



<?php 

use Config\Pages\Index;

$page = new Index();
?>

<!doctype html>
<html >	
	<head>	
		<title><?php echo $page->current_page->title?></title>       
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>                
        <meta name="description" content="<?php echo $page->current_page->description?>" />
        <meta name="keywords" content="<?php echo $page->current_page->keywords?>" />
        <meta name="content-language" content="<?php $page->siteMap::lingua?>" />       
        <link rel="icon" type="image/png" href="<?php echo $page->siteMap::root?>images/iconAutoUnica.png" />
        <link href="<?php echo $page->siteMap::base_url?>css/master.css" rel="stylesheet">                  
    </head>   
    <body class="m-index m-detail">
           
			<?php $page->menu->show; ?>
            
            <!--content -->
      		<?// corpo_pagina() ?>
            <!--content end -->
            
            <!--footer -->
           	<?// $this->Footer() ?>
            <!--footer end-->
            
            <!-- script footer -->
            <?// $this->ScriptFooter();
            //if (function_exists('scriptFooterAggiuntivi'))
           // scriptFooterAggiuntivi();
            
            //$this->scriptMonitoraggioGoogle()?>
            <!-- script footer end -->
        
    </body>
</html>
<!DOCTYPE HTML>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html;charset=utf-8" />  
    	<title><?php echo $title_1 ?> - Area di amministrazione</title>
        <link href="assets/shCore.css" rel="stylesheet" type="text/css" />
        <link href="assets/shThemeDjango.css" rel="stylesheet" type="text/css" /> 
        <link href="assets/style.css" rel="stylesheet" type="text/css" />
        <link href="../xcrud/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../xcrud/plugins/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="./">Autounica</a>
          <a class="esci" href="../logout.php">Esci</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <?php include(dirname(__FILE__).'/menu.php') ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
        <div id="page">
            <div id="content">
                <div class="clr">&nbsp;</div>
                <h1><?php echo $title_1 ?></h1>
                <p><?php echo $description ?></p>
                <?php include($file) ?>
                <div class="clr">&nbsp;</div>
            </div>
        </div>
     </div> 
        <script src="assets/shCore.js" type="text/javascript"></script>
        <script src="assets/shBrushPhp.js" type="text/javascript"></script>
        <script src="assets/shBrushJScript.js" type="text/javascript"></script>
        <script type="text/javascript">
        	SyntaxHighlighter.all();
        </script>
        <script src="../xcrud/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
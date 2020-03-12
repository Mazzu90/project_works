 <?php 
include('include_dir.php');
include($percorsoLingua.'include/include.php');

if(!isset($_SESSION['id_modello']))
{
    $_SESSION['id_modello']='';
}
isset($_POST['id_modello'])?$_SESSION['id_modello'] = $_POST['id_modello']:$_SESSION['id_modello']=$_SESSION['id_modello'];
isset($_POST['id_modello'])?$modello=$_POST['id_modello']:$modello=$_SESSION['id_modello'];

$grafica=new Tgrafica(false,false);

//$grafica->paint();
//unset ($dati);
//unset($grafica);

global $_POST, $modello;
$marca = $_POST['id_marca'];
$modello = $_POST['id_modello'];

modelli($marca,$modello);
   ?>
   
   
   <?

?>
    

<?php 
     function modelli($marca,$modello)
        {
        
        $sql = "SELECT modelli.id, modelli.titolo FROM modelli WHERE modelli.id in (select distinct id_modello from veicoli where id_marca = '".$marca."' ) ORDER BY titolo ASC";
          
           $rs = mysql_query($sql);
           $selectedModel = '';
                                                            if ($modello == '')
                                                                {
                                                                    $selectedModel = 'selected="selected"';
                                                                }
                                                            echo '<option value="-1" '.$selectedModel.'>Tutto</option>';
                                                       	
                                                        while ($row=mysql_fetch_assoc($rs)) {
                                                            if ($modello == $row['id'])
                                                                    {
                                                                        $selectedModel = 'selected="selected"';
                                                                    }
                                                                    else
                                                                    {
                                                                        $selectedModel = '';
                                                                    }
                                                            
                                                            echo '<option value="'.$row['id'].'" '.$selectedModel.'>'.$row['titolo'].'</option>';
                                                		 }
           
           
        }

?>

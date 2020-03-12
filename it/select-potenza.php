 <?php 
include('include_dir.php');
include($percorsoLingua.'include/include.php');

use It\Tgrafica;

if(!isset($_SESSION['modello']))
{
    $_SESSION['modello']='';
}
isset($_POST['modello'])?$_SESSION['modello'] = $_POST['modello']:$_SESSION['modello']=$_SESSION['modello'];
isset($_POST['modello'])?$modello=$_POST['modello']:$modello=$_SESSION['modello'];

$grafica=new Tgrafica(false,false);

//$grafica->paint();
//unset ($dati);
//unset($grafica);

global $_POST, $modello;
$potenza = $_POST['potenza'];
$potenzaDa = $_POST['potenzaDa'];
$potenzaA = $_POST['potenzaA'];
potenza($potenza,$potenzaDa,$potenzaA);
   
function potenza($potenza,$potenzaDa='',$potenzaA='')
        {global $kWatt;
        ?>
    
                                                
         <div class="col-xs-4 pr-none pl-none mb-sm">
                                                <select name="range[kwatt][min]" class="m-select filter dark auto_submit_filter" id="kwattDa">
													<?
                                                    $selectedPotDa = '';
                                                    echo '<option value="" '.$selectedPotDa.'>Da</option>';
                                                    foreach ($kWatt as $kW) {
                                                        $kWValue = $kW; 
                                                        if($potenza=='CV')
                                                            $kW = round($kW*1.35962);
                                                        
                                                        if ($kW == $potenzaDa)
                                                                {
                                                                    $selectedPotDa = 'selected="selected"';
                                                                }
                                                                else
                                                                {
                                                                    $selectedPotDa = '';
                                                                }
                                                                echo '<option value="'.$kWValue.'" '.$selectedPotDa.'>'.$kW.'</option>';
                                                     }
                                                    
                                                    ?>
                                                    </select>
                                                    <i class="icon-arrow-down icon icon-2x"></i>
												  </div>
                                                  
                                                  <div class="col-xs-4 pr-none pl-none mb-sm">
													<select name="range[kwatt][max]" class="m-select filter dark auto_submit_filter" id="kwattA">
													<?
                                                    $selectedPotA = '';
                                                    echo '<option value="" '.$selectedPotA.'>A</option>';
                                                    foreach ($kWatt as $kW) {
                                                        
                                                        $kWValue = $kW; 
                                                        if($potenza=='CV')
                                                            $kW = round($kW*1.35962);
                                                      
                                                        if ($kW == $potenzaA)
                                                                {
                                                                    $selectedPotA = 'selected="selected"';
                                                                }
                                                                else
                                                                {
                                                                    $selectedPotA = '';
                                                                }
                                                                echo '<option value="'.$kWValue.'" '.$selectedPotA.'>'.$kW.'</option>';
                                                     }
                                                    
                                                    ?>
														</select>
														<i class="icon-arrow-down icon icon-2x"></i>
												  </div>  
                                                  
                                                   <script>
 /* submit if elements of class=auto_submit_item in the form changes */
                $(function() {
                   $(".auto_submit_filter").change(function(e) {
                    submitForm(e);
                   });
                 });
                 
                                                         
   </script>
   
   <?
 
        }


?>

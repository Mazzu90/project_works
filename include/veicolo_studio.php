<?

include_once 'range.php';
include_once 'pool.php';
include_once 'basic.php';
include_once 'QueryField.php';
include_once 'join.php';
include_once 'patternMatch.php';
//include_once 'query.php';
include_once 'optional.php';
include_once 'componente.php';

class Veicolo extends Componente{
    
    /*public $id; //DB: id
    public $make; //DB: make 
    public $model; //DB: model
    public $version; //DB: version
    public $img; //DB: img
    public $km; //DB: km    
    public $registration_date; //DB: registration_date
    public $alimentazione; //DB: alimentazione
    //public $alimentazioneCodice; //DB: alimentazioneCodice
    public $kwatt; //DB: kwatt
    public $gearbox; //DB: gearbox
    public $colore; //DB: colore
    public $interni; //DB: interni
    public $telaio; //DB: telaio
    public $prezzo; //DB: prezzo
    public $neopatentati; //DB: neopatentati
    public $emission_class; //DB: emission_class
    public $body; //DB: body
    public $seats;
    public $doors;*/

    //public $titolo;
    //public $abs = 'join';
    
    public static function getTable(){
        return 'veicoli';
    }
    
    /*public static function getFields(){
         return $this->fields;//Util::getObjectVar(new Veicolo());         
    }*/
        
    /*public function getSelectFields(){
        
        $vars = $this->getFields();
        $fields = array();
        
        foreach($vars as $var){
            
            if($this->{$var} instanceOf QueryField){
            $field = $this->{$var}->getFieldForSelect();
            $fields[] = $field;     
            }
        }
        return $fields;
    }*/
    
    public static function getClass(){
        return 'Veicolo';
    }
    
    public function __construct() {
        
        $this->selectFields = array('id', 'make', 'model', 'version', 'img', 'km', 'registration_date', 
                            'alimentazione', 'kwatt', 'gearbox', 'colore', 'interni', 'telaio', 
                            'prezzo', 'neopatentati', 'emission_class', 'body', 'seats', 'doors');
        
        $this->additionalSearchFields = array('id_marca', 'id_modello');      
    }   
    
    //------------------------------ DECODIFICA CARBURANTE -------------------------------
    
    private $fuelIndex = array(        
        1 => 'Benzina',
        2 => 'Diesel',
        3 => 'Elettrica/Benzina',
        4 => 'Benzina/GPL',
        5 => 'Benzina/Metano',
        6 => 'Elettrica'   
    );
   
    function fuelEncode($fuel)
    {
        return  array_search($fuel, $fuelIndex);
    }
    
    function fuelDecode($codiceFuel)
    {
        //echo '<br/> fuel index:'.$this->fuelIndex[$codiceFuel];
        return $this->fuelIndex[$codiceFuel];
        
    }
    
    //-------------------------------- DECODIFICA BODY -------------------------------------
    
    private $bodyIndex = array(        
        1  => '2/3-Porte',
        2  => '4/5-Porte',
        3  => 'XXXXX',       
        4  => 'WWWWW',
        5  => 'Cabrio',
        6  => 'Coupè',
        7  => 'FFFFF',
        8  => 'DDDDD',
        9  => 'ZZZZZZ',
        10 => 'Fuoristrada',
        11 => 'Station Wagon',
        12 => 'Transporter',
        13 => 'Monovolume'   
    );
   
    function bodyEncode($fuel)
    {
        return  array_search($fuel, $bodyIndex);
    }
    
    function bodyDecode($codiceBody)
    {
        return $bodyIndex[$codiceBody];
    }     
    
    //----------------------------------- DECODIFICA EMISSIONI ---------------------------------------  
    
    private $classIndex = array(        
        1 => 'Euro 1',
        2 => 'Euro 2',
        3 => 'Euro 3',
        4 => 'Euro 4',
        5 => 'Euro 5',
        6 => 'Euro 6'   
    );
    function emissioniEncode($emissioni)
    {
        return  array_search($emissioni, $emissioniIndex);
    }
    
    function classDecode($codiceEmissioni)
    {
        return $emissioniIndex[$codiceEmissioni];
    }
    

    
    public function stampaScheda()
    {
        //echo 'stampa';
        $path = costantiP::BASE_URL.costantiP::LINGUA.'/dettaglio-auto.php?id='.$this->id; 
            /*if (costantiP::URL_REWRITE_ATTIVO)
                                        {
                                            $path = costantiP::BASE_URL.costantiP::LINGUA.'/'.normalizzaTesto($this->make).'/'.normalizzaTesto($this->model).'-'.normalizzaTesto($this->version).'_'.$this->id.'.htm';
                                        }
                                        else
                                        {
                                            $path = costantiP::BASE_URL.costantiP::LINGUA.'/dettaglio-auto.php?id='.$this->id;                                
                                        }*/
    
                            ?> 
                            <div class="col-lg-12 col-sm-12 col-xs-12 mb-xl pr-none pl-none">
                                <div class="b-items__cars-one  " data--delay="0.5s">
                                        <div class="col-lg-8 col-sm-12 col-xs-12"  >
    										<a href="<?echo $path?>">
                                            	<h3 class="mb-none"><?echo $this->make.' '.$this->model?></h3>
                                            	<h4 class="mt-none"><?echo $this->version?></h4>
    										</a>
                                            <div id="auto_<?echo $this->id?>" class="carousel slide"  data-ride="carousel" data-interval="false" >
    
                  
    
                
    
                                                  <!-- Wrapper for slides -->
    
                                                  <div class="carousel-inner" role="listbox" >
    												<div class="realtaAutounica"></div>
                                                    <div class="item active">
    
                                                    
    
                                                    <?      /*
                                                            1 - benzina
                                                            2 - diesel
                                                            3 - ibrida
                                                            4 - gpl
                                                            5 - metano
                                                            6 - elettrica
                                                            */
    
                                               $etichetta = false;
    
                                               
    
                                               /*switch ($this->alimentazioneCodice) {
    
                                                                    case 200000000:
                                                                        $venduta = '';
                                                                        $imgOverlay = 'diesel200';
                                                                        $etichetta = true;
                                                                        break;
    
                                                                    case 3:
                                                                        $venduta = '';
                                                                        $imgOverlay = 'ibrida200';
                                                                        $etichetta = true;
                                                                        break;
    
                                                                    case 4:
                                                                        $venduta = '';
                                                                        $imgOverlay = 'gpl200';
                                                                        $etichetta = true;
                                                                        break;
    
                                                                    case 5:
                                                                        $venduta = '';
                                                                        $imgOverlay = 'metano200';
                                                                        $etichetta = true;
                                                                        break;
    
                                                                    case 6:
                                                                        $venduta = '';
                                                                        $imgOverlay = 'elettrica200';
                                                                        $etichetta = true;
                                                                        break;
    
                                                                    case 10000000: 
                                                                        $venduta = '';
                                                                        $imgOverlay = 'benzina200';
                                                                        $etichetta = true;
                                                                        break;
                                                                }*/
    
                                                if($this->neopatentati==1)
                                                                    {   
                                                                        $venduta = '';
                                                                        $imgOverlay = 'neopatentati200';
                                                                        $etichetta = true;
                                                                    }
    
    
                                                if ($this->telaio!='')
                                                                    {   
                                                                        $venduta = 'venduta';
                                                                        $imgOverlay = 'venduta200';
                                                                        $etichetta = true;
                                                                    }
    
                                                            ?>
    
                                                <?
    
                                                
    
                                                 if ($etichetta)
                                                 {
    
                                                    ?>
                                                    <!--  linguetta in overlay -->
                                                    <a href="<?echo $path?>" class="<?echo $venduta?>">
                                                    	<span class="<?echo $venduta?>"></span>
                                                    </a>
    
                                                    <span class="etichettaCorner m-premium">
                                                    	<img src="../../images/<?echo $imgOverlay?>.png" class="img-responsive"/>
                                                    </span>
                                                    <?
                                                 }
                                                ?> 
    												
                                                    <!-- immagine principale-->
                                                     <a class="details" href="<?echo $path?>">
                                                      <img src="<?echo $this->img?>" alt='auto01' class="img-responsive"/>
                                                     </a>    
    
                                                    </div>
    
                                                <?
    
                                                        $sql = 'select immagini.* from immagini where immagini.id_veicolo = '.$this->id.' limit 1,3';
                                                         $immaginiVeicolo = '';
                                                         $grafica=new Tgrafica(false, false);
                                                         $result=mysql_query($sql);
    
                                                           while ($rowImmagini=mysql_fetch_assoc($result)) {
                                                                    $immagineVeicolo['id']=$rowImmagini['id'];
                                                                    $immagineVeicolo['img']=$rowImmagini['img'];
                                                                    $immagineVeicolo['imgBig']=$rowImmagini['img_big'];
                                                                    $immagineVeicolo['titolo']=$rowImmagini['titolo'];
                                                                    $immaginiVeicolo[]=$immagineVeicolo; 
                                                                }
    
                                                foreach ($immaginiVeicolo as $imgV) {
    
                                                    ?>    
    
                                                   <div class="item">
                                                    <a class="details" href="<?echo $path?>">
                                                     <img src="<?echo $imgV['imgBig']?>" alt='<?echo $imgV['titolo']?>' class="img-responsive"/>
                                                     </a>
                                                   </div>
    
                                                <? 
    
                                                    }
    
                                                ?>
    
    											<div class="item">
    												<a class="details" href="<?echo $path?>">
    													<img src="../images/scopri.png" class="img-responsive"/>
    												</a>
    											</div>
    
                                                 </div>
    
                                                  <!-- Left and right controls -->
                                                  <a class="left carousel-control" href="#auto_<?echo $this->id?>" role="button" data-slide="prev">
                                                    <span class="fa m-control-left" aria-hidden="true" ></span>
                                                    <span class="sr-only">Previous</span>
                                                  </a>
    
                                                  <a class="right carousel-control" href="#auto_<?echo $this->id?>" role="button" data-slide="next">
                                                    <span class="fa m-control-right" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                  </a>
    
                                                </div>
    
                                            <!--
                                            <section class="b-modal">
                                                <div class="modal fade" id="myModal<?echo $this->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel<?echo $this->id?>"><?echo $this->make.''.$this->model?> <?echo $this->version?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img src="<?echo costanti::IMG_PERCORSO_BASE.costanti::IMG_PERCORSO_ORIGINALE.$this->img?>" alt='auto01' class="img-responsive"/>
                                                            </div>
                                                        <script type="text/javascript">		
                                                        	//$(document).ready(function(){ $('#features').jshowoff({ speed:1000, links: false, controls: true }); });
                                                            $(document).ready(function(){ $('#auto_<?echo $this->id?>').jshowoff({ 
                                        					cssClass: 'thumbFeatures',
                                        					effect: 'fade'
                                        				}); });
                                                        </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
    
                                            <a data-toggle="modal" data-target="#myModal<?echo $this->id?>" href="#" class="b-items__cars-one-img-video"><span class="fa fa-search fa-2x"></span></a>
    
                                            <!--b-modal-->
    
                                        </div>
    
                                        <div class="col-lg-4 col-sm-12 col-xs-12 mt-elenco-auto">
    
                                            <header class="b-items__cars-one-info-header s-lineTopLeft s-lineDownLeft mb-elenco-auto">
    											<div class="risparmio" style="position: absolute; text-align: left; color:#87d0ef;">
    												Risparmi<br>
    												â‚¬9.500
    											</div>
    											<span><sup>â‚¬</sup><?echo number_format($this->prezzo,0,',','.')?></span>
    										</header>
    
                                            <div class="b-items__cars-one-info">
                                            
                                            <?
                                            $data = new Data();?>
    
                                                <p class="icon-carinfo km larg50"><?echo number_format($this->km,0,',','.')?> Km</p>
                                                <p class="icon-carinfo data larg50"><?echo $data->estraiDataAuto($this->registration_date)?></p>
                                                <p class="icon-carinfo alimentazione larg50"><?echo $this->fuelDecode($this->alimentazione)?></p>
                                                <? $cavalli = $this->kwatt*1000/735.49875 ?>
                                                <p class="icon-carinfo potenza larg50"><?echo $this->kwatt?> KW / <?echo round($cavalli,0)?> CV</p>
                                                <p class="icon-carinfo cambio hidd larg50"><?echo $this->gearbox?></p>
                                                <p class="icon-carinfo colore hidd larg50"><?echo $this->colore?></p>
                                                <p class="icon-carinfo interni mb-none hidd larg50"><?echo $this->interni?></p>
    
                                            </div>
                                            
                                            <button type="submit" onclick="window.location='<?echo $path?>'" class="btn m-btn lightblue mt-md" style="width: 100%;">SCOPRI DI PIÃ¹ </button>
    
                                        </div>
                                    </div>
                                </div>
        
        <?
    
    }
    
    
}

class VeicoloEsteso extends Veicolo{
    
    public $id_marca;
    public $id_modello; 
        
    const query_limit = 10;
    const query_order = 'prezzo DESC'; 

    //public $doors_pool;
    //public $optional = 'multi-ext'; 
    /*il nome della variabile è formattato in questa maniera: nometabellajoin_multi. 
    La funzione che crea la join prenderà la prima parte del nome e la userà come tabella con cui fare la join nella query.*/
    //public $optional_multi; 

    /* l'optional_param serve per aggiungere condizioni al join le cui informazioni non sono prese dall'html 
    (in questo caso la condizione di base è che l'id del veicolo sia uguale a quella della tabella veicoli) 
    e ad inserire la colonna da cui estrarre i dati nella join table
    */    
    //public $optional_param = array('extra_conditions'=>array('obj-field'=>'id', 'join-field'=>'id_veicolo'),
    //                              'column'=>'titolo' );

    public function getIdPoolFromOptional(){
        
        if(isset($_REQUEST['optional'])){ 
            
            $optional = new OptionalEsteso();
            
            $result = $optional->getList();
            $idPool = array();
            
            foreach($result as $opt){
                
                $idPool[] = $opt->id_veicolo;
            }
            
            $idPoolString =  '('.implode(', ', $idPool).' )'; 
            
            if ($idPoolString != '( )') 
                return $idPoolString;
            else
                return NULL;  
        }else
            return NULL;
    }
    public function __construct() {      
        
        //echo "Veicolo init'ed successfuly!!!";        
        /*$this->id = new Basic('id'); 
        $this->make = new Basic('make');  
        $this->model = new Basic('model'); 
        $this->version = new Basic('version'); 
        $this->img = new Basic('img');        
        $this->alimentazione = new Basic('alimentazione');         
        $this->gearbox = new Basic('gearbox'); 
        $this->colore = new Basic('colore'); 
        $this->interni = new Basic('interni');
        $this->telaio = new Basic('telaio');        
        $this->neopatentati = new Basic('neopatentati'); 
        $this->emission_class = new Basic('emission_class'); 
        $this->body = new Basic('body');
        $this->id_marca = new Basic('id_marca');
        $this->id_modello = new Basic('id_modello');*/    
        /*$this->registration_date = new Range($this->getTable(), 'registration_date');
        $this->seats = new Range($this->getTable(), 'seats');
        $this->kwatt = new Range($this->getTable(), 'kwatt');
        $this->prezzo = new Range($this->getTable(), 'prezzo');
        $this->km = new Range($this->getTable(),'km');
        $this->doors = new Pool($this->getTable(),'doors'); */
        
        $this->selectFields = array('id', 'make', 'model', 'version', 'img', 'km', 'registration_date', 
                            'alimentazione', 'kwatt', 'gearbox', 'colore', 'interni', 'telaio', 
                            'prezzo', 'neopatentati', 'emission_class', 'body', 'seats', 'doors');
        
        $this->additionalSearchFields = array('id_marca', 'id_modello');  
        
        parent::setVarsFromHttpRequest();
        
        $this->id = new Pool($this->getTable(), 'id');
        $this->id->value = $this::getIdPoolFromOptional();
        
 
 
        /*$this->titolo= new Join();
        $this->titolo->joinTable = ' optional ';
        $this->titolo->foreignKey = ' id_veicolo ';
        $this->titolo->field = new PatternMatch('optional', 'titolo');*/             
    }   
    
    public static function getInstance(){
        return new VeicoloEsteso();
    }
            

    

}






?>
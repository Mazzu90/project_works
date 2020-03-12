<?php
    $xcrud = Xcrud::get_instance();
    $xcrud->table('veicoli');
	$xcrud->table_name(' ');
    $xcrud->default_tab('Veicoli');
    $table = 'veicoli';


    $xcrud->button('#', "Sali", 'glyphicon glyphicon-arrow-up icon-arrow-up', 'btn xcrud-action', array(
        'data-action' => 'movetop',
        'data-task' => 'action',
        'data-table' => ''.$table.'',
        'data-primary' => '{id}'));
    $xcrud->button('#', "Scendi", 'glyphicon glyphicon-arrow-down icon-arrow-down', 'btn xcrud-action', array(
        'data-action' => 'movebottom',
        'data-task' => 'action',
        'data-table' => ''.$table.'',
        'data-primary' => '{id}'));
        
    $xcrud->create_action('movetop', 'movetop');
    $xcrud->create_action('movebottom', 'movebottom');
    
	$xcrud->create_action('publish', 'publish_action'); // action callback, function publish_action() in functions.php
    $xcrud->create_action('unpublish', 'unpublish_action');
    $xcrud->button('#', 'unpublished', 'icon-close glyphicon glyphicon-remove', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'publish',
            'data-table' => ''.$table.'',
            'data-primary' => '{id}'),
        array(  // set condition ( when button must be shown)
            'pubblicato',
            '!=',
            '1')
    );
    $xcrud->button('#', 'published', 'icon-checkmark glyphicon glyphicon-ok', 'xcrud-action', array(
        'data-task' => 'action',
        'data-action' => 'unpublish',
        'data-table' => ''.$table.'',
        'data-primary' => '{id}'), array(
        'pubblicato',
        '=',
        '1'));
    
	
  
   //nested_table ( inst_name, connect_field, nested_table, nested_connect_field ) 
     
    //$orderdetails = $xcrud->nested_table('Order details','orderNumber','orderdetails','orderNumber'); // 2nd level
    //$orderdetails->columns('productCode,quantityOrdered,priceEach');
    //$orderdetails->fields('productCode,quantityOrdered,priceEach');
    //$orderdetails->default_tab('Detail information');
     
    //$customers = $xcrud->nested_table('Customers','customerNumber','customers','customerNumber'); // 2nd level 2
    //$customers->columns('customerName,city,country');
     
    //$products = $orderdetails->nested_table('Products','productCode','products','productCode'); // 3rd level
    //$products->default_tab('Product details');
     
    //$productLines = $products->nested_table('Product Lines','productLine','productlines','productLine'); // 4th level
     
    $optional = $xcrud->nested_table('Optional','id','optional','id_veicolo'); // 2nd level
    $optional->columns('titolo');
    
    
    $immagini = $xcrud->nested_table('Immagini','id','immagini','id_veicolo'); // 2nd level
    $immagini->columns('titolo, img');
    $immagini->change_type('img', 'image', '', array('width' => 900, 'height' => 900, 'manual_crop' => false));
    $immagini->label('img','Preview');
    
    //$xcrud->unset_sortable();
    $xcrud->order_by('ordinamento');
	$xcrud->modal('additional_informations');
	$xcrud->column_width('pubblicato,img','100px');
    $xcrud->column_width('additional_informations,vetrina','100px'); 
	$xcrud->highlight_row('pubblicato', '=', 0, '#FFA299');
    $xcrud->validation_required('make')->validation_required('model')->validation_required('id_categoria')->validation_required('data_pubblicazione_inizio');
	$xcrud->fields('vetrina, make, model, version, body, traction, cc, kwatt, cylinders, cvfiscali, doors, seats, emission_co2, consumo_urbano, consumo_extra, consumo_misto, colore, interni, registration_date, km, gearbox, gears_number, plate, data_pubblicazione_inizio,titolo_veicolo,additional_informations,id_tipologia,id_categoria,pubblicato,prezzo, alimentazione,seats,serbatoio,emission_class,altezza,lunghezza,larghezza', false, 'Veicolo');
	$xcrud->fields('img,didascalia', false, 'Immagine');
	$xcrud->label('img','Preview');
	
    $xcrud->label('id_categoria','Categoria');
    $xcrud->label('titolo_veicolo','Veicolo');
    $xcrud->label('additional_informations','Informazioni');
    $xcrud->label('make','Costruttore');
    $xcrud->label('model','Modello');
    $xcrud->label('version','Versione');
    $xcrud->label('doors','Porte');
    $xcrud->label('seats','Posti');
    $xcrud->label('registration_date','Immatricolazione');
    $xcrud->label('gearbox','Cambio');
    $xcrud->label('plate','Targa');
    $xcrud->label('gears_number','Numero di marce');
    
       
	$xcrud->change_type('img', 'image', '', array('width' => 900, 'height' => 900, 'manual_crop' => false));
	$xcrud->change_type('immagine_1', 'image', '', array('width' => 900, 'height' => 900));
    $xcrud->change_type('emission_class','select','EURO 5',array('values'=>array('E6'=>'EURO 6','E5'=>'EURO 5','E4'=>'EURO 4','E3'=>'EURO 3','E2'=>'EURO 2','E1'=>'EURO 1')));
    $xcrud->change_type('alimentazione','select','Diesel',array('values'=>array('1'=>'Benzina','2'=>'Diesel','3'=>'Elettrica/Benzina','4'=>'Benzina/GPL','5'=>'Benzina/Metano','6'=>'Elettrica')));
    
    
    $date = date("d.m.Y");
    $xcrud->change_type('data_pubblicazione_inizio', 'datetime', $date);
    $xcrud->change_type('pubblicato', 'select', '1', array('1'=>'Yes','0'=>'No'));
    $xcrud->change_type('vetrina', 'select', '1', array('1'=>'Yes','0'=>'No'));
    $xcrud->highlight_row('vetrina', '=', 1, '#96FF73');
	
     
    //echo $xcrud->render('create');
	
    //$xcrud->relation('id_categoria','categorie','id','titolo_categoria','','','',' ','','id_categoria_madre','direttiva_euro');
    $xcrud->relation('id_tipologia','tipologie','id','titolo_tipologia');
    $xcrud->relation('id_categoria','categorie','id','titolo_categoria','','','','','','id_tipologia','id_tipologia');
    //$xcrud->relation('city','meta_location','id','local_name','type = \'CI\'','','','','','in_location','region');
    
     //relation ( field, target_table, target_id, target_name, where_array, order_by, multi, concat_separator, tree, depend_field, depend_on )
	/*						
	$xcrud->fields('thumb_2,immagine_2,didascalia_2', false, 'Immagine 2');
	$xcrud->change_type('thumb_2', 'image', '', array('width' => 200, 'height' => 300, 'manual_crop' => true));
	$xcrud->change_type('immagine_2', 'image', '', array('width' => 900, 'height' => 900));
	
	$xcrud->fields('thumb_3,immagine_3,didascalia_3', false, 'Immagine 3');
	$xcrud->change_type('thumb_3', 'image', '', array('width' => 200, 'height' => 300, 'manual_crop' => true));
	$xcrud->change_type('immagine_3', 'image', '', array('width' => 900, 'height' => 900));
	*/
	//$xcrud->fields('allegato_pdf', false, 'Allegato');
	//$xcrud->change_type('allegato_pdf', 'file');
    $xcrud->columns('img,titolo_veicolo,additional_informations,vetrina,pubblicato');
	$xcrud->hide_button('view');
	$xcrud->unset_csv();
    
    echo $xcrud->render();
	
?>
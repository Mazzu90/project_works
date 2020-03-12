<?php
    $xcrud = Xcrud::get_instance();
    $xcrud->table('galleria');
	$xcrud->table_name(' ');
    $table = 'galleria';



    //$xcrud->relation('area_medica','aree_mediche','id','area');
    
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
    
	
    $xcrud->unset_sortable();
    $xcrud->order_by('ordinamento');
	$xcrud->modal('descrizione');
	$xcrud->column_width('pubblicato,titolo,img','100px'); 
    $xcrud->column_width('titolo','250px'); 
	
	$xcrud->highlight_row('pubblicato', '=', 0, '#FFA299');
	$xcrud->validation_required('titolo')->validation_required('id_artista')->validation_required('data_pubblicazione_inizio');
	$xcrud->fields('data_pubblicazione_inizio,titolo,descrizione,pubblicato,id_tipologia,id_categoria', false, 'Quadro');
	$xcrud->fields('img', false, 'Immagine');
	$xcrud->label('img','Preview');
	$xcrud->label('pubblicato','Online');
    
    $xcrud->label('titolo','Nome veicolo');
    $xcrud->label('data_pubblicazione_inizio','Data');
    
	$xcrud->change_type('img', 'image', '', array('width' => 900, 'height' => 900, 'manual_crop' => false));
	//$xcrud->change_type('immagine_1', 'image', '', array('width' => 900, 'height' => 900));
    //$xcrud->change_type('direttiva_euro','select','EURO 5',array('values'=>array('6'=>'EURO 6','5'=>'EURO 5','4'=>'EURO 4')));
    $date = date("d.m.Y");
    $xcrud->change_type('data_pubblicazione_inizio', 'datetime', $date);
    
    $xcrud->change_type('pubblicato', 'select', '1', array('1'=>'Yes','0'=>'No'));
    
    $xcrud->relation('id_tipologia','tipologie','id','titolo_tipologia');
    $xcrud->relation('id_categoria','categorie','id','titolo_categoria','','','','','','id_tipologia','id_tipologia');
    $xcrud->label('id_categoria','Categoria');
    $xcrud->label('id_tipologia','Famiglia');
    
    //$xcrud->relation('id_tipologia','tipologie','id','titolo_tipologia');
    //$xcrud->relation('id_categoria','categorie','id','titolo_categoria','','','','','','id_tipologia','id_tipologia');
    
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
    $xcrud->columns('img,titolo,descrizione,pubblicato');
	$xcrud->hide_button('view');
	$xcrud->unset_csv();
    
    echo $xcrud->render();
	
?>
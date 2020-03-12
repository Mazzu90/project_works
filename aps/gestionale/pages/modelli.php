<?php
    $xcrud = Xcrud::get_instance();
    $xcrud->table('modelli');
	$xcrud->table_name(' ');
    $table = 'modelli';



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
    $xcrud->modal('testo');
	//$xcrud->column_width('pubblicato,testo,img','70px'); 
	//$xcrud->highlight_row('pubblicato', '=', 0, '#FFA299');
	$xcrud->validation_required('titolo');
	
    $xcrud->relation('id_categoria','marca','id','titolo');
    $xcrud->label('id_categoria','Brand');
    $xcrud->label('titolo','Modello');
    $xcrud->fields('titolo,titolo_normalizzato,id_categoria,testo', false, 'Modello');
	//$xcrud->relation('officeCode','offices','officeCode','city');
    $xcrud->columns('titolo,testo, id_categoria');
	$xcrud->hide_button('view');
	$xcrud->unset_csv();
    
    echo $xcrud->render();
	
?>
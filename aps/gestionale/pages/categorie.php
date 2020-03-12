<?php
    $xcrud = Xcrud::get_instance();
    $xcrud->table('categorie');
	$xcrud->table_name(' ');
    $table = 'categorie';



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
	$xcrud->validation_required('titolo_categoria');
	$xcrud->fields('titolo_categoria, id_tipologia, class', false, 'Categoria');
	$xcrud->fields('img,didascalia', false, 'Immagine');
    $xcrud->fields('url,pagina_contenuto,pagina_categoria', false, 'Seo Tools');
    $xcrud->label('img','Preview');
	$xcrud->label('id_tipologia','Famiglia');
    
	$xcrud->change_type('img', 'image', '', array('width' => 200, 'height' => 300, 'manual_crop' => false));
	//$xcrud->change_type('immagine_1', 'image', '', array('width' => 900, 'height' => 900));
    
    $xcrud->relation('id_tipologia','tipologie','id','titolo_tipologia');
    //$xcrud->relation('id_categoria','categorie','id','titolo_categoria');
    //$xcrud->relation('id','categorie','id','titolo_categoria','','','',' ','','id','id_tipolgia');
    
    //$xcrud->relation('id_tipologia','categorie','id','titolo_categoria','id_tipologia = \'0\'');
    //$xcrud->relation('id_tipologia','categorie','id','titolo_categoria','id_tipologia > 0','','','','','id_tipologia','id');
    //$xcrud->relation('city','meta_location','id','local_name','type = \'CI\'','','','','','in_location','region');
     
    // relation ( field, target_table, target_id, target_name, where_array, order_by, multi, concat_separator, tree, depend_field, depend_on )
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
    $xcrud->columns('img,titolo_categoria,id_tipologia');
	$xcrud->hide_button('view');
	$xcrud->unset_csv();
    
    echo $xcrud->render();
	
?>
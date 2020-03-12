<?php
    $xcrud = Xcrud::get_instance();
    $xcrud->table('veicoli');
	$xcrud->table_name('Attenzione!!!');
    
    $xcrud->button('#', "Sali", 'glyphicon glyphicon-arrow-up icon-arrow-up', 'btn xcrud-action', array(
        'data-action' => 'movetop2',
        'data-task' => 'action',
        'data-primary' => '{id}'));
    $xcrud->button('#', "Scendi", 'glyphicon glyphicon-arrow-down icon-arrow-down', 'btn xcrud-action', array(
        'data-action' => 'movebottom2',
        'data-task' => 'action',
        'data-primary' => '{id}'));
        
    $xcrud->create_action('movetop2', 'movetop2');
    $xcrud->create_action('movebottom2', 'movebottom2');
    
	$xcrud->validation_required('area')->validation_required('colore');
	
    $xcrud->unset_sortable();
    $xcrud->order_by('posizione');
	$xcrud->fields('posizione', true);
    $xcrud->columns('area,colore');
	$xcrud->hide_button('view');
	$xcrud->unset_csv();
    
    echo $xcrud->render();
?>
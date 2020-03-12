<?php
	foreach($pagedata as $pk=>$pd){ 
?>
    <li class="<?php echo $page == $pk ? 'active' : '' ?>">
        <a href="index.php?page=<?php echo $pk ?>"><?php echo $pd['title_1'] ?></a>
    </li>
<?php	   
	}
?>
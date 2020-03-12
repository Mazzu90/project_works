<?php

$id = 'ChIJ4_OGosd2gUcRCgVGPOzpxA4';
$key = ' AIzaSyC4hho1XAWVa98OVsJjnjBzUF7nRvmvnXE ';

$api = 'https://maps.googleapis.com/maps/api/place/details/json?placeid='.$id.'&key='.$key;
echo $api.'<br />';

$feed = json_decode(file_get_contents($api));
 
if ($feed->status=='OK') {
foreach ($feed->result->reviews as $current) {
echo '<div class="review">';
 
if ( isset($current->profile_photo_url) ) :
echo '<a href="'.$current->author_url.'" target="_blank">';
echo '<img src="'.$current->profile_photo_url.'?size=48" />';
echo '</a>';
endif;
 
echo '<h2><a href="'.$current->author_url.'" target="_blank">';
echo $current->author_name;
echo '</a></h2>';
 
for ($i=0;$i<$current->rating;$i++):
echo '&star;';
endfor;
 
if ( isset($current->text) ) :
echo '<p>'.$current->text.'</p>';
endif;
 
echo '</div>';
}
 
} else {
echo 'Non sono riuscito a caricare le recensioni';
}
 
?>
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include_once('autoloader.php');

$feed = new SimplePie();
$feed->set_feed_url('http://www.malone.edu/_resources/rss/news.xml');
$feed->enable_order_by_date(false);
$feed->set_cache_location($_SERVER['DOCUMENT_ROOT'] . '/demo/cache');
$feed->init();
//$feed->handle_content_type();

foreach($feed->get_items(0, 5) as $item){
	if ($item->get_permalink()){ 
		echo '<a href="' . $item->get_permalink() . '">';
	}
	if ($enclosure = $item->get_enclosure(0)){
			if ($enclosure->get_thumbnail()){
			echo '<img src="' . $enclosure->get_thumbnail() . '" alt="" />';
			}
		}
	echo '<h3>'.$item->get_title().'</h3>
	<p class="date">'.$item->get_date('j M Y, g:i a').'</p>';
	if ($item->get_permalink()){
		echo '</a>';
	}
}
?>

<?
/*
Plugin Name: WP NNDim Show
Plugin URI: http://www.evlos.org/
Description: This is a sidebar widget made for showing the pictures from nnd.im.
Author: 邪罗刹.Evlos
Version: 1.0.0
Author URI: http://www.imevlos.com/
*/

class Nnd_im extends WP_Widget {
	function Nnd_im() {
		parent::WP_Widget('Nnd_im', $name = '牛奶蛋 WP侧边栏挂件',array());
	}
	function widget($args, $instance) {
		extract($args);
		require_once(ABSPATH . WPINC . '/rss-functions.php');
		$rss = wp_cache_get('nndim_rss','nndim');
		if ($rss == false) {
			$rss = fetch_rss('http://nnd.im/rss/1');
			wp_cache_set('nndim_rss',$rss,'nndim',300);
		}
		$rss->items = array_slice($rss->items, 0, 4);
		echo $before_widget.$before_title.'我的牛奶蛋'.$after_title.'<ul>';
		foreach ($rss->items as $item ) {
			echo '<li style="float:left;border:1px solid #DDD;padding:1px;height:120px;width:120px;margin:8px 4px 4px;"><a href="'.$item['link'].'" title="'.$item['title'].'">'.$item['thumb'].'</a></li>';
		}
		echo '</ul>'.$after_widget;
	}
}
add_action('widgets_init', create_function('', 'return register_widget("Nnd_im");'));
?>
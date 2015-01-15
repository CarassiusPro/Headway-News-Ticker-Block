<?php 

class HeadwayNewsTickerBlock extends HeadwayBlockAPI {

    public $id = 'news-ticker-block';
    
    public $name = 'News Ticker';

    public $options_class = 'HeadwayNewsTickerBlockOptions';
	
		public static function enqueue_action($block_id, $block, $original_block = null) {
			wp_enqueue_script('jquery');
			wp_enqueue_style('newsticker-css', plugins_url('/css/style.css' , __FILE__),'','',false);
			wp_enqueue_script('easy-ticker', plugins_url('/js/jquery.easy-ticker.js' , __FILE__),'','',false);
			wp_enqueue_script('jquery-ticker', plugins_url('/js/jquery.easing.min.js' , __FILE__),'','',false);
		}

    public static function dynamic_js($block_id, $block) {

		return '
            jQuery(document).ready(function(){ 
	            jQuery(\'#block-' . $block['id'] . ' .CPNewsTicker\').easyTicker({
	                speed: "' . (parent::get_setting($block, 'ticker-speed', 'medium') ) . '",
	                direction: "' . (parent::get_setting($block, 'ticker-direction', 'up') ) . '",
	                interval: ' . (parent::get_setting($block, 'ticker-interval', 2) * 1000) . ',
	                visible: ' . (parent::get_setting($block, 'ticker-number', 1)) . ', 
	            });
            });' . "\n";
		
	}

	

		function content($block) {
            
        $speed = parent::get_setting($block, 'ticker-speed', 'medium');
        $direction = parent::get_setting($block, 'ticker-direction', 'up');
        $interval = parent::get_setting($block, 'ticker-interval', '2');
        $visible = parent::get_setting($block, 'ticker-number', '1');
		echo '<div class="CPNewsTicker">';
			echo '<ul>';

				$recent_posts = wp_get_recent_posts( $args );
				foreach( $recent_posts as $recent ){
					echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
				}
					echo '</ul>';
            
        echo '</div>';

		}

}
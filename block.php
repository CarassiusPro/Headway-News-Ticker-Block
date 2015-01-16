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
		$categorylink = parent::get_setting($block, 'ticker-categories', '');

			echo '<div class="CPNewsTicker">';
				$cats = get_categories();
					echo '<ul>';
						foreach ($cats as $cat) {
						$cat_id= $categorylink;
						query_posts("cat=$cat_id");
						if (have_posts()) : while (have_posts()) : the_post();
						echo '<li>';
							echo '<a href="';
							the_permalink();
							echo '">';
							the_title();
							echo '</a>';
						echo '</li>';
						endwhile; endif;
						}
					echo '</ul>';
			echo '</div>';
		  
		}
}

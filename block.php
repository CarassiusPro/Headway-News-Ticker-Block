
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
	
	public static function dynamic_css($block_id, $block = false) {
		if ( !$block )
			$block = HeadwayBlocksData::get_block($block_id);
			$tickertext = parent::get_setting($block, 'ticker-text', '');
			$css = '';
				$css .= '
					#block-' .$block_id . ' .CPNewsTicker:before {
					content: "' . $tickertext . '";
					}
				';
			return $css;
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
		
		
		function setup_elements() {

		$this->register_block_element(array(
			'id' => 'ticker-title',
			'name' => 'Ticker Title',
			'description' => 'Contains News Ticker Title',
			'selector' => '.CPNewsTicker:before',
			'properties' => array('background', 'fonts', 'padding')
		));

		$this->register_block_element(array(
			'id' => 'ticker-caption',
			'name' => 'Ticker Post',
			'selector' => '.CPNewsTicker',
			'properties' => array('background', 'padding', 'fonts', 'corners', 'borders', 'box-shadow'),
			'states' => array(
				'Selected' => '.CPNewsTicker a.selected', 
				'Hover' => '.CPNewsTicker a:hover'
			)
		));

		$this->register_block_element(array(
			'id' => 'ticker-caption',
			'name' => 'Ticker Post',
			'selector' => '.CPNewsTicker a',
			'properties' => array('background', 'padding', 'fonts', 'corners', 'borders', 'box-shadow')
		));

	}

	
}

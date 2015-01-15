<?php

class HeadwayNewsTickerBlockOptions extends HeadwayBlockOptionsAPI {

    public $tabs = array(
        'settings-tab' => 'Settings'
    );

	public $inputs = array(
		'settings-tab' => array(
			'ticker-direction' => array(
				'type' => 'select',
					'name' => 'ticker-direction',
					'label' => 'Animation Direction',
					'tooltip' => 'Choose your direction it scrolls',
					'options' => array(
						'up' => 'up',
						'down' => 'down',
					),
					
				),
				
			'ticker-speed' => array(
				'type' => 'select',
					'name' => 'ticker-speed',
					'label' => 'Animation Speed',
					'tooltip' => 'Choose how long it takes to scroll',
					'options' => array(
						'slow' => 'slow',
						'medium' => 'medium',
						'fast' => 'fast',
					),
					
				),

			'ticker-interval' => array(
				'type' => 'slider',
					'name' => 'ticker-interval',
					'label' => 'Time Between Slides',
					'tooltip' => 'Choose how long to pause on each post.',
					'default' => '2',
					'slider-min' =>  '0.5',
					'slider-max' => '10',
					'slider-interval' => '0.5',
                    'unit' => 's'
					),
				'ticker-number' => array(
				'type' => 'slider',
					'name' => 'ticker-number',
					'label' => 'Number of Posts',
					'tooltip' => 'Choose number of posts to display at once. 0 = ALL',
					'default' => '1',
					'slider-min' =>  '0',
					'slider-max' => '10',
					'slider-interval' => '1',
					),	
				),
	
	);
}
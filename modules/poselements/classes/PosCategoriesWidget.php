<?php

namespace CE;

defined('_PS_VERSION_') or die;

use Category;
use Configuration;
use Context;
use DB;
use ImageType;
use Shop;
use Validate;
use Posthemes\Module\Poselements\WidgetHelper;

class PosCategoriesWidget extends WidgetHelper { 
	public function getName() {
		return 'pos_categories';
	}

	public function getTitle() {
		return $this->l('Pos Categories');
	}

	public function getIcon() { 
		return 'fa fa-server';
	}

	public function getCategories() {
		return [ 'posthemes' ];
	}
 
	

	protected function _registerControls() { 
		 
		// Product
		$this->startControlsSection(
			'categories_section',
			[
				'label' => $this->l( 'Categories' ),
				'tab' => ControlsManager::TAB_CONTENT,
			]
		);
			 
			$this->addControl(
	            'category_id',
	            [
	                'label' => $this->l('Category'),
	                'label_block' => true,
	                'type' => ControlsManager::SELECT2,
	                'options' => $this->adminGetCategories(),
	                'default' => 2,
	                'multiple' => true,
	            ]
	        );

			$designs = array('1' => 'Design 1','2' => 'Design 2','3' => 'Design 3');
			$this->addControl(
				'design',
				[
					'label' => $this->l( 'Select design' ),
					'type' => ControlsManager::SELECT,
					'options' => $designs,
					'frontend_available' => true,
					'default' => '1'
				]
			);
			
			$this->addControl(
				'show_count',
				[
					'label' 		=> $this->l('Show Count Products'),
					'type' 			=> ControlsManager::SWITCHER,
					'return_value' 	=> 'yes',
					'default' 		=> '', 
					'label_on'      => $this->l('Yes'),
                    'label_off'     => $this->l('No'),
				]
			);
			$this->addControl(
				'show_subcategories',
				[
					'label' 		=> $this->l('Show Subcategories'),
					'type' 			=> ControlsManager::SWITCHER,
					'return_value' 	=> 'yes',
					'default' 		=> '', 
					'label_on'      => $this->l('Yes'),
                    'label_off'     => $this->l('No'),
				]
			);
			$this->addControl(
				'limit_subcategories',
				[
					'label' => $this->l( 'Limit subcategories' ),
					'type' => ControlsManager::NUMBER,
					'min' => 1,
					'max' => 10,
					'step' => 1,
					'default' => 3,
					'condition'    	=> [
						'show_subcategories' => 'yes',
					],
				]
			);
			$this->addControl(
				'show_link',
				[
					'label' 		=> $this->l('Show Link View'),
					'type' 			=> ControlsManager::SWITCHER,
					'return_value' 	=> 'yes',
					'default' 		=> '', 
					'label_on'      => $this->l('Yes'),
                    'label_off'     => $this->l('No'),
				]
			);
			$this->addControl(
				'enable_slider',
				[
					'type' => ControlsManager::HIDDEN,
					'default' => 'yes'
				]
			);
		$this->endControlsSection(); 
		 
		
		//Slider Setting
		$this->addCarouselControls($this->getName() , 4);

	}
	
	protected function render() {
		if (is_admin()){
			return print '<div class="ce-remote-render"></div>';
		}
		$settings = $this->getSettings(); 
		if(empty($settings['category_id'])) {
			echo 'Please configure and select categories to show'; return false;
		}

		$context = \Context::getContext();
		$id_lang = $context->language->id;
		// Data settings
		$slick_options = [
			'slidesToShow'   => ($settings['items']) ? (int)$settings['items'] : 4,
			'slidesToScroll' => ($settings['slides_to_scroll']) ? (int)$settings['slides_to_scroll'] : 1,
			'autoplay'       => ($settings['autoplay'] == 'yes') ? true : false,
			'autoplaySpeed'  => ($settings['autoplay_speed']) ? (int)$settings['autoplay_speed'] : 5000,
			'infinite'       => ($settings['infinite'] == 'yes') ? true : false,
			'speed'          => ($settings['transition_speed']) ? (int)$settings['transition_speed'] : 500,
			'arrows'         => ($settings['arrows'] == 'yes') ? true : false,
			'dots'           => ($settings['dots'] == 'yes') ? true : false, 
			'rows'         	 => (int) $settings['rows'] ? $settings['rows'] : 1,
		];  

		$responsive = array();
		if($settings['responsive'] == 'default') {
			$responsive = $this->posDefaultResponsive((int)$settings['items']);
		}else{
			$default_responsive = $this->posDefaultResponsive((int)$settings['items']);
			$responsive = array(
				'xl' => $settings['items_laptop'] ? (int)$settings['items_laptop'] : $default_responsive['xl'],
				'lg' => $settings['items_landscape_tablet'] ? (int)$settings['items_landscape_tablet'] : $default_responsive['lg'],
				'md' => $settings['items_portrait_tablet'] ? (int)$settings['items_portrait_tablet'] : $default_responsive['md'],
				'sm' => $settings['items_landscape_mobile'] ? (int)$settings['items_landscape_mobile'] : $default_responsive['sm'],
				'xs' => $settings['items_portrait_mobile'] ? (int)$settings['items_portrait_mobile'] : $default_responsive['xs'],
				'xxs' => $settings['items_small_mobile'] ? (int)$settings['items_small_mobile'] : $default_responsive['xxs'],
			);
		}
		if($settings['slides_to_scroll'] == '1'){
			$scroll = true;
		}else{
			$scroll = false;
		}
		$slick_responsive = [
			'items_laptop'            => $responsive['xl'],
            'items_landscape_tablet'  => $responsive['lg'],
            'items_portrait_tablet'   => $responsive['md'],
            'items_landscape_mobile'  => $responsive['sm'],
            'items_portrait_mobile'   => $responsive['xs'],
            'items_small_mobile'      => $responsive['xxs'],
            'scroll' 				  => $scroll,
		];
		$this->addRenderAttribute(
			'data', 
			[
				'class' => ['categories-container', 'slick-slider-block', 'column-desktop-'. $responsive['xl'],'column-tablet-'. $responsive['md'],'column-mobile-'. $responsive['xs']],
				'data-slider_options' => json_encode($slick_options),
				'data-slider_responsive' => json_encode($slick_responsive),
			]
			
		);
		$content_checker = 0;
		$html = '';
		$html .= '<div '. $this->getRenderAttributeString('data') .'>'; 

				foreach($settings['category_id'] as $id_category) {

					$category  = new \Category( $id_category, (int) $context->language->id );
					if( !$category->id ) continue;
					$content_checker = 1;
					$link = new \link();
					$category_thumb =  $link->getBaseLink() .'img/c/'. $id_category .'_thumb.jpg';
					if (! @getimagesize($category_thumb)) {
						$category_thumb = $link->getBaseLink() .'img/c/en.jpg';
					}
					$category_link = $category->getLink();

					$html .= '<div class="category-item">';
							if($settings['design'] == '1') {
								$html .= '<div class="style1">';
									$html .= '<div class="category-image">';
										if(!empty($category_thumb)){
											$html .= '<a href="'. $category_link .'"><img src="'. $category_thumb .'" alt=""/></a>';
										}
									$html .= '</div>';
									$html .= '<div class="category-content">';
										$html .= '<a class="name" href="'. $category_link .'">'. $category->name .'</a>';
										if($settings['show_count']) {
											$html .= '<p class="count">'. $category->getProducts(null, null, null, null, null, true) .' Products</p>';
										}

										if($settings['show_subcategories']) { 
											$subcategories = $category->getSubCategories($id_lang , true);
											$limit = 99;
											if((int)$settings['limit_subcategories']) $limit = (int)$settings['limit_subcategories'];
											$html .= '<ul>';
											foreach($subcategories as $key => $sub){
												if($key == $limit) continue;
												$subcategory = new \Category( $sub['id_category'] , (int) $context->language->id );
												$html .= '<li><a href="'. $subcategory->getLink() .'">'. $sub['name'] .'</a></li>';
											}
											$html .= '</ul>';
										}
										
										if($settings['show_link']) {
											$html .= '<a class="link" href="'. $category_link .'">'. $this->l( 'View all' ) .'</a>';
										}
									$html .= '</div>';
								$html .= '</div>';
							}
							if($settings['design'] == '2') {
								$html .= '<div class="style2">';
									$html .= '<div class="category-image">';
										if(!empty($category_thumb)){
											$html .= '<a href="'. $category_link .'"><img src="'. $category_thumb .'" alt=""/></a>';
										}
									$html .= '</div>';
									$html .= '<div class="category-content">';
										$html .= '<a class="name" href="'. $category_link .'">'. $category->name .'</a>';
										if($settings['show_count']) {
											$html .= '<p class="count">'. $category->getProducts(null, null, null, null, null, true) .' Products</p>';
										}
										if($settings['show_link']) {
											$html .= '<a class="link" href="'. $category_link .'">'. $this->l( 'View all' ) .'</a>';
										}
										if($settings['show_subcategories']) { 
											$subcategories = $category->getSubCategories($id_lang , true);
											$limit = 99;
											if($settings['limit_subcategories']) $limit = $settings['limit_subcategories'];
											$html .= '<ul>';
											foreach($subcategories as $key => $sub){
												if($key == $limit) continue;
												$subcategory = new \Category( $sub['id_category'] , (int) $context->language->id );
												$html .= '<li><a href="'. $subcategory->getLink() .'">'. $sub['name'] .'</a></li>';
											}
											$html .= '</ul>';
										}
										
										
									$html .= '</div>';
								$html .= '</div>';
							}
							if($settings['design'] == '3') {
								$html .= '<div class="style3">';
									$html .= '<div class="category-image">';
										if(!empty($category_thumb)){
											$html .= '<a href="'. $category_link .'"><img src="'. $category_thumb .'" alt=""/></a>';
										}
									$html .= '</div>';
									$html .= '<div class="category-content">';
										$html .= '<a class="name" href="'. $category_link .'">'. $category->name .'</a>';
										if($settings['show_count']) {
											$html .= '<p class="count">'. $category->getProducts(null, null, null, null, null, true) .' Products</p>';
										}
										if($settings['show_link']) {
											$html .= '<a class="link" href="'. $category_link .'">'. $this->l( 'View all' ) .'</a>';
										}
										if($settings['show_subcategories']) { 
											$subcategories = $category->getSubCategories($id_lang , true);
											$limit = 99;
											if($settings['limit_subcategories']) $limit = $settings['limit_subcategories'];
											$html .= '<ul>';
											foreach($subcategories as $key => $sub){
												if($key == $limit) continue;
												$subcategory = new \Category( $sub['id_category'] , (int) $context->language->id );
												$html .= '<li><a href="'. $subcategory->getLink() .'">'. $sub['name'] .'</a></li>';
											}
											$html .= '</ul>';
										}
										
										
									$html .= '</div>';
								$html .= '</div>';
							}
					$html .= '</div>';
				}
				 
		$html .= '</div>';

		if(!$content_checker) {
			echo 'Please configure and select categories to show'; return false;
		}
		echo $html;
	}

	public function adminGetCategories()
    {
        
        $range = '';
        $maxdepth = 5;
        $categories_list = [];
        $category = new \Category((int)Configuration::get('PS_HOME_CATEGORY'));

        if (Validate::isLoadedObject($category))
        {
            if ($maxdepth > 0)
            {
                $maxdepth += $category->level_depth;
            }
            $range = 'AND nleft >= '.(int)$category->nleft.' AND nright <= '.(int)$category->nright;
        }

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
            SELECT c.id_parent, c.id_category, cl.name, cl.description, cl.link_rewrite
            FROM `'._DB_PREFIX_.'category` c
            INNER JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND cl.`id_lang` = '.Context::getContext()->language->id.Shop::addSqlRestrictionOnLang('cl').')
            INNER JOIN `'._DB_PREFIX_.'category_shop` cs ON (cs.`id_category` = c.`id_category` AND cs.`id_shop` = '.Context::getContext()->shop->id.')
            WHERE (c.`active` = 1 OR c.`id_category` = '.(int)Configuration::get('PS_HOME_CATEGORY').')
            AND c.`id_category` != '.(int)Configuration::get('PS_ROOT_CATEGORY').'
            '.((int)$maxdepth != 0 ? ' AND `level_depth` <= '.(int)$maxdepth : '').'
            '.$range.'
            ORDER BY `level_depth` ASC, '.(Configuration::get('BLOCK_CATEG_SORT') ? 'cl.`name`' : 'cs.`position`').' '.(Configuration::get('BLOCK_CATEG_SORT_WAY') ? 'DESC' : 'ASC'));

        foreach ($result as &$row)
        {
            $categories_list[$row['id_category']] = $row['name'];
        }

            
        
        return $categories_list;
    }

    /**
     * Get translation for a given widget text
     *
     * @access protected
     *
     * @param string $string    String to translate
     *
     * @return string Translation
     */
    protected function l($string)
    {
        return translate($string, 'poselements', basename(__FILE__, '.php'));
    }
}
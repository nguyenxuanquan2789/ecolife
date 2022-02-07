<?php  

namespace CE;

defined('_PS_VERSION_') or die;

use Context;
use Employee;
use Posthemes\Module\Poselements\WidgetHelper;

class PosLatestPostWidget extends WidgetHelper { 
	public function getName() {
		return 'pos_latestpost';
	}

	public function getTitle() {
		return $this->l('Pos Latest Posts');
	}

	public function getIcon() { 
		return 'fa fa-leanpub';
	}

	public function getCategories() {
		return [ 'posthemes' ];
	}

	protected function _registerControls() { 
		
		//Elements
		$this->startControlsSection(
            'section_content',
            [
                'label' => $this->l('Content'),
            ]
		);

			$this->addControl(
				'limit',
				[
					'label' 		=> $this->l('Limit display'),
					'type' 			=> ControlsManager::NUMBER,
					'default' 		=> 6,
					'separator' 	=> 'before',
				]
			);
			$this->addControl(
				'design',
				[
					'label' => $this->l( 'Design' ),
					'type' => ControlsManager::SELECT,
					'options' => [
						'1'  => $this->l( 'Design 1' ),
						'2'  => $this->l( 'Design 2' ),
						'3'  => $this->l( 'Design 3' ),
						'4'  => $this->l( 'Design 4' ),
					],
					'frontend_available' => true,
					'default' => '1'
				]
			);

			$this->addControl(
				'enable_slider',
				[
					'label' 		=> $this->l('Enable Slider'),
					'type' 			=> ControlsManager::HIDDEN,
					'default' 		=> 'yes', 
				]
			);

		$this->endControlsSection();

		//Slider Setting
		$this->addCarouselControls($this->getName() , 3);
	}

	protected function render() {

		if(! \Module::isInstalled('smartblog') || ! \Module::isEnabled('smartblog')) return;

		$settings = $this->getSettings();
		$context = \Context::getContext();
		$output = '';

		
		$responsive = array();
		if($settings['responsive'] == 'default') {
			$responsive = $this->posDefaultResponsive((int)$settings['items']);
		}else{
			$default_responsive = $this->posDefaultResponsive((int)$settings['items']);
			
			$responsive = array(
				'xl' => $settings['items_laptop'] ? $settings['items_laptop'] : $default_responsive['xl'],
				'lg' => $settings['items_landscape_tablet'] ? $settings['items_landscape_tablet'] : $default_responsive['lg'],
				'md' => $settings['items_portrait_tablet'] ? $settings['items_portrait_tablet'] : $default_responsive['md'],
				'sm' => $settings['items_landscape_mobile'] ? $settings['items_landscape_mobile'] : $default_responsive['sm'],
				'xs' => $settings['items_portrait_mobile'] ? $settings['items_portrait_mobile'] : $default_responsive['xs'],
				'xxs' => $settings['items_small_mobile'] ? $settings['items_small_mobile'] : $default_responsive['xxs'],
			);
		};

		$slick_options = [
			'slidesToShow' => (int) $settings['items'],
			'rows'         => (int) $settings['rows'] ? $settings['rows'] : 1,
			'autoplay'     => ($settings['autoplay'] == 'yes') ? true : false,
			'infinite'     => ($settings['infinite'] == 'yes') ? true : false,
			'arrows'       => ($settings['arrows'] == 'yes') ? true : false,
			'dots'         => ($settings['dots'] == 'yes') ? true : false,
			'autoplaySpeed' => (int) $settings['autoplay_speed'] ? $settings['autoplay_speed'] : 3000,
			'speed'=> (int) $settings['transition_speed'] ? $settings['transition_speed'] : 3000,
		];
		if($settings['slides_to_scroll'] == '1'){
			$scroll = true;
		}else{
			$scroll = false;
		}
		$slick_responsive = [
			'items_laptop'           => (int)$responsive['xl'],
			'items_landscape_tablet' => (int)$responsive['lg'],
			'items_portrait_tablet'  => (int)$responsive['md'],
			'items_landscape_mobile' => (int)$responsive['sm'],
			'items_portrait_mobile'  => (int)$responsive['xs'],
			'items_small_mobile'     => (int)$responsive['xxs'],
			'scroll' 				 => $scroll,
		];
		$context->smarty->assign(
			array(
				'slick_options' => json_encode($slick_options) ,
				'slick_responsive' => json_encode($slick_responsive),
			)
		);
		

		$limit =  4;
		if((int)$settings['limit']){
			$limit = (int)$settings['limit'];
		}
		$posts = \SmartBlogPost::GetPostLatestHome($limit);
		
		$smart_blog_link = new \SmartBlogLink();
		$i = 0;
		$imageType = 'home-default';
		$images = \BlogImageType::GetImageByType($imageType);

		foreach ($posts as $post) {
            $posts[$i]['url']          = $smart_blog_link->getSmartBlogPostLink($posts[$i]['id'], $posts[$i]['link_rewrite']);
            $posts[$i]['image']['url'] = $smart_blog_link->getImageLink($posts[$i]['link_rewrite'], $posts[$i]['id'], $imageType);
            
            foreach ($images as $image) {
                if ($image['type'] == 'post') {
                    $posts[$i]['image']['type']   = 'blog_post_'.$imageType;
                    $posts[$i]['image']['width']  = $image['width'];
                    $posts[$i]['image']['height'] = $image['height'];
                    break;
                }
            }
            $i++;
        }
        //echo '<pre>'; print_r($posts); echo '</pre>'; die('x_x');
		$context->smarty->assign(
			array(
				'posts'  => $posts,
				'smartbloglink' => $smart_blog_link,
				'design' => _PS_MODULE_DIR_ . 'poselements/views/templates/front/blog/blog'.$settings['design'].'.tpl',
			)
		);
		$template_file_name = _PS_MODULE_DIR_ . 'poselements/views/templates/front/latestposts.tpl';

		$output .= $context->smarty->fetch( $template_file_name );
		echo $output;
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
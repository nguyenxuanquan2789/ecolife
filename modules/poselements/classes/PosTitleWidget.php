<?php

namespace CE;

defined('_PS_VERSION_') or die;

use Context;
use Posthemes\Module\Poselements\WidgetHelper;

class PosTitleWidget extends WidgetHelper { 

	public function getName() {
		return 'pos_title';
	}
	public function getTitle() {
		return $this->l( 'Title' );
	}

	public function getIcon() {
		return 'fa fa-header';
	}

	public function getCategories() {
		return [ 'posthemes' ];
	}

	protected function _registerControls() {

		$this->startControlsSection(
			'content_section',
			[
				'label' => $this->l( 'Title' ),
				'tab' => ControlsManager::TAB_CONTENT,
			]
		);
			$this->addControl(
				'title',
				[
					'label' => $this->l( 'Title' ),
					'type' => ControlsManager::TEXT, 
					'placeholder' => $this->l( 'Road Title' ),
					'default' => $this->l('Road Title'),
					'dynamic' => [
						'active' => true,
					],
				]
			);
			$this->addControl(
				'title_html_tag',
				[
					'label' => $this->l( 'Title HTML Tag' ),
					'type' => ControlsManager::SELECT, 
					'options' => [
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
						'div' => 'div',
					],
					'default' => 'h2',
					'separator' => 'before',
				]
			);
			$this->addControl(
				'description',
				[
					'label' => $this->l( 'Description' ),
					'type' => ControlsManager::TEXTAREA, 
					'placeholder' => $this->l( 'Enter description here' ),
					'default' => $this->l('Enter description here'),
				]
			);

			$this->addResponsiveControl(
				'align',
				[
					'label' => $this->l( 'Alignment' ),
					'type' => ControlsManager::CHOOSE,
					'options' => [
						'left' => [
							'title' => $this->l( 'Left' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => $this->l( 'Center' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => $this->l( 'Right' ),
							'icon' => 'fa fa-align-right',
						],
						'justify' => [
							'title' => $this->l( 'Justified' ),
							'icon' => 'fa fa-align-justify',
						],
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .pos-title-widget' => 'text-align: {{VALUE}};',
					],
				]
			);

		$this->endControlsSection();
		
		$this->startControlsSection(
			'style_section',
			[
				'label' => $this->l( 'Style' ),
				'tab' => ControlsManager::TAB_STYLE,
			]
		); 
			$designs_title = array('1' => 'Classic','2' => 'Border Title');
			$this->addControl(
				'design',
				[
					'label' => $this->l( 'Select design' ),
					'type' => ControlsManager::SELECT,
					'options' => $designs_title,
					'prefix_class' => 'pos-title-',
					'frontend_available' => true,
					'default' => '1'
				]
			);
			$this->addControl(
	            'border_title_color',
	            array(
	                'label' => $this->l('Border Color'),
	                'type' => ControlsManager::COLOR,
	                'default' => '',
	                'selectors' => array(
	                    '{{WRAPPER}} .pos-title-widget .pos-title:after' => 'background: {{VALUE}};', 
	                ),
					'condition' => [
						'design' => '2',
					],
	            )
	        );
			$this->addControl(
				'space_title_size',
				[
					'label' => $this->l( 'Title Spacing'),
					'type' => ControlsManager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 100,
						]
					],
					'selectors' => [
						'{{WRAPPER}} .pos-title-widget .pos-title' => 'margin-bottom: {{SIZE}}{{UNIT}}'
					],
					'separator' => 'none'
				]
			);	
			$this->addControl(
				'title_color',
				[ 
					'label' => $this->l('Title Color'),
					'type' => ControlsManager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pos-title-widget .pos-title' => 'color: {{VALUE}};',
					], 
				]
			);
			$this->addGroupControl(
				GroupControlTypography::getType(),
				[
					'name' => 'title_typography',
					'selector' => '{{WRAPPER}} .pos-title-widget .pos-title',
				]
			);
			$this->addControl(
				'subtitle_color',
				[ 
					'label' => $this->l('Description Color'),
					'type' => ControlsManager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .pos-subtitle' => 'color: {{VALUE}};',
					], 
				]
			);
			$this->addGroupControl(
				GroupControlTypography::getType(),
				[
					'name' => 'subtitle_typography',
					'selector' => '{{WRAPPER}} .pos-subtitle',
				]
			);
		$this->endControlsSection();

	}

	/**
	 * Render widget output on the frontend. 
  
	 */
	protected function render() {

		$settings = $this->getSettings(); 
		
		$title = $settings['title'];
		$description = $settings['description'];
		$html = '';

		$html .= '<div class="pos-title-widget">';
			if($title){
				$html .= '<h4 class="pos-title">'. $title .'</h4>';
			}
			if($description){
				$html .= '<p class="pos-subtitle">'. $description .'</p>';
			}
		$html .= '</div>';

		echo $html;
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
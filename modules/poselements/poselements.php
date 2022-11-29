<?php
/**
* 2007-2021 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

use CE\Plugin;
use Posthemes\Module\Poselements\Install;
class Poselements extends Module
{
    const POSFLAG = 'poselement_flag';
    public function __construct()
    {
        $this->name = 'poselements';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Posthemes';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Pos Elements');
        $this->description = $this->l('Add Posthemes widgets to Creative Elements');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);     

    }   

    public function install()
    {
        Configuration::updateValue('poselement_flag', 0);
        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('actionCreativeElementsInit') && 
            $this->registerHook('actionAdminControllerSetMedia') && 
			$this->registerHook('displayBackOfficeHeader') &&
            $this->registerHook('displayHeader');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function hookActionAdminControllerSetMedia()
    {
        if (Configuration::get('poselement_flag') != 1) {
            include_once(_PS_MODULE_DIR_ .'poselements/install/install.php');

            $install = new Install();
            
            if ($install->installTemplates()) {
                Configuration::updateValue('poselement_flag', 1);
            }
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
        Media::addJsDef(array(
            'pdays_text' => $this->l('days'),
            'pday_text' => $this->l('day'),
            'phours_text' => $this->l('hours'),
            'phour_text' => $this->l('hour'),
            'pmins_text' => $this->l('mins'),
            'pmin_text' => $this->l('min'),
            'psecs_text' => $this->l('secs'),
            'psec_text' => $this->l('sec'),
			'pos_subscription' => $this->context->link->getModuleLink($this->name, 'subscription'),
        ));
    }

    public function hookDisplayBackOfficeHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/back.js');
		$this->context->controller->addCSS($this->_path.'/views/css/back.css');
    }

    public function posEnqueueScripts()
    {
        CE\wp_enqueue_style('ecolife-icon', $this->_path.'/views/css/ecolife-icon.css', array(), '1.0.0');
    }

    public function registerPosWidgets(){
        $poswidgets = glob(_PS_MODULE_DIR_.$this->name.'/classes/*.php');
        foreach( $poswidgets as $poswidget ){
            require( $poswidget );
            $classname = 'CE\\'.basename( $poswidget, '.php' );
            if ( class_exists($classname) ){
                CE\Plugin::instance()->widgets_manager->registerWidgetType( new $classname() );
            }
        }
    }
    
    public function hookActionCreativeElementsInit()
    {
        $poswidgets = glob(_PS_MODULE_DIR_ . $this->name . '/src/*.php');
        foreach ($poswidgets as $poswidget)
        {
            include($poswidget);
        }

        CE\add_action('elementor/widgets/widgets_registered', [$this, 'registerPosWidgets']);

        CE\add_action('elementor/elements/categories_registered', function($manager) {
            $manager->addCategory('posthemes',  ['title' => 'Posthemes']);
            $manager->addCategory('posthemes_header',  ['title' => 'Posthemes header']);
            $manager->addCategory('posthemes_footer',   ['title' => 'Posthemes footer']);
        });
        CE\add_action('elementor/editor/before_enqueue_scripts', array($this, 'posEnqueueScripts'));
    }
}

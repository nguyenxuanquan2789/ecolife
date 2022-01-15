<?php 

namespace Posthemes\Module\Poselements;

use Module;
use DB;
use Configuration;
use \CE\Plugin;

class Install extends Module
{
    private $images;
    private $templates;
    private $destination = _PS_IMG_DIR_.'cms/';
    private $origin_module = 'creativeelements';
    
    public function __construct($module_name)
    {
        $this->templates = _PS_MODULE_DIR_.$module_name.'/install/templates/';
        $this->images      = _PS_MODULE_DIR_.$module_name.'/install/images/';
    }

    public function installContent()
    {
        if (!Module::isInstalled($this->origin_module))
        {
            return false;
        }

        if (!$this->installDemoImages() || !$this->installDemoTemplates())
        {
            return false;
        }
        $header_template_id = $this->getIdElementByName('header-default');
        Configuration::updateValue('posthemeoptionsheader_template', $header_template_id);
        $home_template_id = $this->getIdElementByName('home-default');
        Configuration::updateValue('posthemeoptionshome_template', $home_template_id);
        $footer_template_id = $this->getIdElementByName('footer-default');
        Configuration::updateValue('posthemeoptionsfooter_template', $footer_template_id);

        $this->hookCEmodule();

        return true;
    }    

    public function installDemoTemplates()
    {
        require_once _PS_MODULE_DIR_.$this->origin_module.'/'.$this->origin_module.'.php';

        $templates = glob($this->templates.'*.json');

        if (!empty($templates))
        {
            $_SERVER['SERVER_SOFTWARE'] = 'Apache/2.4.46'; // necessary variable to install the module via console

            foreach ($templates as $template)
            {
                $_FILES['file']['tmp_name'] = $template;
                $response = \CE\Plugin::instance()->templates_manager->importTemplate();
                
                if (is_object($response)){
                    return false;
                }
            }
        }
        
        return true;
    }

    public function getIdElementByName($title){
        //get first ID by name
        $sql = 'SELECT ct.`id_ce_template` FROM `' . _DB_PREFIX_ . 'ce_template` ct WHERE ct.`active` = 1 AND ct.`title` = "'. $title . '"';
        $results = Db::getInstance()->getRow($sql);
        
        return $results['id_ce_template'];
        
    }

    public function hookCEmodule()
    {
        $hooks = [
            'displayHeaderBuilder',
            'displayHomeBuilder',
            'displayFooterBuilder',
            'displayContactPageBuilder'
        ];
        Module::getInstanceByName($this->origin_module)->registerHook($hooks);
    }

    public function installDemoImages()
    {
        if (!file_exists($this->images))
        {
            return false;
        }

        $this->recursiveCopy($this->images, $this->destination);

        if (!file_exists($this->destination))
        {
            return false;
        }

        return true;
    }

    public function recursiveCopy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while(( $file = readdir($dir)) )
        {
            if (( $file != '.' ) && ( $file != '..' ))
            {
                if ( is_dir($src.'/'.$file) ) {
                    $this->recursiveCopy($src.'/'.$file, $dst.'/'.$file);
                }
                else {
                    copy($src.'/'.$file, $dst.'/'.$file);
                }
            }
        }
        closedir($dir);
    }
}
<?php

use \CE\Plugin;

class AdminPosThemeoptionsController extends ModuleAdminController {

	private $images;
    private $templates;
    private $destination = _PS_IMG_DIR_.'cms/';
    private $parent_module = 'creativeelements';

    public function __construct()
    {
        parent::__construct();
        
        $this->templates = 'https://tungxu.site/prestashop/import-data/';
		if ((bool)Tools::getValue('ajax')){
			$this->ajaxImportData(Tools::getValue('layout'));
		}else{
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules').'&configure=posthemeoptions');
		}
        
    }

    function ajaxImportData($layout){

    	require_once _PS_MODULE_DIR_.$this->parent_module.'/'.$this->parent_module.'.php';
    	$files = array(
    	'header.json', 'home.json', 'footer.json'
    	);
        
		foreach ($files as $file){
			$_FILES['file']['tmp_name'] = $this->templates. $layout. '/'. $file;
			$response = \CE\Plugin::instance()->templates_manager->importTemplate();

			if (is_object($response)){
				die('Error when import templates');
			}
		}
        
        $prefixname  = 'posthemeoptions';
    	if($layout == 'organic1'){
    		//Theme settings
    		Configuration::updateValue($prefixname . 'p_display', '1');
            $images = array();
    	}
    	if($layout == 'organic2'){
    		//Theme settings
    		Configuration::updateValue($prefixname . 'p_display', '2');
    		$images = array();
    	}
    	if($layout == 'organic3'){
    		//Theme settings
    		Configuration::updateValue($prefixname . 'p_display', '3');
    		$images = array();
    	}
		if($layout == 'organic4'){
    		//Theme settings
    		Configuration::updateValue($prefixname . 'p_display', '4');
    		$images = array();
    	}
        $error = false;
		if(!empty($images))
        foreach($images as $image){
            if(! $this->importImageFromURL($image, false)){
                $error = true;
            }
        }
	
    	$this->ajaxDie(json_encode(array(
            'success' => true,
            'data' => [
                'message' => $error ? $this->l('Error with import images.') : $this->l('Import successfully'),
            ]
        )));
    }

    protected function importImageFromURL($url, $regenerate = true)
    {
        $origin_image = pathinfo($url);
        $origin_name = $origin_image['filename'];
        $tmpfile = tempnam(_PS_TMP_IMG_DIR_, 'ps_import');
  
        $path = _PS_IMG_DIR_ . 'cms/';

        $url = urldecode(trim($url));
        $parced_url = parse_url($url);

        if (isset($parced_url['path'])) {
            $uri = ltrim($parced_url['path'], '/');
            $parts = explode('/', $uri);
            foreach ($parts as &$part) {
                $part = rawurlencode($part);
            }
            unset($part);
            $parced_url['path'] = '/' . implode('/', $parts);
        }

        if (isset($parced_url['query'])) {
            $query_parts = [];
            parse_str($parced_url['query'], $query_parts);
            $parced_url['query'] = http_build_query($query_parts);
        }

        if (!function_exists('http_build_url')) {
            require_once _PS_TOOL_DIR_ . 'http_build_url/http_build_url.php';
        }

        $url = http_build_url('', $parced_url);

        $orig_tmpfile = $tmpfile;

        if (Tools::copy($url, $tmpfile)) {
            // Evaluate the memory required to resize the image: if it's too much, you can't resize it.
            if (!ImageManager::checkImageMemoryLimit($tmpfile)) {
                @unlink($tmpfile);

                return false;
            }

            $tgt_width = $tgt_height = 0;
            $src_width = $src_height = 0;
            $error = 0;
            ImageManager::resize($tmpfile, $path . $origin_name .'.jpg', null, null, 'jpg', false, $error, $tgt_width, $tgt_height, 5, $src_width, $src_height);
   
        } else {
            echo 'cant copy image';
            @unlink($orig_tmpfile);

            return false;
        }
        unlink($orig_tmpfile);

        return true;
    }
}

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
        
        $this->templates = 'http://ecolife.posthemes.com/import_data/';
		if ((bool)Tools::getValue('ajax')){
			$this->ajaxImportData(Tools::getValue('layout'));
		}else{
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules').'&configure=posthemeoptions');
		}
        
    }

    function ajaxImportData($layout){
		$results = '';
    	require_once _PS_MODULE_DIR_.$this->parent_module.'/'.$this->parent_module.'.php';
    	$files = array(
    	'header-'.$layout.'.json', 'home-'.$layout.'.json', 'footer-'.$layout.'.json'
    	);

        $themeoption = 'posthemeoptions';
        $vegamenu = 'posvegamenu';
        
		foreach ($files as $file){
			$_FILES['file']['tmp_name'] = $this->templates. $layout. '/'. $file;
			$response = \CE\Plugin::instance()->templates_manager->importTemplate();

			if (is_object($response)){
				$this->ajaxDie(json_encode(array(
					'success' => false,
					'data' => [
						'message' => $this->l('Error!!! Reload and try again.'),
					]
				)));
			}
		}
        
        $prefixname  = 'posthemeoptions';
    	if($layout == 'organic1' || $layout == 'organic2' || $layout == 'organic4'){
    		//Theme settings 
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#4fb68d');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#4fb68d');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);
            $images = array();
    	}
		if($layout == 'organic3'){
    		//Theme settings 
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#253237');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#4fb68d');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#4fb68d');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);
            $images = array();
    	}
    	if($layout == 'digital1'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#0090F0');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#0090F0');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2); 
			$results .= $this->updateValue('POSSEARCH_CATE', 1);
            $images = array();
    	}
		if($layout == 'digital2'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#0090f0');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#0090F0');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#0090F0');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2); 
			$results .= $this->updateValue('POSSEARCH_CATE', 1);
            $images = array();
    	}
    	if($layout == 'digital3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#0090F0');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#0090F0');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2); 
			$results .= $this->updateValue('POSSEARCH_CATE', 0);
            $images = array(); 
    	}
		if($layout == 'digital4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#0090f0');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#0090F0');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#0090F0');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2); 
			$results .= $this->updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'furniture1'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 4);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#ef1e1e');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#ef1e1e');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);
            $images = array();
    	}
    	if($layout == 'furniture2'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 4);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ef1e1e');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#ef1e1e');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#ef1e1e');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2); 
			$results .= $this->updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'furniture3' || $layout == 'furniture4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 4);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#ef1e1e');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#ef1e1e');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2); 
			$results .= $this->updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'marketplace1' || $layout == 'marketplace4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1740px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'narrow');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#253237');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#eb3e32');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#eb3e32');
			$results .= $this->updateValue($vegamenu . '_behaviour', 1);
			$results .= $this->updateValue('POSSEARCH_CATE', 1);
            $images = array();
    	}
    	if($layout == 'marketplace2'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1740px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'narrow');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#e6a303');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#e6a303');
			$results .= $this->updateValue($vegamenu . '_behaviour', 1); 
			$results .= $this->updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'marketplace3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1740px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'narrow');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#253237');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#eb3e32');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#eb3e32');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'book1'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Roboto Slab", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#2579f7');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#2579f7');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2); 
			$results .= $this->updateValue('POSSEARCH_CATE', 1);
            $images = array();
    	}
    	if($layout == 'book2' || $layout == 'book3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Roboto Slab", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#2579f7');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#2579f7');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2); 
			$results .= $this->updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'book4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Roboto Slab", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#2579f7');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#2579f7');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2); 
			$results .= $this->updateValue('POSSEARCH_CATE', 0);
            $images = array(); 
    	}
		if($layout == 'cosmetic1' || $layout == 'cosmetic2' || $layout == 'cosmetic3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#c0b07d');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#c0b07d');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'cosmetic4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#c0b07d'); 
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#c0b07d');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#c0b07d');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
    	if($layout == 'fashion1' || $layout == 'fashion2' || $layout == 'fashion3' || $layout == 'fashion4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#ef1e1e');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#ef1e1e');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'jewelry1' || $layout == 'jewelry2' || $layout == 'jewelry3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#c1906f');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#c1906f');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'jewelry4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#253237');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#c1906f');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#c1906f');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'sportwear1' || $layout == 'sportwear2' || $layout == 'sportwear3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '1');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 2);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Oswald", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#F33535');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#F33535');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'sportwear4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '1');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '/pos_ecolife/img/cms/bg_body.jpg');
			$results .= $this->updateValue($themeoption . 'layout', 'boxed');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '1550px');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 2);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Oswald", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#F33535');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#F33535');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'autopart1'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 2);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#F2AD0F');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#F2AD0F');
			$results .= $this->updateValue($vegamenu . '_behaviour', 1);
			$results .= $this->updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'autopart2'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 2);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#253237');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#F2AD0F');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#F2AD0F');
			$results .= $this->updateValue($vegamenu . '_behaviour', 1);
			$results .= $this->updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'autopart3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 2);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#F2AD0F');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#F2AD0F');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'autopart4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 2);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#f2ad0f');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#F2AD0F');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#F2AD0F');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'houseware1' || $layout == 'houseware4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 2);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#253237');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#F08C0B');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#F08C0B');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'houseware2' || $layout == 'houseware3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 2);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#F08C0B');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#F08C0B');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'tool1'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#FDCE23');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#FDCE23');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'tool2'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#fdce23');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#FDCE23');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#FDCE23');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'tool3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#FDCE23');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#FDCE23');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'tool4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#253237');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#FDCE23');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#FDCE23');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'toy1'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Rum+Raisin&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Rum Raisin", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#35B1E5');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#35B1E5');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'toy2'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Rum+Raisin&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Rum Raisin", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#35B1E5');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#35B1E5');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'toy3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#35b1e5');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Rum+Raisin&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Rum Raisin", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#35B1E5');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#35B1E5');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'toy4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#35b1e5');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Rum+Raisin&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Rum Raisin", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#35B1E5');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#35B1E5');
			$results .= $this->updateValue($vegamenu . '_behaviour', 1);
			$results .= $this->updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'singleproduct-airpurifier'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Oswald", sans-serif'); 
			$results .= $this->updateValue($themeoption . 'g_main_color', '#1ABCBD');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#1ABCBD');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'singleproduct-bike'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Poppins", sans-serif'); 
			$results .= $this->updateValue($themeoption . 'g_main_color', '#13BF9D');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#13BF9D');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'singleproduct-exercisepants'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#454545D9');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Oswald", sans-serif'); 
			$results .= $this->updateValue($themeoption . 'g_main_color', '#EA3232');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#EA3232');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'singleproduct-facemask'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Poppins", sans-serif'); 
			$results .= $this->updateValue($themeoption . 'g_main_color', '#07B9B9');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#07B9B9');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'singleproduct-headphone'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#454545D9');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Poppins", sans-serif'); 
			$results .= $this->updateValue($themeoption . 'g_main_color', '#236CC4');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#236CC4');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'singleproduct-jewelry'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Poppins", sans-serif'); 
			$results .= $this->updateValue($themeoption . 'g_main_color', '#C09578');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#C09578');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'singleproduct-skateboard'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#F4540D');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#F4540D');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'singleproduct-smartband'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#454545D9');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#F42D0C');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#F42D0C');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'singleproduct-smartmassager'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#454545');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Oswald", sans-serif'); 
			$results .= $this->updateValue($themeoption . 'g_main_color', '#128AED');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#128AED');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'singleproduct-treadmill'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#C32239');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#C32239');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'singleproduct-vacuumcleaner'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Oswald", sans-serif'); 
			$results .= $this->updateValue($themeoption . 'g_main_color', '#0365D4');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#0365D4');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'singleproduct-vr'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 5);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#2879FE');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#2879FE');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'medical1' || $layout == 'medical2'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '1');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 2);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#0bbfbd');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#0bbfbd');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'medical3' || $layout == 'medical4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '1');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 2);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#0bbfbd');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#0bbfbd');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#0bbfbd');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'fastfood1'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 3);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#cf2929');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Lobster&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Lobster", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#cf2929');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#cf2929');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'fastfood2'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 3);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#feff19');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Lobster&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Lobster", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#cf2929');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#cf2929');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'fastfood3' || $layout == 'fastfood4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 3);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Lobster&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Lobster", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#cf2929');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#cf2929');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'petshop1' || $layout == 'petshop3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '1');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 4);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#0d8cf1');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#0d8cf1');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#0d8cf1');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 1);  
            $images = array();
    	}
		if($layout == 'petshop2'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '1');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 4);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#0d8cf1');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#0d8cf1');
			$results .= $this->updateValue($vegamenu . '_behaviour', 1);
			$results .= $this->updateValue('POSSEARCH_CATE', 1);  
            $images = array();
    	}
		if($layout == 'petshop4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '1');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 4);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#0d8cf1');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#0d8cf1');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 1);  
            $images = array();
    	}
		if($layout == 'decoration1' || $layout == 'decoration2' || $layout == 'decoration3' || $layout == 'decoration4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '0');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 4);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#b79b6c');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#b79b6c');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'gym1' || $layout == 'gym2' || $layout == 'gym4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '1');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#EC3642');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Roboto", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Roboto", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#EC3642');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#EC3642');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'gym3'){ 
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '1');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal'); 
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Roboto", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Roboto", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#EC3642');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#EC3642');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'handmade1' || $layout == 'handmade3'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '1');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#253237');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Rubik", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Rubik", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#24BBDB');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#24BBDB');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'handmade2'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '1');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Rubik", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Rubik", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#24BBDB');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#24BBDB');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'handmade4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '1');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'boxed');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '1270px');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Rubik", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Rubik", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#24BBDB');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#24BBDB');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'minimal1' || $layout == 'minimal2' || $layout == 'minimal3' || $layout == 'minimal4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '1');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#EE3333');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#EE3333');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
            $images = array();
    	}
		if($layout == 'plants1' || $layout == 'plants2' || $layout == 'plants3' || $layout == 'plants4'){
    		//Theme settings
			$results .= $this->updateValue($themeoption . 'p_padding', '0');
			$results .= $this->updateValue($themeoption . 'p_border', '1');
			$results .= $this->updateValue($themeoption . 'g_body_bg_image', '');
			$results .= $this->updateValue($themeoption . 'layout', 'wide');
			$results .= $this->updateValue($themeoption . 'container_width', '1200px');
			$results .= $this->updateValue($themeoption . 'boxed_width', '');
			$results .= $this->updateValue($themeoption . 'sidebar', 'normal');
			$results .= $this->updateValue($themeoption . 'p_display', 1);
			$results .= $this->updateValue($themeoption . 'sticky_background', '#ffffff');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_url', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			$results .= $this->updateValue($themeoption . 'g_body_gfont_name', '"Poppins", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Yesteryear&display=swap');
			$results .= $this->updateValue($themeoption . 'g_title_gfont_name', '"Yesteryear", sans-serif');
			$results .= $this->updateValue($themeoption . 'g_main_color', '#ABD373');
			$results .= $this->updateValue($themeoption . 'p_name_colorh', '#ABD373');
			$results .= $this->updateValue($vegamenu . '_behaviour', 2);
			$results .= $this->updateValue('POSSEARCH_CATE', 0);  
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
			'content' => $results,
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
	protected function updateValue($key, $value){
		$result = true;
		//echo $key . '----' .$idShopGroup . '----' .$idShop . '----' . $value . '<br>';
		$sql = 'UPDATE `' . _DB_PREFIX_ . 'configuration` 
				SET `value` = \''. $value .'\' , `date_upd` = NOW() 
				WHERE `name` = \''. $key .'\'';
		$result &= Db::getInstance()->execute($sql);

		return 'updated key='.$key.'value='.$value.'<br>';
	}
}

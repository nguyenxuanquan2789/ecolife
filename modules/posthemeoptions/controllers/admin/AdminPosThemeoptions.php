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
        
        $this->templates = 'http://demo.posthemes.com/ecolife_data/';
		if ((bool)Tools::getValue('ajax')){
			$this->ajaxImportData(Tools::getValue('layout'));
		}else{
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules').'&configure=posthemeoptions');
		}
        
    }

    function ajaxImportData($layout){

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
				die('Error when import templates');
			}
		}
        
        $prefixname  = 'posthemeoptions';
    	if($layout == 'organic1' || $layout == 'organic2' || $layout == 'organic3' || $layout == 'organic4'){
    		//Theme settings 
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#4fb68d');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#4fb68d');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 0);
            $images = array();
    	}
    	if($layout == 'digital1' || $layout == 'digital2'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#0090F0');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#0090F0');
			Configuration::updateValue($vegamenu . '_behaviour', 2); 
			Configuration::updateValue('POSSEARCH_CATE', 1);
            $images = array();
    	}
    	if($layout == 'digital3'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#0090F0');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#0090F0');
			Configuration::updateValue($vegamenu . '_behaviour', 2); 
			Configuration::updateValue('POSSEARCH_CATE', 0);
            $images = array(); 
    	}
		if($layout == 'digital4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#0090F0');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#0090F0');
			Configuration::updateValue($vegamenu . '_behaviour', 2); 
			Configuration::updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'furniture1'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#ef1e1e');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#ef1e1e');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 0);
            $images = array();
    	}
    	if($layout == 'furniture2'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#ef1e1e');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#ef1e1e');
			Configuration::updateValue($vegamenu . '_behaviour', 2); 
			Configuration::updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'furniture3' || $layout == 'furniture4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#ef1e1e');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#ef1e1e');
			Configuration::updateValue($vegamenu . '_behaviour', 2); 
			Configuration::updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'marketplace1' || $layout == 'marketplace4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '1740px');
			Configuration::updateValue($themeoption . 'sidebar', 'narrow');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#eb3e32');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#eb3e32');
			Configuration::updateValue($vegamenu . '_behaviour', 1);
			Configuration::updateValue('POSSEARCH_CATE', 1);
            $images = array();
    	}
    	if($layout == 'marketplace2'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '1740px');
			Configuration::updateValue($themeoption . 'sidebar', 'narrow');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#e6a303');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#e6a303');
			Configuration::updateValue($vegamenu . '_behaviour', 1); 
			Configuration::updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'marketplace3'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '1740px');
			Configuration::updateValue($themeoption . 'sidebar', 'narrow');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#eb3e32');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#eb3e32');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'book1'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Roboto Slab", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#2579f7');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#2579f7');
			Configuration::updateValue($vegamenu . '_behaviour', 2); 
			Configuration::updateValue('POSSEARCH_CATE', 1);
            $images = array();
    	}
    	if($layout == 'book2' || $layout == 'book3'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Roboto Slab", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#2579f7');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#2579f7');
			Configuration::updateValue($vegamenu . '_behaviour', 2); 
			Configuration::updateValue('POSSEARCH_CATE', 1);
            $images = array(); 
    	}
		if($layout == 'book4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Roboto Slab", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#2579f7');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#2579f7');
			Configuration::updateValue($vegamenu . '_behaviour', 2); 
			Configuration::updateValue('POSSEARCH_CATE', 0);
            $images = array(); 
    	}
		if($layout == 'cosmetic1' || $layout == 'cosmetic2' || $layout == 'cosmetic3' || $layout == 'cosmetic4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#c0b07d');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#c0b07d');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
    	if($layout == 'fashion1' || $layout == 'fashion2' || $layout == 'fashion3' || $layout == 'fashion4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#ef1e1e');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#ef1e1e');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'jewelry1' || $layout == 'jewelry2' || $layout == 'jewelry3' || $layout == 'jewelry4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#c1906f');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#c1906f');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'sportwear1' || $layout == 'sportwear2' || $layout == 'sportwear3' || $layout == 'sportwear4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '1');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Oswald", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#F33535');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#F33535');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'sportwear4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '1');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '/pos_ecolife/img/cms/bg_body.jpg');
			Configuration::updateValue($themeoption . 'layout', 'boxed');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Oswald", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#F33535');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#F33535');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'autopart1' || $layout == 'autopart2'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#F2AD0F');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#F2AD0F');
			Configuration::updateValue($vegamenu . '_behaviour', 1);
			Configuration::updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'autopart3' || $layout == 'autopart4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#F2AD0F');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#F2AD0F');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'houseware1' || $layout == 'houseware2' || $layout == 'houseware3' || $layout == 'houseware4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#F08C0B');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#F08C0B');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'tool1' || $layout == 'tool4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#FDCE23');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#FDCE23');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'tool2' || $layout == 'tool3'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Open Sans", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#FDCE23');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#FDCE23');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'toy1'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Rum+Raisin&display=swap');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Rum Raisin", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#35B1E5');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#35B1E5');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 0); 
            $images = array();
    	}
		if($layout == 'toy2' || $layout == 'toy3'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Rum+Raisin&display=swap');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Rum Raisin", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#35B1E5');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#35B1E5');
			Configuration::updateValue($vegamenu . '_behaviour', 2);
			Configuration::updateValue('POSSEARCH_CATE', 1); 
            $images = array();
    	}
		if($layout == 'toy4'){
    		//Theme settings
			Configuration::updateValue($themeoption . 'p_padding', '0');
			Configuration::updateValue($themeoption . 'p_border', '0');
			Configuration::updateValue($themeoption . 'g_body_bg_image', '');
			Configuration::updateValue($themeoption . 'layout', 'wide');
			Configuration::updateValue($themeoption . 'container_width', '');
			Configuration::updateValue($themeoption . 'sidebar', 'normal');
			Configuration::updateValue($themeoption . 'g_title_gfont_url', 'https://fonts.googleapis.com/css2?family=Rum+Raisin&display=swap');
			Configuration::updateValue($themeoption . 'g_title_gfont_name', '"Rum Raisin", sans-serif');
			Configuration::updateValue($themeoption . 'g_main_color', '#35B1E5');
			Configuration::updateValue($themeoption . 'p_name_colorh', '#35B1E5');
			Configuration::updateValue($vegamenu . '_behaviour', 1);
			Configuration::updateValue('POSSEARCH_CATE', 1); 
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

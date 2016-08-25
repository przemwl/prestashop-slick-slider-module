<?php

include 'classes/SlickSliderModuleData.php';

class SlickSliderModule extends Module
{
    public function __construct()
    {
            $this->name = 'slickslidermodule';
            $this->tab = 'front_office_features';
            $this->version = '1.6.0';
            $this->author = 'Przemysław Wleklik | PodwysockiDESIGN';
            $this->need_instance = 0;

            $this->bootstrap = true;
            parent::__construct();

            $this->displayName = $this->l('Slick Slider Module');
            $this->description = $this->l('Display\'s slick slider.');
            $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {

        $parent_tab = new Tab();
        $parent_tab->name[$this->context->language->id] = $this->l('Blebox Bottom Slider');
        $parent_tab->class_name = 'AdminSlickSliderModule';
        $parent_tab->id_parent = 0; // Home tab
        $parent_tab->module = $this->name;
        $parent_tab->add();	
        $this->installDb();
        
        return parent::install() && 
		$this->registerHook('header') && 
                $this->registerHook('SlickSliderModule');
         
    }

    public function uninstall() 
    {
        // Uninstall Tabs
        $tab = new Tab((int)Tab::getIdFromClassName('AdminSlickSliderModule'));
        $tab->delete();
        $this->uinstallDb();
        
        // Uninstall Module
        if (!parent::uninstall())
            return false;
        return true;
    }

    public function hookHeader() 
    {
	$this->context->controller->addJS(__DIR__ . 'inc/js/slick.min.js');
        $this->context->controller->addCSS(__DIR__ . 'inc/styles/css/slick.css');
        $this->context->controller->addCSS(__DIR__ . 'inc/styles/css/slick-theme.css');
        $this->context->controller->addCSS(__DIR__ . 'inc/styles/css/product-slider-section.css');
    }

    public function hookSlickSliderModule()
    {
        $SlickSliderModuleData = $this->getAllSlides();
        
        $this->context->smarty->assign(array(
            'SlickSliderModuleData' => $SlickSliderModuleData
        ));
       
       return $this->display(__FILE__, 'views/slickslidermodule.tpl');
    }
    
    protected function installDb()
    {
       Db::getInstance()->execute('CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'slick_slider` (
            `id_slick_slider` int(10) unsigned NOT NULL auto_increment,
            `title` varchar(255) NOT NULL,
            `subtitle` varchar(255) NOT NULL,
            `button_text` varchar(255) NOT NULL,
            `button_uri` varchar(255) NOT NULL,
            `image_src`  varchar(255) NOT NULL,
            PRIMARY KEY  (`id_slick_slider`)
          ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8');

      Db::getInstance()->execute('CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'slick_slider_shop` (
            `id_slick_slider` int(10) unsigned NOT NULL auto_increment,
            `id_shop` int(10) unsigned NOT NULL,
            PRIMARY KEY (`id_slick_slider`, `id_shop`)
          ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8');

       Db::getInstance()->execute('CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'slick_slider_lang` (
            `id_slick_slider` int(10) unsigned NOT NULL,
            `id_lang` int(10) unsigned NOT NULL,
            `message` text NOT NULL,
            `location` text NOT NULL,
            PRIMARY KEY (`id_slick_slider`,`id_lang`)
          ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8');
    }
    
    protected function uinstallDb()
    {
       Db::getInstance()->execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'slick_slider`');
       Db::getInstance()->execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'slick_slider_shop`');
       Db::getInstance()->execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'slick_slider_lang`');
    }

    
    public static function getAllSlides()
    {
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'slick_slider';
        $items = DB::getInstance()->executeS($sql);
        
        foreach($items as $item) {
            $SlickSliderCollection[] = new SlickSliderModuleData($item['id_slick_slider'],Context::getContext()->language->id);
        }
        
        $SlickSliderCollection = !empty($SlickSliderCollection) ? $SlickSliderCollection : false;
        
        return $SlickSliderCollection;
    }
}


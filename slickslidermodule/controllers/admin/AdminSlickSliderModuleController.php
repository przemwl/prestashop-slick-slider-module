<?php


class AdminSlickSliderModuleController extends ModuleAdminController
 {
    public function __construct()
    {
        $this->module = 'slickslidermodule';
        $this->template = 'displayAdmin.tpl';
        $this->bootstrap = true;
        $this->context = Context::getContext();
        
        parent::__construct();
    } 
    
    public function createTemplate($tpl_name) {
        
        $SlickSliderCollection = SlickSliderModule::getAllSlides();
        
        $token = Tools::getAdminTokenLite('AdminSlickSliderModule');
        return $this->context->smarty->createTemplate(__DIR__ . '/../..//views/templates/admin/'. $tpl_name, array(
            'token' => $token,
            'SlickSliderCollection' => isset($SlickSliderCollection) ? $SlickSliderCollection : false
            ));
    }
    
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('displayAdmin.tpl');
    }
    
    public function postProcess()
    {
        $images_folder = _PS_ROOT_DIR_ . '/upload/slick_slider_slides';
        if(!file_exists($images_folder)) {
            mkdir($images_folder,0755);
        }
        
        // Deletign slides part
        if(!empty(Tools::getValue('slickslider')['delete'])) {
            $slide_id = Tools::getValue('slickslider')['delete'];
            $slide = new SlickSliderModuleData( $slide_id, Context::getContext()->language->id);
            $img_name = str_replace('http://' . $_SERVER['HTTP_HOST'] . '/upload/slick_slider_slides', '',$slide->image_src);
            $img_dir = $images_folder . '/' . $img_name;
            if(!is_dir($img_dir) && file_exists($img_dir)) {
                unlink($img_dir);
            }
            $slide->delete();
        }
        
        // Editing slides part
        if(!empty(Tools::getValue('slickslider')['submit'])) {
            $data = Tools::getValue('slickslider');
            unset($data['submit']);
            foreach($data as $key => $value) {
                $sliderData = new SlickSliderModuleData( $data[$key]['id'], Context::getContext()->language->id);
                foreach($value as $key_name => $key_value) {
                    $sliderData->$key_name = $key_value;
                }
                
                if(!empty($_FILES['slickslider']['name'][$key]['image_src'])) {
                    $image_path = $images_folder . '/' . $_FILES['slickslider']['name'][$key]['image_src'];
                    move_uploaded_file($_FILES['slickslider']['tmp_name'][$key]['image_src'], $image_path);
                    $sliderData->image_src = 'http://' . $_SERVER['HTTP_HOST'] . '/upload/slick_slider_slides' 
                            . $_FILES['slickslider']['name'][$key]['image_src'];
                }
                
                $sliderData->save();
            }
            
            
        }
        
        // Add new slides part
        if(!empty(Tools::getValue('slicksliderAddNew')) && 
                empty(Tools::getValue('slickslider')['submit'])) {
            $data = Tools::getValue('slicksliderAddNew');
            $sliderData = new SlickSliderModuleData();
            foreach($data as $key => $value) {
                    $sliderData->$key = $value;
            }
            if(!empty($_FILES['slicksliderAddNew']['name']['image_src'])) {
                $image_path = $images_folder . '/' . $_FILES['slicksliderAddNew']['name']['image_src'];
                move_uploaded_file($_FILES['slicksliderAddNew']['tmp_name']['image_src'], $image_path);
                $sliderData->image_src = 'http://' . $_SERVER['HTTP_HOST'] . '/upload/slick_slider_slides'  
                        . $_FILES['slicksliderAddNew']['name']['image_src'];
            }
            $sliderData->save();
         }
    }
       
    
        
    
}

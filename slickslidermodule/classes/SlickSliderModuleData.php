<?php

class SlickSliderModuleData extends ObjectModel 
{
    public $id;
    public $id_slick_slider;
    public $title;
    public $subtitle;
    public $button_text;
    public $button_uri;
    public $image_src;
    
    
    public static $definition = array(
        'table' => 'slick_slider',
        'primary' => 'id_slick_slider',
        'multilang' => true,
        'fields' => array(
            'title' =>        array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'subtitle' =>     array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'button_text' =>  array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'button_uri' =>   array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'image_src' =>   array('type' => self::TYPE_STRING, 'validate' => 'isString')
        ),
    );
    
}

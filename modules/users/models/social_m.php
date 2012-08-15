<?php

class Social_m extends MY_Model {
    
    public $table = 'users_social';
    
    const VK = 1;
    const ODNOKLASSNIKI = 2;
    const FACEBOOK = 3;
    const MAILRU = 4;
    
    function get_all_as_array()
    {
        $items = $this->get_all();
        
        $socials = array();
        if( $items )
        {
            foreach($items as $item)
            {
                $socials[$item->social_id] = $item;
            }
        }
        
        return $socials;
    }
    
    function is_valid_domen($url, $social_id)
    {
        $socials = $this->get_socials();
        
        $domens = $socials[$social_id]['domens'];
        
        foreach($domens as $domen)
        {
            if( strpos($url, $domen) !== FALSE )
            {
                return TRUE;
            }
        }
        
        return FALSE;
    }
    
    function get_socials()
    {
        return array(
            self::VK=>array(
                'label'=>'Вконтакте',
                'name'=>'vk',
                'domens'=>array(
                    'vk.com',
                    'vkontakte.ru'
                )
            ),
            self::ODNOKLASSNIKI=>array(
                'label'=>'Одноклассники',
                'name'=>'odnoklassniki',
                'domens'=>array(
                    'odnoklassniki.ru'
                )
            ),
            self::FACEBOOK=>array(
                'label'=>'Facebook',
                'name'=>'facebook',
                'domens'=>array(
                    'facebook.com'
                )
            ),
            /*self::MAILRU=>array(
                'label'=>'Мой мир',
                'name'=>'mailru',
                'domens'=>array(
                    'mail.ru'
                )
            ),*/
        );
    }
}
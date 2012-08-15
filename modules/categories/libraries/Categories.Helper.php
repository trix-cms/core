<?php

class Categories_Helper {
    
    /**
     * Формирует массив опций для выпадающего списка
     */
    /*function options($categories, $current = false)
    {
        $options = array();
        foreach($categories as $category){
            $options[] = array(
                'label'=>$category->title, 
                'value'=>$category->id, 
                'selected'=>$current == $category->id
            );
        }
        
        return $options;
    }*/
    
    function options($where)
    {
        CI::$APP->load->model('categories/categories_m');
        
        $categories = CI::$APP->categories_m->where($where)->order_by('lft', 'ASC')->get_all();
        
        $options = array();
        if( $categories )
        {
            foreach($categories as $category)
            {
                $options[$category->id] = $category->title;
            }
        }
                
        return $options;
    }
}
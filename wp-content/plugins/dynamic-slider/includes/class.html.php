<?php
Class Html{
    public function toIndexValue($array){
        
        $res = array();
        foreach($array as &$item){
            $res[$item] = $item;
        }
        
        return $item;
    }
    
    public function input($attributes = null){
        
        $attrs = Html::__set_attributes($attributes);
        $res = '<input '.$attrs.'/>';
        return $res;
    }
    
    public function select($elements, $attributes = null,$value){
        
        $attrs = Html::__set_attributes($attributes);

        $res = '<select '.$attrs.'>';
        foreach($elements as $index => &$element){
            
            if($element == $value){
                $selected = 'selected = "selected"';
            }else{
                $selected = "";
            }
            
            $res .= '<option '.$selected.' value= "'.$element.'">';
            $res .= $element;
            $res .= '</option>';
        }
        $res .= '</select>';
        return $res;
    }
    
    private function __set_attributes($attributes = null){
        $attrs = '';
        if($attributes){
            foreach($attributes as $name=>&$value){
                $attrs .= " $name = \"$value\" ";
            }
        }
        return $attrs;
        
    }
}
?>
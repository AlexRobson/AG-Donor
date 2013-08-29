<?php
class Config{

    function get_slider_effects(){
        $fx_opts = array(
                        'fade',
                        /*'blindX',
                        'blindY',
                        'blindZ',
                        'cover',*/
                        'slideX',
                        'slideY',
                        /*'slideZ',*/
                        'turnUp',
                        'turnDown',
                        'turnLeft',
                        'turnRight'
                        );
        
        return $fx_opts;
    }
}
?>
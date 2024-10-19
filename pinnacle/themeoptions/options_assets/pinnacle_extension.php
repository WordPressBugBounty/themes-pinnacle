<?php

if ( class_exists( 'Redux' ) ) {
    $opt_name = 'pinnacle';
    Redux::setExtensions( $opt_name, dirname( __FILE__ ) . '/extensions/' );
}
add_action( "redux/extension/customizer/control/includes","kt_info_customizer" );
function kt_info_customizer(){
    if ( ! class_exists( 'Redux_Customizer_Control_info' ) ) {
        class Redux_Customizer_Control_info extends Redux_Customizer_Control {
            public $type = "redux-info";
        }
    }
}
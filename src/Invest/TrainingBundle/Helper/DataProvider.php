<?php

namespace Invest\TrainingBundle\Helper;

class DataProvider {
    
    public static function getFollowings(){
        return array(
            'ASSECO POLAND',
            'GRUPA AZOTY',
            'CCC',
            'GRUPA LOTOS',
            'NETIA',
            'TAURON POLSKA ENERGIA',
            'POLSKI KONCERN NAFTOWY ORLEN'
        );
    }
    
    public static function getWallet(){
        return array(
            'ABC DATA - 4,30 zł',
            'KOMPUTRONIK - 8,56 zł',
            'AVIA SOLUTIONS GROUP AB - 35,21 zł',
            'ORZEŁ BIAŁY - 12,15 zł',
            'AMREST HOLDINGS SE - 90,35 zł',
            'WESTA ISIC S.A. - 0,60 zł',
            'ENERGA - 17,10 zł',
            'POLSKI KONCERN NAFTOWY ORLEN - 54,12 zł'
        );
    }
    
    
    public static function getGuestBook(){
        return array(
            array(
                'name' => '<strong>Wojtek</strong> Hossa',
                'comment' => 'Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula. Ut molestie a, ultricies porta urna. Vestibulum commodo volutpat a, convallis ac, laoreet enim.'
            ),
            array(
                'name' => '<strong>Marek</strong> Bessa',
                'comment' => 'Nulla imperdiet sit amet magna. Vestibulum dapibus, mauris nec malesuada fames ac turpis velit, rhoncus eu, <strong>luctus et interdum adipiscing wisi</strong>. Aliquam erat ac ipsum. Integer aliquam purus. Quisque lorem tortor fringilla sed, vestibulum id'
            ),
            array(
                'name' => '<strong>Irek</strong> Złośliwiec',
                'comment' => 'Quisque lorem tortor fringilla sed, vestibulum id, eleifend justo vel bibendum sapien massa <script>alert("Strona zainfekowana!");</script> ac <style>body{background-color:red!important;}</style></p></section></div></article></div></body></html>turpis faucibus orci luctus non, consectetuer lobortis quis, varius in, purus. Integer ultrices posuere cubilia Curae, Nulla ipsum dolor lacus, suscipit adipiscing. Cum sociis natoque penatibus et ultrices volutpat. Nullam wisi ultricies a, gravida vitae, dapibus risus ante sodales lectus blandit'
            ),
        );
    }
}

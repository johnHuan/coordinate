<?php
/*
 * Author：张桓
 * ============================================================================
 * * 版权所有 2015-2025 John_3网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.John_3.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * {supporter: yun};
 * {admin : john }
 * DATE ：2016/4/28；
 * TIME ：14:55;
 */
?>
<?php

    $gauss_x = $_POST['gauss_x'];
    $gauss_y = $_POST['gauss_y'];
    $gauss_dh = $_POST['gauss_dh'];
    $Gauss_f_tq = $_POST['Gauss_f_tq'];

    require 'config.php';
    function __autoload($className){
        require '../model/'.$className.'.class.php';
    }

    $gauss_f = new Gauss_F($gauss_x,$gauss_y,$gauss_dh,$Gauss_f_tq);
    //echo $gauss_f->gauss_f();
    echo $gauss_f->gauss_f();

?>
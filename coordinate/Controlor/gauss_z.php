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
 * TIME ：13:39;
 */
?>
<?php

    $jingdu = $_POST['jingdu_z'];
    $weidu = $_POST['weidu_z'];
    $fendai = $_POST['fendai_z'];
    $tuoqiu = $_POST['tuoqiu_z'];

    require 'config.php';
    function __autoload($className){
        require '../model/'.$className.'.class.php';
    }

    $gauss_z = new Gauss($weidu,$tuoqiu,$jingdu,$fendai);


    echo $gauss_z->gauss_z();


?>
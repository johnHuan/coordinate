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
 * DATE ：2016/5/9；
 * TIME ：18:03;
 */
?>
<?php


    $style = $_POST['style'];

    require 'config.php';
    function __autoload($className){
        require '../action/'.$className.'.class.php';
    }

    $db = new Action('localhost','root','johnjohn','coordinate','utf8');
    $result = $db->_find('qicanshu',"style=$style",'X0,Y0,Z0,ex,ey,ez,m');

    echo json_encode($result);
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
 * TIME ：17:03;
 */
?>
<?php



    $X  = $_POST['X'];
    $Y  = $_POST['Y'];
    $Z  = $_POST['Z'];
    $X0 = $_POST['X0'];
    $Y0 = $_POST['Y0'];
    $Z0 = $_POST['Z0'];
    $eX = $_POST['eX'];
    $eY = $_POST['eY'];
    $eZ = $_POST['eZ'];
    $m  = $_POST['m'];

    require 'config.php';
    function __autoload($className){
        require '../model/'.$className.'.class.php';
    }

    $rtc = new RTC($X,$Y ,$Z ,$X0,$Y0,$Z0,$eX,$eY,$eZ,$m);
    echo $rtc->invert();




/*
    echo    $X .'<br>'.
            $Y .'<br>'.
            $Z .'<br>'.
            $X0.'<br>'.
            $Y0.'<br>'.
            $Z0.'<br>'.
            $eX.'<br>'.
            $eY.'<br>'.
            $eZ.'<br>'.
            $m  ;
*/



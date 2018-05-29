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
 * DATE ：2016/4/29；
 * TIME ：23:06;
 */
?>
<?php

    //工具类
    class Tool{

        //静态方法用于检测数据(经度)的合法性
       static public function check_style($data){
            if(    (strlen($data) == 7)
                && (substr($data,0,3)>=0)
                && (substr($data,0,3)<=360)
                && (substr($data,3,2)>=0)
                && (substr($data,3,2)<60)
                && (substr($data,5,2)>=0 )
                && (substr($data,5,2)<60)
            ){
                return false;
            } else {
                return true;
            }
        }

        //静态方法用于检测数据(纬度)的合法性
        static public function check_styleB($data){
            if(    (strlen($data) == 7)
                && (substr($data,0,3)>=0)
                && (substr($data,0,3)<=90)
                && (substr($data,3,2)>=0)
                && (substr($data,3,2)<60)
                && (substr($data,5,2)>=0 )
                && (substr($data,5,2)<60)
            ){
                return false;
            } else {
                return true;
            }
        }

        //静态方法用于验证表单输入的X、Y
        static public function check_xy($data){
            if($data>=0 && $data !=''){
                return false;
            } else {
                return true;
            }
        }


        //静态方法用于验证输入的带号
        static public function check_DH($data){
            if($data>=0 && $data<=120 && $data !=''){
                return false;
            } else {
                return true;
            }
        }

        //静态方法用于验证输入的高程
        static public function check_height($data){
            if($data>=0 && $data !=''){
                return false;
            } else {
                return true;
            }
        }

        //静态方法，错误提示
        static public function _alert($info){
            return '<span class="alert-danger">'.$info.' </span>';
            exit();
        }

        //将表单中的字符串转换成角度
        static public function str_to_deg($data){
            $du = substr($data,0,3);
            $fen = substr($data,3,2);
            $miao = substr($data,5,2);
            $result = $du + $fen/60 + $miao/3600;
            return $result;
        }

        //将表单的数据有 ° ′ ″ （角度） 转化成 弧度
        static public function str_to_rad($data){
            $du = substr($data,0,3);
            $fen = substr($data,3,2);
            $miao = substr($data,5,2);
            $result = $du + $fen/60 + $miao/3600;
            return deg2rad($result);
        }

        //静态方法将double型的度数转换成度分秒表示的数据
        static public function double°2DFM($data){
            $du = floor($data);
            $fen = floor(($data - $du)*60);
            $maio = (($data-$du)*60 -$fen)*60;
            return $du.'°'.$fen.'′'.$maio.'″';
        }

    }

?>
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
 * DATE ：2016/4/30；
 * TIME ：23:49;
 */
?>
<?php

    //gauss反算
    class Gauss_F{
        private $gauss_x;       //X坐标
        private $gauss_y;       //Y坐标
        private $gauss_dh;      //带号
        private $Gauss_f_tq;    //椭球

        //构造方法初始化数据
        public function __construct($gauss_x,$gauss_y,$gauss_dh,$Gauss_f_tq){
            $this->gauss_x = $gauss_x;
            $this->gauss_y = $gauss_y;
            $this->gauss_dh = $gauss_dh;
            $this->Gauss_f_tq = $Gauss_f_tq;
        }

        //1解出β  返回值单位为 弧度
        public function β(){
           if(!Tool::check_xy($this->gauss_x)){
               switch ($this->Gauss_f_tq){
                   case 'keshi':
                       return ($this->gauss_x /6367558.4969);
                       break;
                   case 'IUGG':
                       return ($this->gauss_x /6367452.133);
                       break;
               }
            } else {
                echo Tool::_alert('X坐标不合法！！');
               exit();
          }
        }



        //2、解出cosβ
        public function cosβ(){
            return cos($this->β());
        }
        //3、解出sinβ
        public function sinβ(){
            return sin($this->β());
        }

        //5、解出Bf结果为度
        public function Bf(){
            if(!Tool::check_xy($this->gauss_x)){
                switch ($this->Gauss_f_tq){
                    case 'keshi':
                        $temp = (50221746 + (293622 + (2350 + 22*pow(cos($this->β()),2) ) *pow(cos($this->β()),2)) *pow(cos($this->β()),2)) *sin($this->β())*cos($this->β()) *pow(10,-10);
                        return ($temp)+($this->β());
                        break;
                    case 'IUGG':
                        $temp = (50228976 + (293697 + (2383 + 22*pow(cos($this->β()),2) ) *pow(cos($this->β()),2)) *pow(cos($this->β()),2)) *sin($this->β())*cos($this->β()) *pow(10,-10);
                        return ($temp)+($this->β());
                        break;
                }
            } else {
                echo Tool::_alert('X坐标不合法！！');
                exit();
            }

        }

        //6、解出cosBf
        public function cosBf(){
            return cos($this->Bf());
        }

        //8、解出sinBf
        public function sinBf(){
            return sin($this->Bf());
        }

        //9、解出Nf
        public function Nf(){
            return 6399698.902 - (21562.267 - (108.973 - 0.612 * pow($this->cosBf(),2)) * pow($this->cosBf(),2)) * pow($this->cosBf(),2);
        }



        //10、解出b2
        public function b2(){
            return (0.5 + 0.003369 * pow($this->cosBf(),2)) * $this->sinBf() * $this->cosBf();
        }

        //11、解出b3
        public function b3(){
            return 0.333333 - (0.166667 -0.001123 * pow($this->cosBf(),2) ) * pow($this->cosBf(),2);
        }

        //12、解出b4
        public function b4(){
            return 0.25 + (0.16161 + 0.00562 * pow($this->cosBf(),2)) * pow($this->cosBf(),2);
        }

        //13、解出b5
        public function b5(){
            return 0.2 - (0.1667 - 0.0088 * pow($this->cosBf(),2)) * pow($this->cosBf(),2);
        }

        //14、解出Z
        public function Z(){
            if(!Tool::check_xy($this->gauss_y)){
               return $this->gauss_y /($this->Nf() * $this->cosBf());
            } else {
                echo Tool::_alert('Y坐标不合法！！');
                exit();
            }
        }

        //15、解出Z方
        public function Z2(){
            return pow($this->Z(),2) ;
        }

        //16、解出L0
        public function L0(){
            if(Tool::check_DH($this->gauss_dh)){
                echo Tool::_alert('输入的带号有问题，请检查！！');
                exit();
            } else {
                if($this->gauss_dh >= 13 && $this->gauss_dh <=23){
                    return $this->gauss_dh * 6 -3;
                } elseif ($this->gauss_dh >= 24 && $this->gauss_dh <=45){
                    return $this->gauss_dh * 3;
                } else {
                    return Tool::_alert('不是我国的点,不提供计算');
                }

            }
        }

        //18、解出1975椭球下的b2命名为：b22
        public function b22(){
            return (0.5 + 0.00336975 * pow($this->cosBf(),2) ) * $this->cosBf() * $this->sinBf();
        }

        //19、解出1975椭球下的b3命名为：b33
        public function b33(){
            return 0.333333 - (0.1666667 - 0.001123 * pow($this->cosBf(),2)) * pow($this->cosBf(),2);
        }

        //20、解出1975椭球下的b4命名为：b44
        public function b44(){
            return 0.25 + (0.161612 + 0.005617 * pow($this->cosBf(),2)) * pow($this->cosBf(),2);
        }

        //21、解出1975椭球下的b5命名为：b55
        public function b55(){
            return 0.2 - (0.16667 - 0.00878 * pow($this->cosBf(),2)) * pow($this->cosBf(),2);
        }

        //高斯反算
        public function gauss_f(){
            if(Tool::check_xy($this->gauss_x)){
                echo Tool::_alert('输入的X坐标数据不合法!!');
                exit();
            } else {
                if(Tool::check_xy($this->gauss_y)){
                    echo Tool::_alert('输入的Y坐标数据不合法!!');
                    exit();
                } else {
                    if(Tool::check_DH($this->gauss_dh)){
                        echo Tool::_alert('输入的带号有问题，请检查！！');
                        exit();
                    } else {
                        switch($this->Gauss_f_tq){
                            case 'keshi' :
                                $B = $this->Bf() - (1 - ($this->b4() - 0.12* $this->Z2()) * $this->Z2() ) * $this->Z2()*$this->b2();
                                $B = rad2deg($B);
                                $l = (1 - ($this->b3() - $this->b5()*$this->Z2()) * $this->Z2()) * $this->Z();
                                $l*=ρ;
                                $LL = $l/3600 + $this->L0();
                                return '该点的经度为：'.$LL.'°; 　　纬度为：'.$B.'°；　　距离中央子午线的经差为：'.$l/ρ.'°；<br/>也就是经度为：'.Tool::double°2DFM($LL).'； 　纬度为：'.Tool::double°2DFM($B).'； 　距离中央子午线的经差为：'.Tool::double°2DFM($l/ρ);
                                break;
                            case 'IUGG' :
                                $B = $this->Bf() - (1 - ($this->b44() - 0.147 * $this->Z2()) * $this->Z2()) * $this->Z2() * $this->b22();
                                $B = rad2deg($B);
                                $l = (1 - ($this->b33() - $this->b55() * $this->Z2() ) * $this->Z2()) * $this->Z();
                                $l*=ρ;
                                $LL = $l/3600 + $this->L0();
                                return '该点的经度为：'.$LL.'°; 　　纬度为：'.$B.'°；　　距离中央子午线的经差为：'.$l/ρ.'°；<br/>也就是经度为：'.Tool::double°2DFM($LL).'； 　纬度为：'.Tool::double°2DFM($B).'； 　距离中央子午线的经差为：'.Tool::double°2DFM($l/ρ);
                                break;
                            default :
                                echo Tool::_alert('暂不支持其他椭球');
                                break;
                        }
                    }
                }
            }
        }




    }


?>
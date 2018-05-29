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
 * TIME ：00:48;
 */
?>
<?php

    //椭球基类
    class Gauss{
        private $_B;        //纬度B
        private $_tuoqiu;   //椭球
        private $_jingdu;   //经度
        private $_fendai;   //分带

        //拦截器  赋值
        public function __set($key,$value){
            return $this->$key=$value;
        }
        //拦截器 取值
        public function __get($key){
            return $this->$key;
        }

        //初始化数据
        public function __construct($_b,$tuoqiu,$_jingdu,$_fendai){
            $this->_B = $_b;
            $this->_tuoqiu = $tuoqiu;
            $this->_jingdu = $_jingdu;
            $this->_fendai = $_fendai;
        }

        //1求出cosB
        private function cosB(){
            $BB = Tool::str_to_rad($this->_B);
            return cos($BB);
        }

        //6求出sinB
        public function sinB(){
            $BB = Tool::str_to_rad($this->_B);
            return sin($BB);
        }
      
        //11求出tanB
        private function tanB(){
            $T = Tool::str_to_rad($this->_B);
            return tan($T);
        }

        //13，先将B化成秒；2，再将B/ρ得到弧度； 3，将算得的结果换成秒
        private function B÷ρ(){
            return (Tool::str_to_deg($this->_B)*3600)/ ρ ;
        }

        //15解出中央经线L0
        private function L0(){
            if(!Tool::check_style($this->_jingdu)){
                if($this->_fendai == 6){            //6度带
                    $n = ceil(Tool::str_to_deg($this->_jingdu)/6);
                    return 6*$n -3;
                } elseif ($this->_fendai == 3){     //3度带

                    //疑问？？？？？？？？？？    floor($data)舍去取整   ceil($data)进上取整
                    $n = ceil((Tool::str_to_deg($this->_jingdu)-1.5)/3);
                    return 3*$n;
                }
            } else {
                echo Tool::_alert('输入的经度长度格式不对，必须是7位！！ 且前三位（°度）∈[0,360]； 且4~5位（′分）∈[0,60); 且6~7位（″秒）∈[0,60)');
            }
        }

        //16解出代号
        private function daihao(){
            if($this->_fendai == 6){            //6度带
                $n = ceil(Tool::str_to_deg($this->_jingdu)/6);
                return $n;
            } elseif ($this->_fendai == 3){     //3度带
                $n = ceil((Tool::str_to_deg($this->_jingdu)-1.5)/3);
                return $n;
            }
        }

        //17解出经差小l
        private function l(){
            return (abs(Tool::str_to_deg($this->_jingdu) - $this->L0())/ρ )*3600;
        }

        //20解出N
        private function N(){
            return 6399698.902 - (21562.267 - (108.973 - 0.612*pow($this->cosB(),2)) * pow($this->cosB(),2) )  * pow($this->cosB(),2);
        }

        //21解出a0
        private function a0(){
            return 32140.4048 - (135.3303 - (0.7092 - 0.0041* pow($this->cosB(),2)) * pow($this->cosB(),2) ) * pow($this->cosB(),2);
        }

        //22解出a3
        private function a3(){
            return (0.3333333 + 0.001123 * pow($this->cosB(),2) )*pow($this->cosB(),2) - 0.1666667;
        }

        //23解出a4
        private function a4(){
            return (0.25 + 0.00253 * pow($this->cosB(),2)) * pow($this->cosB(),2) - 0.04167;
        }

        //24解出a5
        private function a5(){
            return 0.00833 -(0.1667 - (0.1967 + 0.0040 * pow($this->cosB(),2) ) * pow($this->cosB(),2)  ) * pow($this->cosB(),2) ;
        }

        //25解出a6
        private function a6(){
            return (0.167 * pow($this->cosB(),2)  - 0.083) * pow($this->cosB(),2) ;
        }

        //26解出1975椭球计算下的N命名为NN
        private function NN(){
            return 6399596.652 - ( 21565.045 - (108.996 - 0.603*pow($this->cosB(),2) ) * pow($this->cosB(),2)  ) * pow($this->cosB(),2) ;
        }

        //解出1975椭球计算下的a0命名为：a00
        private function a00(){
            return  32144.5189 - ( 135.3646 - (0.7034 - 0.0041 * pow($this->cosB(),2) ) * pow($this->cosB(),2)  ) * pow($this->cosB(),2) ;
        }

        //解出1975椭球计算下的a3命名为：a33
        private function a33(){
            return (0.3333333 + 0.001123 * pow($this->cosB(),2)  ) * pow($this->cosB(),2)  - 0.1666667;
        }

        //解出1975椭球计算下的a4命名为：a44
        private function a44(){
            return (0.25 + 0.00253 * pow($this->cosB(),2) ) * pow($this->cosB(),2)  - 0.04167;
        }

        //解出1975椭球计算下的a5命名为：a55
        private function a55(){
            return 0.00878 - (0.1702 - 0.20382 * pow($this->cosB(),2) ) *pow($this->cosB(),2) ;
        }

        //解出1975椭球计算下的a6命名为：a66
        private function a66(){
            return (0.167 * pow($this->cosB(),2)  - 0.083) * pow($this->cosB(),2) ;
        }

        //高斯正算
        public function gauss_z(){
            if(Tool::check_style($this->_jingdu)  ){
                echo Tool::_alert('输入的经度长度格式不对，必须是7位！！ 且前三位（°度）∈[0,360]； 且4~5位（′分）∈[0,60); 且6~7位（″秒）∈[0,60)');
            } else {
                if(Tool::check_styleB($this->_B)){
                    echo Tool::_alert('输入的纬度长度格式不对，必须是7位！！ 且前三位（°度）∈[0,90]； 且4~5位（′分）∈[0,60); 且6~7位（″秒）∈[0,60)');
                } else {
                    switch($this->_tuoqiu){
                        case 'keshi_z':
                            $x = 6367558.4969 * $this->B÷ρ() - ($this->a0() - (0.5 + ($this->a4() + $this->a6() * pow($this->l(),2) ) * pow($this->l(),2) ) * pow($this->l(),2) * $this->N() ) *$this->sinB() * $this->cosB();
                            $y = (1 + ($this->a3() + $this->a5() * pow($this->l(),2) ) * pow($this->l(),2) ) * $this->l() * $this->N() * $this->cosB();
                            $zhongyangziwuxianjingdu = $this->L0();
                            $daihao = $this->daihao();
                            $result = '该点的X坐标为：'.$x .'米；　Y坐标为：'.$y.'米;　中央子午线经度为：'.$zhongyangziwuxianjingdu.'°；　该点带号：'.$daihao.';';
                            return $result;
                            break;
                        case 'IUGG_z' :
                            $x = 6367452.1328 * $this->B÷ρ() - ($this->a00() - (0.5 + ($this->a44() + $this->a66() * pow($this->l(),2)) * pow($this->l(),2)) * pow($this->l(),2) * $this->NN()) * $this->cosB() * $this->sinB();
                            $y = (1 + ($this->a33() + $this->a55() * pow($this->l(),2) ) * pow($this->l(),2) ) * $this->l() * $this->NN() * $this->cosB();
                            $zhongyangziwuxianjingdu = $this->L0();
                            $daihao = $this->daihao();
                            $result = '该点的X坐标为：'.$x .'米；　Y坐标为：'.$y.'米;　中央子午线经度为：'.$zhongyangziwuxianjingdu.'°；　该点带号：'.$daihao.';';
                            return $result;
                            break;
                        default :
                            echo Tool::_alert('暂不支持其他椭球');
                            break;
                    }
                }
            }
        }

        //计算子午圈曲率半径_M
        public function _M(){
            switch ($this->_tuoqiu){
                case 'keshi_z':
                    $m0 =     KSa*(1-KSe²);
                    $m2 = 3/2*KSe²*$m0;
                    $m4 = 5/4*KSe²*$m2;
                    $m6 = 7/6*KSe²*$m4;
                    $m8 = 9/8*KSe²*$m6;
                    $M = $m0 + $m2*pow($this->sinB(),2) + $m4*pow($this->sinB(),4) + $m6*pow($this->sinB(),6) + $m8*pow($this->sinB(),8);
                    return $M;
                    break;
                case 'IUGG_z':
                    $m0 =     IUGGa*(1-IUGGe²);
                    $m2 = 3/2*IUGGe²*$m0;
                    $m4 = 5/4*IUGGe²*$m2;
                    $m6 = 7/6*IUGGe²*$m4;
                    $m8 = 9/8*IUGGe²*$m6;
                    $M = $m0 + $m2*pow($this->sinB(),2) + $m4*pow($this->sinB(),4) + $m6*pow($this->sinB(),6) + $m8*pow($this->sinB(),8);
                    return $M;
                    break;
            }
        }

        //计算卯酉圈曲率半径_N
        public function _N(){
            switch ($this->_tuoqiu){
                case 'keshi_z':
                    $n0 =     KSa;
                    $n2 = 1/2*KSe²*$n0;
                    $n4 = 3/4*KSe²*$n2;
                    $n6 = 5/6*KSe²*$n4;
                    $n8 = 7/8*KSe²*$n6;
                    $N = $n0 + $n2*pow($this->sinB(),2) + $n4*pow($this->sinB(),4) + $n6*pow($this->sinB(),6) + $n8*pow($this->sinB(),8);
                    return $N;
                    break;
                case 'IUGG_z':
                    $n0 =     IUGGa;
                    $n2 = 1/2*IUGGe²*$n0;
                    $n4 = 3/4*IUGGe²*$n2;
                    $n6 = 5/6*IUGGe²*$n4;
                    $n8 = 7/8*IUGGe²*$n6;
                    $N = $n0 + $n2*pow($this->sinB(),2) + $n4*pow($this->sinB(),4) + $n6*pow($this->sinB(),6) + $n8*pow($this->sinB(),8);
                    return $N;
                    break;
            }
        }

        //平均曲率半径R
        public function _R(){
            return sqrt( $this->_M() * $this->_N() );
        }

        //14求取子午圈弧长_X
        public function _X(){
            if(!Tool::check_styleB($this->_B)){
                switch($this->_tuoqiu){
                    case 'keshi_z' ://
                        return 6367558.4969*$this->B÷ρ() - (32140.4049 - (135.3303 - (0.7092 - 0.0042*$this->cosB2())*$this->cosB2())*$this->cosB2() )*$this->sinB()*$this->cosB();
                        break;
                    case 'IUGG_z' :
                        return 6367452.1328*$this->B÷ρ() - (32144.5189 - (135.3646-(0.7034 - 0.0042*$this->cosB2())*$this->cosB2())*$this->cosB2())*$this->sinB()*$this->cosB();
                        break;
                    default :
                        return '暂不支持其他椭球';
                }
            } else {
                echo Tool::_alert('输入的纬度长度格式不对，必须是7位！！ 且前三位（°度）∈[0,90]； 且4~5位（′分）∈[0,60); 且6~7位（″秒）∈[0,60)');
            }
        }

    }


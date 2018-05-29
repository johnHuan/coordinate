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
 * DATE ：2016/5/1；
 * TIME ：23:54;
 */
?>
<?php

    //椭球基类
    class CanXin_Z{
        private $L;         //经度
        private $B;         //纬度B
        private $H;         //高程
        private $TuoQiu;    //椭球

        //拦截器  赋值
        public function __set($key, $value){
            return $this->$key = $value;
        }

        //拦截器 取值
        public function __get($key){
            return $this->$key;
        }

        //初始化数据
        public function __construct($_B,$_L,$_H,$TuoQiu){
            $this->L = $_L;
            $this->B = $_B;
            $this->H = $_H;
            $this->TuoQiu = $TuoQiu;
        }

        //求出sinB
        public function sinB(){
            return sin(Tool::str_to_rad($this->B));
        }

        //求出cosB
        public function cosB(){
            return cos(Tool::str_to_rad($this->B));
        }

        //求出sinL
        public function sinL(){
            return sin(Tool::str_to_rad($this->L));
        }

        //求出sinL
        public function cosL(){
            return cos(Tool::str_to_rad($this->L));
        }

        public function get_XYZ(){
            if(Tool::check_style($this->L)){
                echo Tool::_alert('输入的经度格式不对，必须是7位！！ 且前三位（°度）∈[0,360]； 且4~5位（′分）∈[0,60); 且6~7位（″秒）∈[0,60)!');
            } else {
                if(Tool::check_styleB($this->B)){
                    echo Tool::_alert('输入的纬度格式不对，必须是7位！！ 且前三位（°度）∈[0,90]； 且4~5位（′分）∈[0,60); 且6~7位（″秒）∈[0,60)!');
                } else {
                    if(Tool::check_height($this->H)){
                        echo Tool::_alert('输入的高程数据不合法!请检查!');
                    } else {
                        switch($this->TuoQiu){
                            case 'CGCS2000椭球':
                                $W = sqrt(1 - CGCS2000e²*pow($this->sinB(),2));
                                $N = CGCS2000a/$W;
                                $X = ($N + $this->H) * $this->cosB() * $this->cosL();
                                $Y = ($N + $this->H) * $this->cosB() * $this->sinL();
                                $Z = ($N * (1 - CGCS2000e²) + $this->H) * $this->sinB();
                                return '该点在空间直角坐标系下的坐标为：X='.$X.'; Y='.$Y.'; Z='.$Z.';';
                                break;
                            case 'WGS84椭球':
                                $W = sqrt(1 - WGS84e²*pow($this->sinB(),2));
                                $N = WGS84a/$W;
                                $X = ($N + $this->H) * $this->cosB() * $this->cosL();
                                $Y = ($N + $this->H) * $this->cosB() * $this->sinL();
                                $Z = ($N * (1 - WGS84e²) + $this->H) * $this->sinB();
                                return '该点在空间直角坐标系下的坐标为：X='.$X.'; Y='.$Y.'; Z='.$Z.';';
                                break;
                            case 'IUGG1975国际椭球':
                                $W = sqrt(1 - IUGGe²*pow($this->sinB(),2));
                                $N = IUGGa/$W;
                                $X = ($N + $this->H) * $this->cosB() * $this->cosL();
                                $Y = ($N + $this->H) * $this->cosB() * $this->sinL();
                                $Z = ($N * (1 - IUGGe²) + $this->H) * $this->sinB();
                                return '该点在空间直角坐标系下的坐标为：X='.$X.'; Y='.$Y.'; Z='.$Z.';';
                                break;
                            case '克拉索夫斯基椭球';
                                $W = sqrt(1 - KSe²*pow($this->sinB(),2));
                                $N = KSa/$W;
                                $X = ($N + $this->H) * $this->cosB() * $this->cosL();
                                $Y = ($N + $this->H) * $this->cosB() * $this->sinL();
                                $Z = ($N * (1 - KSe²) + $this->H) * $this->sinB();
                                return '该点在空间直角坐标系下的坐标为：X='.$X.'; Y='.$Y.'; Z='.$Z.';';
                                break;
                            default :
                                return '暂不支持其他椭球';
                        }
                    }

                }
            }

        }

    }


?>
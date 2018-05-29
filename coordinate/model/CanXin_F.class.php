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
 * DATE ：2016/5/3；
 * TIME ：10:58;
 */
?>
<?php

    //参心空间直角坐标系向参心大地坐标系转换
    class CanXin_F{
        private $X;
        private $Y;
        private $Z;
        private $Tq;

        //拦截器  赋值
        public function __set($key, $value){
            return $this->$key = $value;
        }

        //拦截器 取值
        public function __get($key){
            return $this->$key;
        }

        public function __construct($XX,$YY,$ZZ,$TQ){
            $this->X = $XX;
            $this->Y = $YY;
            $this->Z = $ZZ;
            $this->Tq = $TQ;
        }

        public function xyz2blh(){
            if(Tool::check_height($this->X)){
                echo Tool::_alert('输入的X坐标数据不合法!请检查!');
            } else {
                if(Tool::check_height($this->Y)){
                    echo Tool::_alert('输入的Y坐标数据不合法！请检查');
                } else {
                    if(Tool::check_height($this->Z)){
                        echo Tool::_alert('输入的Z坐标数据不合法！请检查');
                    } else {
                        switch($this->Tq){
                            case 'CGCS2000椭球':
                                $U = atan(
                                    $this->Z*CGCS2000a
                                    /
                                    (sqrt(pow($this->Y,2)+pow($this->X,2)) * CGCS2000b)
                                );
                                $B0 = atan(
                                    ($this->Z+CGCS2000b*CGCS2000ep²*pow(sin($U),3))
                                    /
                                    (sqrt(pow($this->X,2)+pow($this->Y,2)) - CGCS2000a*CGCS2000e²*pow(cos($U),3))
                                );
                                $N = CGCS2000a / sqrt(1 - CGCS2000e²*pow(sin($B0),2));

                                $L = atan($this->Y/$this->X);
                                $L = rad2deg($L);
                                $H = sqrt(pow($this->X,2)+pow($this->Y,2) + pow($this->Z+$N*CGCS2000e²*sin($B0),2)) - $N;
                                $B = atan(
                                    ($this->Z/sqrt(pow($this->X,2)+pow($this->Y,2)))
                                    /
                                    (1 - CGCS2000e²*$N/($N+$H))
                                );
                                $B = rad2deg($B);
                                return '该点的经度为：'.$L.'°; 纬度为：'.$B.'°;高程为：'.$H.'米;<br/>也就是经度为：'.Tool::double°2DFM($L).';纬度为：'.Tool::double°2DFM($B).';高程为：'.$H;
                                break;
                            case 'WGS84椭球':
                                $U = atan(
                                    $this->Z*WGS84a
                                    /
                                    (sqrt(pow($this->Y,2)+pow($this->X,2))*WGS84b)
                                );
                                $B0 = atan(
                                    ($this->Z+WGS84b*WGS84ep²*pow(sin($U),3))
                                    /
                                    (sqrt(pow($this->X,2)+ pow($this->Y,2)) - WGS84a*WGS84e²*pow(cos($U),3))
                                );
                                $N = WGS84a / sqrt(1 - WGS84e²*pow(sin($B0),2));

                                $L = atan($this->Y/$this->X);
                                $L = rad2deg($L);
                                $H = sqrt(pow($this->X,2)+pow($this->Y,2) + pow($this->Z+$N*WGS84e²*sin($B0),2)) - $N;
                                $B = atan(
                                    ($this->Z/sqrt(pow($this->X,2)+pow($this->Y,2)))
                                    /
                                    (1 - WGS84e²*$N/($N+$H))
                                );
                                $B = rad2deg($B);
                                return '该点的经度为：'.$L.'°; 纬度为：'.$B.'°;高程为：'.$H.'米;<br/>也就是经度为：'.Tool::double°2DFM($L).';纬度为：'.Tool::double°2DFM($B).';高程为：'.$H;
                                break;
                            case 'IUGG1975国际椭球':
                                $U = atan(
                                    $this->Z*IUGGa
                                    /
                                    (sqrt(pow($this->Y,2)+pow($this->X,2))*IUGGb)
                                );
                                $B0 = atan(
                                    ($this->Z+IUGGb*IUGGep²*pow(sin($U),3))
                                    /
                                    (sqrt(pow($this->X,2)+ pow($this->Y,2)) - IUGGa*IUGGe²*pow(cos($U),3))
                                );
                                $N = IUGGa / sqrt(1 - IUGGe²*pow(sin($B0),2));

                                $L = atan($this->Y/$this->X);
                                $L = rad2deg($L);
                                $H = sqrt(pow($this->X,2)+pow($this->Y,2) + pow($this->Z+$N*IUGGe²*sin($B0),2)) - $N;
                                $B = atan(
                                    ($this->Z/sqrt(pow($this->X,2)+pow($this->Y,2)))
                                    /
                                    (1 - IUGGe²*$N/($N+$H))
                                );
                                $B = rad2deg($B);
                                return '该点的经度为：'.$L.'°; 纬度为：'.$B.'°;高程为：'.$H.'米;<br/>也就是经度为：'.Tool::double°2DFM($L).';纬度为：'.Tool::double°2DFM($B).';高程为：'.$H;
                                break;
                            case '克拉索夫斯基椭球';
                                $U = atan(
                                            $this->Z*KSa
                                            /
                                            (sqrt(pow($this->Y,2)+pow($this->X,2))*KSb)
                                          );
                                $B0 = atan(
                                            ($this->Z+KSb*KSep²*pow(sin($U),3))
                                            /
                                            (sqrt(pow($this->X,2)+ pow($this->Y,2)) - KSa*KSe²*pow(cos($U),3))
                                           );
                                $N = KSa / sqrt(1 - KSe²*pow(sin($B0),2));

                                $L = atan($this->Y/$this->X);
                                $L = rad2deg($L);
                                $H = sqrt(pow($this->X,2)+pow($this->Y,2) + pow($this->Z+$N*KSe²*sin($B0),2)) - $N;
                                $B = atan(
                                            ($this->Z/sqrt(pow($this->X,2)+pow($this->Y,2)))
                                            /
                                            (1 - KSe²*$N/($N+$H))
                                          );
                                $B = rad2deg($B);
                                return '该点的经度为：'.$L.'°; 纬度为：'.$B.'°;高程为：'.$H.'米;<br/>也就是经度为：'.Tool::double°2DFM($L).';纬度为：'.Tool::double°2DFM($B).';高程为：'.$H;
                                break;
                            default :
                                return '暂不支持其他椭球';

                       }
                    }
                }

            }
        }
    }



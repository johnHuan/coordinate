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
 * TIME ：17:20;
 */
?>
<?php
    class RTC{
        //定义成员变量
        private $X ;
        private $Y ;
        private $Z ;
        private $X0;
        private $Y0;
        private $Z0;
        private $eX;
        private $eY;
        private $eZ;
        private $m;

        //构造方法，初始化数据
        public function __construct($X,$Y ,$Z ,$X0,$Y0,$Z0,$eX,$eY,$eZ,$m){
            $this->X  = $X ;
            $this->Y  = $Y ;
            $this->Z  = $Z ;
            $this->X0 = $X0;
            $this->Y0 = $Y0;
            $this->Z0 = $Z0;
            $this->eX = $eX;
            $this->eY = $eY;
            $this->eZ = $eZ;
            $this->m  = $m;
        }
        //坐标转换
        public function invert(){
            $x2 = $this->X0 + (1+$this->m)* ( $this->X + $this->eZ*$this->Y - $this->eY*$this->Z);
            $y2 = $this->Y0 + (1+$this->m)* ( $this->Y - $this->eZ*$this->X + $this->eX*$this->Z);
            $z2 = $this->Z0 + (1+$this->m)* ( $this->Z + $this->eY*$this->X - $this->eX*$this->Y);
            return 'X2='.$x2.';  Y2='.$y2.'; Z2='.$z2.';';
        }
    }

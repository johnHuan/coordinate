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
 * DATE ：2016/5/10；
 * TIME ：12:22;
 */
?>
<?php
    /*
     * mysql操作类
     * 1、连接
     * 2、选择需要操作的库
     * 3、设置操作的编码
     * 4、增删改查
     * 5、关闭mysql的连接，节省系统资源
     *
     * */
    class Mysql{
        public $hostName;  //mysql主机
        public $userName;  //mysql用户名
        public $password;  //mysql密码
        public $conn;      //mysql连接标识符
        public $dbName;    //操作的数据库名
        public $charset;   //操作的编码
        //初始化mysql连接
        function __construct($hostName,$userName,$password,$dbName,$charset){
            $this->hostName = $hostName;
            $this->userName = $userName;
            $this->password = $password;
            $this->dbName = $dbName;
            $this->charset = $charset;
            //连接mysql数据库
            $this->conn = mysql_connect($this->hostName,$this->userName,$this->password);
            //选择操作的数据库
            mysql_select_db($this->dbName,$this->conn);
            //设置操作的编码
            $this->_query("set names '".$this->charset."'",$this->conn);

        }
        //执行sql语句的方法
        function _query($sql){
            return mysql_query($sql,$this->conn);
        }

        //封装mysql_fetch_assoc函数
        function _assoc($query){
            return mysql_fetch_assoc($query);
        }
        //回收资源
        function __destruct(){
            mysql_close($this->conn);
        }


    }




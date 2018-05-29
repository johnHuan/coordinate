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
 * TIME ：12:21;
 */
?>
<?php

    class Action extends Mysql{
        //添加操作
        function _insert($table,$set){
            $sql = "insert into {$table} set {$set}";
            $result = $this->_query($sql);
            return $result;
        }
        //修改
        function _update($table,$set,$where){
            $sql =  "update {$table} set {$set} where {$where}";
            $result = $this->_query($sql);
            return $result;
        }
        //删除
        function _delete($table,$where){
            $sql = "delete from {$table} where {$where}";
            $result = $this->_query($sql);
            return $result;
        }
        //查询一条数据
        function _find($table,$where="",$fields="*",$order=""){
            $where = empty($where) ? "" : " where ".$where;
            $order = empty($order) ? "" : " order by ".$order;
            $sql = "select {$fields} from {$table} {$where} {$order} limit 1";
            $query = $this->_query($sql);
            return $this->_assoc($query);

        }
        //查询多条数据
        function _select($table,$where="",$fields="*",$order="",$limit=""){
            $where = empty($where) ? "" : " where ".$where;
            $order = empty($order) ? "" : " order by ".$order;
            $limit = empty($limit) ? "" : " limit ".$limit;
            $sql = "select {$fields} from {$table} {$where} {$order} $limit";
            $query = $this->_query($sql);
            $result = array();
            while($rs = $this->_assoc($query)){
                //将$rs中的值添加到$result的数组中去
                $result[] = $rs;
            }
            return $result;
        }
    }




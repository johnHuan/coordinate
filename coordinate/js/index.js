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
 * Created by john;
 * {admin : john }
 * DATE ：2016/4/27；
 * TIME ：9:04;
 */

    /*
    * 回到顶部
    * */
    $(function(){
        //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
        $(function () {
            $(window).scroll(function(){
                if ($(window).scrollTop()>100){
                    $("#back-to-top").fadeIn(1500);
                } else {
                    $("#back-to-top").fadeOut(1500);
                }
            });

            //当点击跳转链接后，回到页面顶部位置
            $("#back-to-top").click(function(){
                $('body,html').animate({scrollTop:0},1000);
                return false;
            });
        });
    });

    $(function () { $("[data-toggle='tooltip']").tooltip(); });

    /*
    * 1、1gauss正算
    * */
    $('#gauss_z_result_btn').click(function () {
        //1.取值
        var jingdu_z = $('#gauss_z_jd').val();    //高斯正算时候输入的经度
        var weidu_z = $('#gauss_z_wd').val();     //高斯正算时候输入的纬度
        var fendai_z = $('#select11 option:selected').val();     //高斯正算时候选择的分度带
        var tuoqiu_z = $('#select12 option:selected').val();        //高斯正算时候选择的椭球
        //2.ajax将数据发送到服务器端
        $.ajax({
            type : 'POST',
            data : {
                jingdu_z : jingdu_z,
                weidu_z : weidu_z,
                fendai_z : fendai_z,
                tuoqiu_z : tuoqiu_z
            },
            url : 'controlor/gauss_z.php',
            success : function (response, status, xhr) {
                $('#gauss_z_result').html(response);
            },
        });
    });

    /*
    * 1.2gauss反算
    * */
    $('#gauss_f_result_btn').click(function () {
        //1.取值
        var gauss_x = $('#gauss_x').val();    //高斯反算时候输入的经度
        var gauss_y = $('#gauss_y').val();     //高斯反算时候输入的纬度
        var gauss_dh = $('#gauss_dh').val();       //高斯反算时候选择的分度带
        var Gauss_f_tq = $('#select2 option:selected').val();  //高斯反算时候选择的椭球

        //2.ajax将数据发送到服务器端
        $.ajax({
            type : 'POST',
            data : {
                gauss_x : gauss_x,
                gauss_y : gauss_y,
                gauss_dh : gauss_dh,
                Gauss_f_tq : Gauss_f_tq
            },
            url : 'controlor/gauss_f.php',
            success : function (response, status, xhr) {
                $('#gauss_f_result').html(response);
            },
        });
    });

    /*
     * 2.1参心大地坐标转换为参心空间直角坐标系
     * */

    $('#btn_dd2kz').click(function () {
        //1、取值
        var _B = $('#_B').val();               //获取经度
        var _L = $('#_L').val();               //获取纬度
        var _H = $('#_H').val();               //获取大地高H
        var TuoQiu = $('#select3 option:selected').text();       //选择的椭球

        //2.ajax将数据发送到服务器端
        $.ajax({
            type : 'POST',
            data : {
                _B : _B,
                _L : _L,
                _H : _H,
                TuoQiu : TuoQiu,
            },
            url : 'controlor/canxin_z.php',
            success : function(response, status, xhr){
                $('#DaDi2KZ').html(response);
            },
        });
    });

    /*
    * 2.2参心空间直角坐标转换为参心大地坐标
    * */
    $('#xyz2blh_btn').click(function () {
       //1、取值
        var XX = $('#XX').val();
        var YY = $('#YY').val();
        var ZZ = $('#ZZ').val();
        var TQ = $('#select4 option:selected').text();

        //2、由ajax将数据发送到后台
        $.ajax({
            type : 'POST',
            data : {
                XX : XX,
                YY : YY,
                ZZ : ZZ,
                TQ : TQ,
            },
            url : 'controlor/canxin_f.php',
            success : function(response, status, xhr){
                $('#xyz2blh').html(response);
            }

        });
    });

    /*
     * 4、不同空间直角坐标系之间的转换
     * */
    $('#result1-btn').click(function () {

        //1、取值
        //七参数
        var X0 = $('#x0').val();
        var Y0 = $('#y0').val();
        var Z0 = $('#z0').val();
        var eX = $('#ex').val();
        var eY = $('#ey').val();
        var eZ = $('#ez').val();
        var m = $('#m').val();
        //坐标
        var X = $('#x').val();
        var Y = $('#y').val();
        var Z = $('#z').val();

        //2、由ajax将数据发送到后台
        $.ajax({
            type : 'POST',
            data : {
                X : X,
                Y : Y,
                Z : Z,
                X0 : X0,
                Y0 : Y0,
                Z0 : Z0,
                eX : eX,
                eY : eY,
                eZ : eZ,
                m  : m ,
            },
            url : 'controlor/rtcoordinate.php',
            success : function(response, status, xhr){
                $('#result1').html(response);
            }

        })
    });

    /*
     * 5读取七参数
     * */
    $('#getData').click(function () {
        var style = $('#select5 option:selected').val();
        if(style == 0){
            alert('警告：请先选择转换类型！！')
        } else {
            $.ajax({
                type : 'POST',
                data : {
                    style : style,

                },
                url : 'controlor/rtcDB.php',
                success : function(response, status, xhr){
                    if(response == 'false'){
                        alert('该系统暂时还不支持这两种坐标系之间的转换，原因是数据库里还没有这两个坐标系之间转换的七参数，如需转换请先计算七参数');
                    } else {
                        $('#x0').val($.parseJSON(response).X0);
                        $('#y0').val($.parseJSON(response).Y0);
                        $('#z0').val($.parseJSON(response).Z0);
                        $('#ex').val($.parseJSON(response).ex);
                        $('#ey').val($.parseJSON(response).ey);
                        $('#ez').val($.parseJSON(response).ez);
                        $('#m').val($.parseJSON(response).m);
                    }
                }
            });
        }

        
    });


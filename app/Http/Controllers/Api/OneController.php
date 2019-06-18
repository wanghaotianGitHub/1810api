<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
class OneController extends Controller{
    //curl
    public function curl(){
//        $url = "https://www.wht0521.top/";
        $url = "http://1809wanghaotian.comcto.com/";
        //1.初始化
        $chu = curl_init($url);
        //2.设置参数
        curl_setopt($chu,CURLOPT_RETURNTRANSFER,false);   //控制浏览器输出  false页面会展示 true页面不会展示
        //3.执行会话
        curl_exec($chu);
        //4.关闭会话
        curl_close($chu);
    }
    public function curlone(){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxcabb0b10b4a0bdac&secret=3c76e89452d084d7ece7999d0f4dc367";
        //1.初始化
        $chu = curl_init($url);
        //2.设置参数
        curl_setopt($chu,CURLOPT_RETURNTRANSFER,true);   //控制浏览器输出  false页面会展示 true页面不会展示
        //3.执行会话
        $data = curl_exec($chu);
        $data = json_decode($data,true);
        //4.关闭会话
        curl_close($chu);
        return $data;
    }
    public function menu(){
            $post_data='{
                 "button":[{
                      "type":"view",
                      "name":"王帅",
                      "url":"https://www.baidu.com/"
                  },]
            }';
            $access_token = $this->curlone();
            $access = $access_token['access_token'];
            $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access}";
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
            $data =curl_exec($ch);
            curl_close($ch);
            print_r($data);
    }
    public function mi(){
        $mi = "王浩天";
        $data = base64_encode($mi);
        $url = "http://lumenapi.com/mi";
        $clinet = new Client();
        $response = $clinet ->request("POST",$url,[
            'body'=>$data
        ]);
        $res_str = $response->getBody();
        echo $res_str;
    }
    //对称加密
    public function Symmetric(){
        $str = "唱 跳 rap 篮球";    //需要加密的数据
        $key = "对暗号";       //加密密匙
        $iv = "9527952795279527";   //初始向量  十六个字符
        $enc_data = openssl_encrypt($str,'AES-128-CBC',$key,OPENSSL_RAW_DATA,$iv);
        $clinet = new Client();
        $url = "http://lumenapi.com/Symmetric";
        $response = $clinet ->request("POST",$url,[
            'body'=>$enc_data
        ]);
        $res_str = $response->getBody();
        echo $res_str;
    }
    public function FSymmetric(){
        $str = "菜某向你发出了篮球邀请！";
        $arr = openssl_get_privatekey('file://'.storage_path('miyao/rsa_private_key.pem'));
//        openssl_sign($str,$aa,$arr);
        openssl_private_encrypt($str,$aa,$arr);
        $clinet = new Client();
//        $url = "http://lumenapi.com/FSymmetric?ii=".urlencode($enc_data);
        $url = "http://lumenapi.com/FSymmetric";
        $response = $clinet ->request("POST",$url,[
            'body'=>$aa
        ]);
        $res_str = $response->getBody();
        echo $res_str;
    }

    public function reg(Request $request){
        $data=$request->input();
        unset($data['pwds']);
        $res=DB::table('reg')->insert($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    public function login(Request $request){
        $name = $request->input('name');
        $pwd = $request->input('pwd');
        $u = DB::table("reg")->where(['name'=>$name])->first();
        if($u){
            //验证登录
            if($u->pwd == $pwd){
                echo "1";
            }else{
                //密码错误
                echo "2";
            }
        }else{
            //用户不存在
            echo "3";
        }
    }

}
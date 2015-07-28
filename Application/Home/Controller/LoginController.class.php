<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {

	/*登录页面*/
    public function index(){
       	$this->display();
    }

    /*登录表单处理*/
    public function runLogin(){
        if(!IS_POST){
            $this->error('页面不存在');
        }
        //提取表单内容
        $account=I('post.account');
        $pwd=md5(I('post.pwd'));
        $where=array('account'=>$account);
        $user=M('user')->where($where)->find();
        if(!$user||$user['password']!=$pwd){
            $this->error('用户或密码不正确');
        }
        if($user['lock']){
            $this->error('用户被锁定');
        }
        //处理下一次自动登录
        if (isset($_POST['auto'])){
           $account=$user['account'];
           $ip=get_client_ip();
           $value=$account.'|'.$ip;
           $value=encryption($value);
           cookie('auto',$value,C('AUTO_LOGIN_TIME'));
        }
        //登录成功，写入session，跳转到首页
        session('uid',$user['id']);
        redirect(__APP__);
    }

    /*注册页面*/
    public function register(){
    	$this->display();
    }

    /*注册表单处理*/
    public function runRegis(){
        if (!IS_POST) {
            $this->error('页面不存在');
        }
        
        $code=I('post.verify');
        $verify = new \Think\Verify();
        $result=$verify->check($code);
        if($result=='false'){
            $this->error('验证码错误');
        }
        if(I('post.pwd')!=I('post.pwded')){
            $this->error('两次密码不一致');
        }
        //提取POST数据
        $data=array(
            'account'=>I('post.account'),
            'password'=>md5(I('post.pwd')),
            'registime'=>$_SERVER['REQUEST_TIME'],
            'userinfo'=>array(
                'nickname'=>I('post.nickname')
                )
            );
        //调用模型内部方法
        $id=D('User')->insert($data);
       
        if($id){
            //插入数据成功后把用户id写入session
            session('uid',$id);
            //跳转至首页
            redirect(__APP__);
        }else{
            $this->error('注册失败，请重试');
        }
    }

    /*验证码*/
    public function verify(){
    	$Verify = new \Think\Verify();
        $Verify->length=2;
        $Verify->useNoise = false;
        $Verify->fontSize = 15;
    	$Verify->entry();
    }

    /*异步验证账号是否已经存在*/
    public function checkAccount(){
        if(!IS_AJAX){
            $this->error('请求失败');
        }
        $account=I("post.account");
        $where=array('account'=>$account);
        if(M('user')->where($where)->getField('id')){
            echo 'false';
        }else{
            echo 'true';
        }
    }

    /*异步验证昵称是否已经存在*/
    public function checkNickname(){
        if(!IS_AJAX){
            $this->error('请求失败');
        }
        $nickname=I('post.nickname');
        $where=array('nickname'=>$nickname);
        if(M('userinfo')->where($where)->getField('id')){
            echo 'false';
        }else{
            echo 'true';
        }
    }

    /*异步验证验证码是否正确*/
    public function checkVerify(){
        if(!IS_AJAX){
            $this->error('请求失败');
        }
        $code=I('post.verify');
        $verify = new \Think\Verify();
        if($verify->check($code)){
            echo 'true';
        }else{
            echo 'false';
        }
    }

}
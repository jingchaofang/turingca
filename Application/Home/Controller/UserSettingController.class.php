<?php
namespace Home\Controller;
use Think\Controller;
class UserSettingController extends CommonController {
    
	/*用户基本信息设置视图*/
    public function index(){
        $where=array('uid'=> session('uid'));
        $field=array('nickname','truename','sex','location','constellation','intro','avatar180');
        $user=M('userinfo')->field($field)->where($where)->find();
        $this->assign('user',$user);
        $this->display();
    }

    /*修改用户基本信息*/
    public function editBasic(){
        if (!IS_POST) {
            $this->error('页面不存在');
        }
        $data=array(
            'nickname'=>I('post.nickname'),
            'truename'=>I('post.truename'),
            'sex'=>I('post.sex/d'),
            'location'=>I('post.province').' '.I('post.city'),
            'constellation'=>I('post.constellation'),
            'intro'=>I('post.intro')
            );
        $where=array('uid'=>session('uid'));
        if(M('userinfo')->where($where)->save($data)){
            $this->success('修改成功',U('index'));
        }else{
            $this->error('修改失败，请重试');
        }
    }
    /*修改用户头像*/
    public function editFace(){
        if(!IS_POST){
            $this->error('页面不存在');
        }
        $db=M('userinfo');
        $where=array('uid'=>session('uid'));
        $field=array('avatar50','avatar80','avatar180');
        $old=$db->field($field)->where($where)->find();
        $data=array(
            'avatar180'=>I('post.face180'),
            'avatar80'=>I('post.face80'),
            'avatar50'=>I('post.face50')
            );
        if($db->where($where)->field($field)->save($data)){
            if(!empty($old['avatar180'])){
                unlink('./Uploads/Face/'.$old['avatar180']);
                unlink('./Uploads/Face/'.$old['avatar80']);
                unlink('./Uploads/Face/'.$old['avatar50']);
            }
            $this->success('修改成功',U('index'));
        }else{
            $this->error('修改失败，请重试');
        }
    }
    //修改用户密码
    public function editPwd(){
        if(!IS_POST){
            $this->error('页面不存在');
        }
        $db=M('user');
        //验证旧密码
        $where=array('id',session('uid'));
        $old=$db->where($where)->getField('password');
        if($old!=md5(I('post.old'))){
            $this->error('旧密码错误');
        }
        if(I('post.new')!=I('post.newed')){
            $this->error('两次密码不一致');
        }
        $newPwd=md5(I('post.new'));
        $data=array(
            'id'=>session('uid'),
            'password'=>$newPwd
            );
        if($db->save($data)){
            $this->success('修改密码成功',U('index'));
        }else{
            $this->error('修改密码失败，请重试');
        }
    }
}

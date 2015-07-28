<?php
/**
 * 用户个人页控制器
 */
namespace Home\Controller;
use Think\Controller;
class UserController extends CommonController{
	/**
	 * 用户个人页视图
	 */
	public function index(){
		$id=I('get.uid/d');
		echo $id;
	} 
	/**
	 * 空操作
	 */
	public function _empty($name){
		$this->_getUrl($name);
	}
	/**
	 * 处理用户名空操作获得用户id跳转至用户个人页
	 */
	private function _getUrl($name){
		$name=htmlspecialchars($name);
		$where=array('nickname'=>$name);
		$uid=M('userinfo')->where($where)->getField('uid');
		//是否存在用户跳转不同页面
		if(!$uid){
			redirect(U('Index/index'));
		}else{
			redirect(U('/'.$uid));
		}
		
	}
}
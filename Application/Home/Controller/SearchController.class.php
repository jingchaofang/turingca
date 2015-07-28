<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends CommonController {
	/**
	 * 搜素找人
	 */
    public function sechUser(){
    	$keyword=$this->_getkeyword();
    	if($keyword){
    		//检索出除自己外昵称含有关键字的用户
    		$where=array(
    			'nickname'=>array('like','%'.$keyword.'%'),
    			'uid'=>array('neq',session('uid'))
    			);
    		$field=array('nickname','sex','location','intro','avatar80','follow','fans','weibo','uid');
    		$db=M('userinfo');
    		//导入分页类
    		$count=$db->where($where)->count('id');// 查询满足要求的总记录数
    		$Page= new \Think\Page($count,1);// 实例化分页类 传入总记录数和每页显示的记录数
    		$show= $Page->show();// 分页显示输出
    		$result=$db->where($where)->field($field)->limit($Page->firstRow.','.$Page->listRows)->select();
			//重组结果集得到是否互相关注与是否已关注
			$result=$this->_getMutual($result);
			//分配搜素结果集到视图
			$this->assign('result',$result?$result:false);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
    	}
    	$this->assign('keyword',$keyword);
        $this->display();
    }
    /**
     * 返回搜素关键字
     */
    private function _getkeyword(){
    	return I('get.keyword')=='搜素微博、找人' ? null : I('get.keyword');	
    }
    /**
     * 重组结果集得到是否互相关注与是否已关注
     * @param  [Array] $result [需要处理的结果集]
     * @return [Array]         [处理完成后的结果合集]
     */
    private function _getMutual($result){
    	if(!$result) return false;
    	$db=M('follow');
    	foreach($result as $k=>$v){
	    	//是否互相关注
	    	$sql = '(SELECT `follow` FROM `tca_follow` WHERE `follow` = ' . $v['uid'] . ' AND
	    	 `fans` = ' . session('uid') . ') UNION (SELECT `follow` FROM `tca_follow` WHERE
	    	  `follow` = ' . session('uid') . ' AND `fans` = ' . $v['uid'] . ')';
			
			$mutual=$db->query($sql);
			if(count($mutual)==2){
				$result[$k]['mutual']=1;
				$result[$k]['followed']=1;
			}else{
				$result[$k]['mutual']=0;
				//未互相关注检索是否已关注
				$where=array(
					'follow'=>$v['uid'],
					'fans'=>session('uid')
					);
				$result[$k]['followed']=$db->where($where)->count();
			}
    	}
    	return $result;
    }
}

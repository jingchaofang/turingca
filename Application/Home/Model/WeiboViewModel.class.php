<?php
/**
 * 读取微博视图模型
 */
namespace Home\Model;
use Think\Model\ViewModel;
class WeiboViewModel extends ViewModel {
	public $viewFields = array(
     'weibo'=>array('id','content','isturn','time','turn','keep','comment','uid','_type'=>'LEFT'),
     'userinfo'=>array('nickname','avatar50'=>'face','_on'=>'weibo.uid=userinfo.uid','_type'=>'LEFT'),
     'picture'=>array('mini','medium','max','_on'=>'weibo.id=picture.wid')
   );

	public function getAll($where){
		// return $this->where($where)->order('time desc')->select();
		$result=$this->where($where)->order('time desc')->select();
		//重组结果集数组，得到转发微博
		if($result){
			foreach ($result as $k => $v) {
				if($v['isturn']){
					$result[$k]['isturn']=$this->find($v['isturn']);
				}
			}
		}
		return $result;
	}
}
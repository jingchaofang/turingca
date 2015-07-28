<?php
/*用户与用户信息表的关联模型*/
namespace Home\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel{
    protected $_link = array(
         'userinfo'  => array(
             'mapping_type' => self::HAS_ONE,
             'class_name'   => 'userinfo',
             'foreign_key'  => 'uid',
         )
    );
    /*模型自动插入数据的方法*/
    public function insert($data=NULL){
    	$data=is_null($data) ? I('post.') : $data;
    	return $this->relation(true)->data($data)->add();
    }
}
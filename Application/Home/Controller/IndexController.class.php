<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
	/*系统首页*/
    public function index(){
        //实例化微博视图模型
        $db=D('WeiboView');
        //取得当前用户的ID与所有关注好友的ID
        $uid=array(session('uid'));
        $where=array('fans'=>session('uid'));
        $result=M('follow')->field('follow')->where($where)->select();
        if($result){
            foreach($result as $v){
                $uid[]=$v['follow'];
            }
        }
        //组合where条件，条件为当前用户的ID与所有关注好友的ID
        $map['uid']=array('in',$uid );
        //读取所有微博
        $weibo=$db->getAll($map);
        $this->assign('weibo',$weibo);
        $this->display();
    }
    /**
     * 发布微博
     */
    public function sendWeibo(){
        if(!IS_POST){
            $this->error('页面不存在');
        }
        $data=array(
            'content'=>I('post.content'),
            'time'=>time(),
            'uid'=>session('uid')
            );
        if($wid=M('weibo')->data($data)->add()){
            if(!empty(I('post.max'))){
                $img=array(
                    'mini'=>I('post.mini'),
                    'medium'=>I('post.medium'),
                    'max'=>I('post.max'),
                    'wid'=>$wid
                    );
                M('picture')->data($img)->add();
            }
            M('userinfo')->where(array('uid'=>session('uid')))->setInc('weibo');
            $this->success('发布成功',U('index'));
        }else{
            $this->error('发布失败请重试');
        }
    }
    /**
     * 转发微博
     */
    public function turn(){
        if(!IS_POST){
            $this->error('页面不存在');
        }
        //原微博ID
        $id=I('post.id/d');
        //转发内容
        $content=I('post.content');
        //提取插入数据
        $data=array(
            'content'=>$content,
            'isturn'=>$id,
            'time'=>time(),
            'uid'=>session('uid')
            );
        //插入数据到微博表
        $db=M('weibo');
        if($db->data($data)->add()){
            //原微博转发数+1
            $db->where(array('id'=>$id))->setInc('turn');
            //用户发布微博数+1
            M('userinfo')->where(array('uid'=>session('uid')))->setInc('weibo');
            //如果点击了同时评论，插入内容到评论表
            if(isset($_POST['becomment'])){
                $data=array(
                    'content'=>$content,
                    'time'=>time(),
                    'uid'=>session('uid'),
                    'wid'=>$id
                    );
                //插入评论数据后给原微博评论数+1
                if(M('comment')->data($data)->add()){
                    $db->where(array('id'=>$id))->setInc('comment');
                }
            }
            $this->success('转发成功',U('index'));
        }else{
            $this->error('转发失败，请重试..');            
        }
    }
    /**
     * 退出登录处理
     */
    public function loginOut(){
    	//卸载session
    	session_unset();
    	session_destroy();
    	//删除用于自动登录的cookie
    	cookie('auto',null);
    	//跳转至登录页
    	redirect(U('Login/index'));
    }
}

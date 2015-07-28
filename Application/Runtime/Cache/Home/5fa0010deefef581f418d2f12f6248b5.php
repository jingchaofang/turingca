<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>微博找人</title>
	<link rel="stylesheet" href="/turingca/Public/Css/nav.css" />
	<link rel="stylesheet" href="/turingca/Public/Css/sech_user.css" />
	<link rel="stylesheet" href="/turingca/Public/Css/bottom.css" />
	<script type="text/javascript" src='/turingca/Public/Js/jquery-1.7.2.min.js'></script>
    <script type="text/javascript" src='/turingca/Public/Js/nav.js'></script>
<!--==========顶部固定导行条==========-->
</head>
<body>
<!--==========顶部固定导行条==========-->
    <div id='top_wrap'>
        <div id="top">
            <div class='top_wrap'>
                <div class="logo fleft"></div>
                <ul class='top_left fleft'>
                    <li class='cur_bg'><a href='/turingca/index.php'>首页</a></li>
                    <li><a href=''>私信</a></li>
                    <li><a href=''>评论</a></li>
                    <li><a href=''>@我</a></li>
                </ul>
                <div id="search" class='fleft'>
                    <form action='<?php echo U("Search/sechUser");?>' method='get'>
                        <input type='text' name='keyword' id='sech_text' class='fleft' value='搜索微博、找人'/>
                        <input type='submit' value='' id='sech_sub' class='fleft'/>
                    </form>
                </div>
                <div class="user fleft"><a href="">后盾网</a></div>
                <ul class='top_right fleft'>
                    <li title='快速发微博' class='fast_send'><i class='icon icon-write'></i></li>
                    <li class='selector'><i class='icon icon-msg'></i>
                        <ul class='hidden'>
                            <li><a href="">查看评论</a></li>
                            <li><a href="">查看私信</a></li>
                            <li><a href="">查看收藏</a></li>
                            <li><a href="">查看@我</a></li>
                        </ul>
                    </li>
                    <li class='selector'><i class='icon icon-setup'></i>
                        <ul class='hidden'>
                            <li><a href="<?php echo U('UserSetting/index');?>">帐号设置</a></li>
                            <li><a href="">模版设置</a></li>
                            <li><a href="<?php echo U('Index/loginOut');?>">退出登录</a></li>
                        </ul>
                    </li>
                <!--信息推送-->
                    <li id='news' class='hidden'>
                        <i class='icon icon-news'></i>
                        <ul>
                            <li class='news_comment hidden'>
                                <a href=""></a>
                            </li>
                            <li class='news_letter hidden'>
                                <a href=""></a>
                            </li>
                            <li class='news_atme hidden'>
                                <a href=""></a>
                            </li>
                        </ul>
                    </li>
                <!--信息推送-->
                </ul>
            </div>
        </div>
    </div>
<!--==========顶部固定导行条==========-->
<!--==========加关注弹出框==========-->

<?php  $group = M('group')->where(array('uid' => session('uid')))->select(); ?>
    <script type='text/javascript'>
        var addFollow = "<?php echo U('Common/addFollow');?>";
    </script>
    <div id='follow'>
        <div class="follow_head">
            <span class='follow_text fleft'>关注好友</span>
        </div>
        <div class='sel-group'>
            <span>好友分组：</span>
            <select name="gid">
                <option value="0">默认分组</option>
                <?php if(is_array($group)): foreach($group as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
        <div class='fl-btn-wrap'>
            <input type="hidden" name='follow'/>
            <span class='add-follow-sub'>关注</span>
            <span class='follow-cencle'>取消</span>
        </div>
    </div>
<!--==========加关注弹出框==========-->
<!--==========内容主体==========-->
	<div style='height:60px;opcity:10'></div>
    <div class="main">
    <!--=====左侧=====-->
        <!--=====左侧=====-->
    <div id="left" class='fleft'>
        <ul class='left_nav'>
            <li><a href="/turingca/index.php"><i class='icon icon-home'></i>&nbsp;&nbsp;首页</a></li>
            <li><a href=""><i class='icon icon-at'></i>&nbsp;&nbsp;提到我的</a></li>
            <li><a href=""><i class='icon icon-comment'></i>&nbsp;&nbsp;评论</a></li>
            <li><a href=""><i class='icon icon-letter'></i>&nbsp;&nbsp;私信</a></li>
            <li><a href=""><i class='icon icon-keep'></i>&nbsp;&nbsp;收藏</a></li>
        </ul>
        <div class="group">
            <fieldset><legend>分组</legend></fieldset>
            <ul>
                <?php $group = M("group")->where(array('uid' => session('uid')))->select(); ?>
                <li><a href="/turingca/index.php"><i class='icon icon-group'></i>&nbsp;&nbsp;全部</a></li>
                <?php if(is_array($group)): foreach($group as $key=>$v): ?><li>
                        <a href="<?php echo U('Index/index', array('gid' => $v['id']));?>"><i class='icon icon-group'></i>&nbsp;&nbsp;<?php echo ($v["name"]); ?></a>
                    </li><?php endforeach; endif; ?>
            </ul>
            <span id='create_group'>创建新分组</span>
        </div>
    </div>
    
    <!--==========创建分组==========-->
    <script type='text/javascript'>
        var addGroup = "<?php echo U('Common:addGroup');?>";
    </script>
    <div id='add-group' class='hidden'>
        <div class="group_head">
            <span class='group_text fleft'>创建好友分组</span>
        </div>
        <div class='group-name'>
            <span>分组名称：</span>
            <input type="text" name='name' id='gp-name'>
        </div>
        <div class='gp-btn-wrap'>
            <span class='add-group-sub'>添加</span>
            <span class='group-cencle'>取消</span>
        </div>
    </div>
    <!--==========创建分组==========-->
        <div id='right'>
    		<p id='sech-logo'></p>
    		<div id='sech'>
    			<div>
	    			<form action="<?php echo U('sechUser');?>" method='get'>
	    				<input type="text" name='keyword' id='sech-cons' value='<?php if($keyword): echo ($keyword); else: ?>搜索微博、找人<?php endif; ?>'/>
	    				<input type="submit" value='搜&nbsp;索' id='sech-sub'/>
	    			</form>
    			</div>
    			<ul>
                    <li><span class='cur'>找人</span></li>
    				<li><span>微博</span></li>
    			</ul>
    		</div>
    		<?php if(isset($result)): ?><div id='content'>
    			<?php if($result): ?><div class='view_line'>
	                <strong>用户</strong>
	            </div>
	            <ul>
	            	<?php if(is_array($result)): foreach($result as $key=>$v): ?><li>
						<dl class='list-left'>
							<dt>
								<img src="
								<?php if($v["avatar80"]): ?>/turingca/Uploads/Face/<?php echo ($v["avatar80"]); ?>
								<?php else: ?>
									/turingca/Public/Images/noface.gif<?php endif; ?>" width='80' height='80'/>
							</dt>
							<dd>
								<a href=""><?php echo (str_replace($keyword, '<font style="color:red">' . $keyword . '</font>', $v["nickname"])); ?></a>
							</dd>
							<dd>
								<i class='icon icon-boy'></i>&nbsp;
								<span>
									<?php if($v["location"]): echo ($v["location"]); ?>
									<?php else: ?>
										该用户未填写所在地<?php endif; ?>
								</span>
							</dd>
							<dd>
								<span>关注 <a href=""><?php echo ($v["follow"]); ?></a></span>
								<span class='bd-l'>粉丝 <a href=""><?php echo ($v["fans"]); ?></a></span>
								<span class='bd-l'>微博 <a href=""><?php echo ($v["weibo"]); ?></a></span>
							</dd>
						</dl>
	    				<dl class='list-right'>
	    					<?php if($v["mutual"]): ?><dt>互相关注</dt>
	    						<dd>移除</dd>
    						<?php elseif($v["followed"]): ?>
                            	<dt>√&nbsp;已关注</dt>
                            	<dd>移除</dd>
                        	<?php else: ?>
	    						<dt class='add-fl' uid='<?php echo ($v["uid"]); ?>'>+&nbsp;关注</dt><?php endif; ?>
	    				</dl>
	    			</li><?php endforeach; endif; ?>
    			</ul>
    			<div style="text-align:center;padding:20px;"><?php echo ($page); ?></div>
    			<?php else: ?>
    				<p style='text-indent:7em;'>未找到与<strong style='color:red'><?php echo ($keyword); ?></strong>相关的用户</p><?php endif; ?>
	        </div><?php endif; ?>
    	</div>
    </div>
<!--==========内容主体结束==========-->
<!--==========底部==========-->
    <div id="bottom">
        <div class='link'>
            <dl>
                <dt>后盾网论坛</dt>
                <dd><a href="">后盾网免费视频教程</a></dd>
                <dd><a href="">后盾网免费视频教程</a></dd>
                <dd><a href="">后盾网免费视频教程</a></dd>
            </dl>
            <dl>
                <dt>后盾网论坛</dt>
                <dd><a href="">后盾网免费视频教程</a></dd>
                <dd><a href="">后盾网免费视频教程</a></dd>
                <dd><a href="">后盾网免费视频教程</a></dd>
            </dl>
            <dl>
                <dt>后盾网论坛</dt>
                <dd><a href="">后盾网免费视频教程</a></dd>
                <dd><a href="">后盾网免费视频教程</a></dd>
                <dd><a href="">后盾网免费视频教程</a></dd>
            </dl>
            <dl>
                <dt>后盾网论坛</dt>
                <dd><a href="">后盾网免费视频教程</a></dd>
                <dd><a href="">后盾网免费视频教程</a></dd>
                <dd><a href="">后盾网免费视频教程</a></dd>
            </dl>
            <dl>
                <dt>后盾网论坛</dt>
                <dd><a href="">后盾网免费视频教程</a></dd>
                <dd><a href="">后盾网免费视频教程</a></dd>
                <dd><a href="">后盾网免费视频教程</a></dd>
            </dl>
        </div>
        <div id="copy">
            <div>
                <p>
                    版权所有：后盾网 京ICP备10027771号-1 站长统计 All rights reserved, houdunwang.com services for Beijing 2008-2012 
                </p>
            </div>
        </div>
    </div>

<!--[if IE 6]>
    <script type="text/javascript" src="/turingca/Public/Js/DD_belatedPNG_0.0.8a-min.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('#top','background');
        DD_belatedPNG.fix('.logo','background');
        DD_belatedPNG.fix('#sech_text','background');
        DD_belatedPNG.fix('#sech_sub','background');
        DD_belatedPNG.fix('.send_title','background');
        DD_belatedPNG.fix('.icon','background');
        DD_belatedPNG.fix('.ta_right','background');
    </script>
<![endif]-->


</body>
</html>
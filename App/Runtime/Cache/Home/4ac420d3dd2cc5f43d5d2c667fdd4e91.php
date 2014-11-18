<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>微博系统--我的首页</title>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/jquery.ui.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/rl_exp.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/lee_pic.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/weibo/Public/Home/js/index.js"></script>
<link rel="stylesheet" href="/weibo/Public/Home/css/jquery.ui.css">
<link rel="stylesheet" href="/weibo/Public/Home/css/rl_exp.css">
<link rel="stylesheet" href="/weibo/Public/Home/uploadify/uploadify.css">
<link rel="stylesheet" href="/weibo/Public/Home/css/index.css">
<script type="text/javascript">
var ThinkPHP = {
	'ROOT' : '/weibo',
	'MODULE' : '/weibo/Home',
	'IMG' : '/weibo/Public/<?php echo MODULE_NAME;?>/img',
	'FACE' : '/weibo/Public/<?php echo MODULE_NAME;?>/face',
	'UPLOADIFY' : '/weibo/Public/Home/uploadify',
	'UPLOADER' : '<?php echo U("File/upload");?>',
	'INDEX' : '<?php echo U("Index/index");?>',
};
</script>
</head>
<body>


<div id="header">
	<div class="header_main">
		<div class="logo">微博系统</div>
		<div class="nav">
			<ul>
				<li><a href="#" class="selected">首页</a></li>
				<li><a href="#">广场</a></li>
				<li><a href="#">图片</a></li>
				<li><a href="#">找人</a></li>
			</ul>
		</div>
		<div class="person">
			<ul>
				<li><a href="#">蜡笔小新</a></li>
				<li class="app">消息
					<dl class="list">
						<dd><a href="#">@提到我的</a></dd>
						<dd><a href="#">收到的评论</a></dd>
						<dd><a href="#">发出的评论</a></dd>
						<dd><a href="#">我的私信</a></dd>
						<dd><a href="#">系统消息</a></dd>
						<dd><a href="#" class="line">发私信»</a></dd>
					</dl>
				</li>
				<li class="app">帐号
					<dl class="list">
						<dd><a href="#">个人设置</a></dd>
						<dd><a href="#">排行榜</a></dd>
						<dd><a href="#">申请认证</a></dd>
						<dd><a href="<?php echo U('User/logout');?>" class="line">退出»</a></dd>
					</dl>
				</li>
			</ul>
		</div>
		<div class="search">
			<form method="post" action="#">
				<input type="text" id="search" placeholder="请输入微博关键字">
				<a href="javascript:void(0)"></a>
			</form>
		</div>
	</div>
</div>

<div id="main">
	
	<div class="main_left">
		<div class="weibo_form">
			<span class="left">和大家分享一点新鲜事吧？</span>
			<span class="right weibo_num">可以输入<strong>140</strong>个字</span>
			<textarea class="weibo_text" id="rl_exp_input"></textarea>
			<a href="javascript:void(0);" class="weibo_face" id="rl_exp_btn">表情<span class="face_arrow_top"></span></a>
			<div class="rl_exp" id="rl_bq" style="display:none;">
				<ul class="rl_exp_tab clearfix">
					<li><a href="javascript:void(0);" class="selected">默认</a></li>
					<li><a href="javascript:void(0);">拜年</a></li>
					<li><a href="javascript:void(0);">浪小花</a></li>
					<li><a href="javascript:void(0);">暴走漫画</a></li>
				</ul>
				<ul class="rl_exp_main clearfix rl_selected"></ul>
				<ul class="rl_exp_main clearfix" style="display:none;"></ul>
				<ul class="rl_exp_main clearfix" style="display:none;"></ul>
				<ul class="rl_exp_main clearfix" style="display:none;"></ul>
				<a href="javascript:void(0);" class="close">×</a>
			</div>
			<a href="javascript:void(0);" class="weibo_pic" id="pic_btn">图片<span class="pic_arrow_top"></span></a>
			<div class="weibo_pic_box" id="pic_box" style="display:none;">
				<div class="weibo_pic_header">
					<span class="weibo_pic_info">共 <span class="weibo_pic_total">0</span> 张，还能上传 <span class="weibo_pic_limit">8</span> 张（按住ctrl可选择多张）</span>
					<a href="javascript:void(0);" class="close">×</a>
				</div>
				<div class="weibo_pic_list"></div>
				<input type="file" name="file" id="file">
			</div>
			<input class="weibo_button" type="button" value="发布">
		</div>	
		<div class="weibo_content">
			<ul>
				<li><a href="javascript:void(0)" class="selected">我关注的<i class="nav_arrow"></i></a></li>
				<li><a href="javascript:void(0)">互听的</a></li>
			</ul>
			<?php if(is_array($topicList)): $i = 0; $__LIST__ = $topicList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><dl class="weibo_content_data">
				<dt><a href="javascript:void(0)"><img src="/weibo/Public/Home/img/small_face.jpg" alt=""></a></dt>
				<dd>
					<h4><a href="javascript:void(0)"><?php echo ($obj["username"]); ?></a></h4>
					<p><?php echo ($obj["content"]); echo ($obj["content_over"]); ?></p>
					<?php switch($obj["count"]): case "0": break;?>
						<?php case "1": ?><div class="img"><img src="/weibo/<?php echo ($obj['images'][0]['thumb']); ?>" alt=""></div><?php break;?>
						<?php default: ?>
							<?php $__FOR_START_22747__=0;$__FOR_END_22747__=8;for($i=$__FOR_START_22747__;$i < $__FOR_END_22747__;$i+=1){ ?><div class="imgs"><img src="/weibo/<?php echo ($obj['images'][$i]['thumb']); ?>" alt=""></div><?php } endswitch;?>
					<div class="footer">
						<span class="time"><?php echo ($obj["create"]); ?></span>
						<span class="handler">赞(0) | 转播 | 评论 | 收藏</span>
					</div>
				</dd>
			</dl><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
	<div class="main_right">
		right
	</div>

</div>

<div id="error">...</div>
<div id="loading">...</div>
<div id="footer">
	<div class="footer_left">&copy; 2014 Ycku.com All Rights Reserved.</div>
	<div class="footer_right">Powered By ThinkPHP.</div>
</div>



</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="160780470@qq.com" />
<meta name="Copyright" content="<?php echo ($ikphp["ikphp_site_name"]); ?>" />
<title><?php echo ($title); ?> - <?php echo ($site_title); ?></title>
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/style.css" />
<!--[if gte IE 7]><!-->
    <link href="__STATIC__/admin/js/dialog/skins5/idialog.css" rel="stylesheet" />
<!--<![endif]-->
<!--[if lt IE 7]>
    <link href="__STATIC__/admin/js/dialog/skins5/idialog.css" rel="stylesheet" />
<![endif]-->
<script src="__STATIC__/admin/js/jquery.js" type="text/javascript"></script>
<script src="__STATIC__/admin/js/ajaxfileupload.js" type="text/javascript"></script>
<script src="__STATIC__/admin/js/common.js" type="text/javascript"></script>
<script>
var siteUrl = "<?php echo C('ik_site_url');?>";
</script>
<script src="__STATIC__/admin/js/dialog/jquery.artDialog.min5.js" type="text/javascript"></script> 
<script language="javascript">
function tips(c){ $.dialog({content: '<font style="font-size:14px;">'+c+'</font>',fixed: true, width:300, time:1500});}
function succ(c){ $.dialog({icon: 'succeed',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}
function error(c){$.dialog({icon: 'error',content: '<font  style="font-size:14px;">'+c+'</font>' , time:2000});}
</script>
</head>
<body>
<!--main-->
<div class="midder">
<h2><?php echo ($title); ?></h2>
<div class="tabnav">
<ul>
<li  <?php if($type == "index"): ?>class="select"<?php endif; ?> ><a href="<?php echo U('setting/index');?>">基本配置</a></li>
<li  <?php if($type == "site"): ?>class="select"<?php endif; ?> ><a href="<?php echo U('setting/index',array('type'=>'site'));?>">全局配置</a></li>
<li  <?php if($type == "attachment"): ?>class="select"<?php endif; ?> ><a href="<?php echo U('setting/index',array('type'=>'attachment'));?>">附件设置</a></li>
</ul>
</div>
<form method="POST" action="<?php echo U('setting/edit');?>">
<table cellpadding="0" cellspacing="0">

	<tr>
		<th>附件保存位置 ：</th>
		<td><input style="width: 300px;" name="setting[attach_path]"  size="50" value="<?php echo C('ik_attach_path');?>" /></td>
	</tr>
	<tr>
		<th>附件类型限制 ：</th>
		<td><input style="width: 300px;" name="setting[attr_allow_exts]" size="50" value="<?php echo C('ik_attr_allow_exts');?>" /></td>
	</tr>
	<tr>
		<th>附件大小限制 ：</th>
		<td><input style="width: 300px;" name="setting[attr_allow_size]"  value="<?php echo C('ik_attr_allow_size');?>" /></td>
	</tr>        

</table>

<div class="page_btn"><input type="submit" value="提 交" class="submit" /></div>

</form>
</div>
</body>
</html>
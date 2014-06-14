<?php /* Smarty version 2.6.7, created on 2012-07-24 18:04:17
         compiled from admin/upload.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'encrypt', 'admin/upload.tpl', 54, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="js/jquery/swfupload/style.upload.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery/jquery.min.js"></script>

</head>
<body>

<span class="y"><a onclick="self.parent.tb_remove();" class="flbc" href="javascript:;">关闭</a></span>
<?php if ($_GET['a'] == 'crop'): ?>

	<script type="text/javascript" src="js/jquery/swfupload/script.js"></script>
    <link href="js/jquery/ui/jquery-ui-1.7.2.custom.css" rel="Stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery/ui/jquery-ui-1.7.2.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery/jquery.cropzoom.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
       var cropzoom = $('#crop_container').cropzoom({
            width:670,
            height:410,
            bgColor: '#5f5f5f',
            enableRotation:true,
            enableZoom:true,
            zoomSteps:10,
            rotationSteps:10,
            selector:{
               x:0,
              y:0,
              w:140,
              h:105,
              aspectRatio:true,
              centered:true,
              borderColor:'blue',
              borderColorHover:'yellow',
              bgInfoLayer: '#FFF',
              infoFontSize: 10,
              infoFontColor: 'blue',
              showPositionsOnDrag: true,
              showDimetionsOnDrag: true,
              maxHeight: null,
              maxWidth: null

            },
            image:{
                source:'<?php echo @IMG_HOST;  echo $_GET['fileurl']; ?>
',
                width:<?php echo $this->_tpl_vars['file']['width']; ?>
,
                height:<?php echo $this->_tpl_vars['file']['height']; ?>
,
                minZoom:10,
                maxZoom:150
            }
        });
        $('#cropbtn').click(function(){
            cropzoom.send('?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
','POST',{},function(rta){
            	window.location='?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=view&fileurl=<?php echo $_GET['fileurl']; ?>
';
            });
        });
        $('#thumbbtn').click(function(){
            cropzoom.send('?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
','POST',{thumb:1},function(rta){
            	//alert(rta);
            	window.location='?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=view&fileurl=<?php echo $_GET['fileurl']; ?>
';
            });
        });
        $('#backbtn').click(function(){
            window.location='?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
';
        })
    })

</script>
<style>
#imgfileUploader{ border:0px}
</style>
<!--<div id="crop_container"></div>-->
 <div class="avatar">
     <dl>
       <dt id="crop_container"></dt>
       <dd>
           <input name="backbtn"  id="backbtn"  type="image"  class="c1" src="js/jquery/swfupload/avatar1.gif">
           <input name="cropbtn"  id="cropbtn" type="image"  class="c3" src="js/jquery/swfupload/avatar3.gif">
           <input name="cropbtn"  id="thumbbtn" type="image"  class="c2" src="js/jquery/swfupload/avatar2.gif">
       </dd>

     </dl>


 </div>
 <?php elseif ($_GET['a'] == 'multiimg'): ?>
 <script type="text/javascript" src="js/jquery/swfupload/jquery.uploadify.min.js"></script>
 <script type="text/javascript" src="js/jquery/swfupload/swfobject.js"></script>
    <script type="text/javascript">
	$(document).ready(function() {
		var arr = new Array();
		$("#mimgfile").uploadify({
			'uploader': 'js/jquery/swfupload/uploadify.swf',
			'cancelImg': 'js/jquery/swfupload/cancel.png',
			'script': '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
',
			'buttonImg': 'js/jquery/swfupload/upload1.gif',
			'width':'60',
			'height':'32',
			'folder': '<?php echo $this->_tpl_vars['path']; ?>
',
			'fileDesc': 'Image Files',
			'fileExt': '*.jpg;*.jpeg;*.gif;*.png;*.flv;*.txt;*.doc;*.docx;*.pdf;*.xls;*.xlsx;*.ppt;*.pptx',
			'multi': true,
			'scriptData': {"SESSION_ID":"<?php echo $this->_tpl_vars['session_id']; ?>
","pid":"<?php echo $_GET['pid']; ?>
","utype":"<?php echo $_GET['utype']; ?>
"},
			'queueID': 'fileQueue',
			onComplete: function (evt, queueID, fileObj, response, data) {
				arr.push(response);
			   },
			onAllComplete: function (evt, queueID, fileObj, response, data) {
			//处理图片归属
			var str = "<div id='photolist'>";
			$.each(arr,function(i,j){s = j.split("/");str+= "<input type='hidden' name='photoname[]' value='"+s[3]+"' />";});
			str+= "</div>";
			parent.$("#myForm").append(str);

				 }
		});
		$("#upbtn").click(function(){
			$('#mimgfile').uploadifyUpload();
		});

	});

	</script>
<!---->
<style>

.upload ul.title2 li{ float:left !important; border:#DCDCDE solid 1px; border-bottom:0; background: url(./images/sew-8.gif) repeat-x top; margin-right:5px; padding:0 8px;height:24px !important}
.upload ul.title2 li a{ text-decoration:none; color:#666}
.upload ul.title2 li.a1{ position:static; z-index:auto !important;  border:#DCDCDE solid 1px; border-bottom:0;height:25px !important; width:auto !important}
</style>

   <div class="upload">
    <ul class="title2">
        <li class="a1"><a href="?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=multiimg&utype=<?php echo $_GET['utype']; ?>
&pid=<?php echo $_GET['pid'];  if ($_GET['t']): ?>&t=tinymce&input=<?php echo $_GET['input'];  endif; ?>">批量上传</a></li>
        <li class="a2"><a href="?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=purview&utype=<?php echo $_GET['utype']; ?>
&pid=<?php echo $_GET['pid'];  if ($_GET['t']): ?>&t=tinymce&input=<?php echo $_GET['input'];  endif; ?>">图片列表</a></li>
		<li class="a2"><a href="?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=video&utype=<?php echo $_GET['utype']; ?>
&pid=<?php echo $_GET['pid'];  if ($_GET['t']): ?>&t=tinymce&input=<?php echo $_GET['input'];  endif; ?>">其他列表</a></li>
	</ul>
    <div class="upload_a">

      <input type="file" name="mimgfile" id="mimgfile">
      <input name="upbtn" id="upbtn" type="image"   src="js/jquery/swfupload/upload2.gif">
    </div>
    <div class="mc">
      <span class="left22">文件名（大小）</span>
      <span class="right22"> 删除</span>
      <span class="right22">上传进度</span>
    </div>

    <div class="c1" id="fileQueue" ></div>

    <p class="txt">

        文件尺寸：<b>大小不限制</b>    格式要求：<b>GIF  JPG PNG  FLV</b>

    </p>

 </div>

<?php elseif ($_GET['a'] == 'video'): ?>
<script type="text/javascript">
function delAttach(id)
{
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=delatt",
				data: "id="+id,
				success: function(){
				 location.reload();
				}
			});
		}
}

function setAttach(id,file)
{
	var html;
	if(confirm("确认插入该文件吗？"))
		{
			<?php if ($_GET['t']): ?>
			html = "<a href='http://<?php echo $this->_tpl_vars['SERVER_NAME']; ?>
/uploads"+file+"' target='_blank'>点击下载</a>";
			parent.tinyMCE.execCommand('mceInsertContent','<?php echo $_GET['input']; ?>
',html);
			<?php else: ?>
			html = parent.document.getElementById('piclist').innerHTML;
			html =  html + "<div class=\"img_mc\"><img onclick=\"dotb('上传', '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=crop&fileurl="+file+"&keepThis=true&TB_iframe=false&height=422&width=800');return false;\" class=\"image\" id=\"preview\" alt=\"\" src=\"<?php echo @IMG_HOST; ?>
"+file+"\" height=\"100\" title=\"点击替换主题图片\"/><input name=\"aid[]\" type=\"hidden\" value=\""+id+"\"/><p><a href=\"#\" onclick=\"$(this).parent().parent().remove();\">删除</a></p></div>";
			parent.document.getElementById('piclist').innerHTML = html;
			<?php endif; ?>
			self.parent.tb_remove();
		}

}
</script>

<style>

.upload ul.title2 li{ float:left !important; border:#DCDCDE solid 1px; border-bottom:0; background: url(./images/sew-8.gif) repeat-x top; margin-right:5px; padding:0 8px;height:24px !important}
.upload ul.title2 li a{ text-decoration:none; color:#666}
.upload ul.title2 li.a1{ position:static; z-index:auto !important;  border:#DCDCDE solid 1px; border-bottom:0;height:25px !important; width:auto !important}
</style>

   <div class="upload">
    <ul class="title2">
        <li class="a2"><a href="?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=multiimg&utype=<?php echo $_GET['utype']; ?>
&pid=<?php echo $_GET['pid'];  if ($_GET['t']): ?>&t=tinymce&input=<?php echo $_GET['input'];  endif; ?>">批量上传</a></li>
        <li class="a2"><a href="?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=purview&utype=<?php echo $_GET['utype']; ?>
&pid=<?php echo $_GET['pid'];  if ($_GET['t']): ?>&t=tinymce&input=<?php echo $_GET['input'];  endif; ?>">图片列表</a></li>
        <li class="a1"><a href="?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=video&utype=<?php echo $_GET['utype']; ?>
&pid=<?php echo $_GET['pid'];  if ($_GET['t']): ?>&t=tinymce&input=<?php echo $_GET['input'];  endif; ?>">其他列表</a></li>
	</ul>

     <div class="mclist">
     <form name="myform" method="POST">
       <?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['logs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['data']['show'] = true;
$this->_sections['data']['max'] = $this->_sections['data']['loop'];
$this->_sections['data']['step'] = 1;
$this->_sections['data']['start'] = $this->_sections['data']['step'] > 0 ? 0 : $this->_sections['data']['loop']-1;
if ($this->_sections['data']['show']) {
    $this->_sections['data']['total'] = $this->_sections['data']['loop'];
    if ($this->_sections['data']['total'] == 0)
        $this->_sections['data']['show'] = false;
} else
    $this->_sections['data']['total'] = 0;
if ($this->_sections['data']['show']):

            for ($this->_sections['data']['index'] = $this->_sections['data']['start'], $this->_sections['data']['iteration'] = 1;
                 $this->_sections['data']['iteration'] <= $this->_sections['data']['total'];
                 $this->_sections['data']['index'] += $this->_sections['data']['step'], $this->_sections['data']['iteration']++):
$this->_sections['data']['rownum'] = $this->_sections['data']['iteration'];
$this->_sections['data']['index_prev'] = $this->_sections['data']['index'] - $this->_sections['data']['step'];
$this->_sections['data']['index_next'] = $this->_sections['data']['index'] + $this->_sections['data']['step'];
$this->_sections['data']['first']      = ($this->_sections['data']['iteration'] == 1);
$this->_sections['data']['last']       = ($this->_sections['data']['iteration'] == $this->_sections['data']['total']);
?>
     <div class="img_a">
		<span><p>文件编号：<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
</p>
		<a href="#" onclick="setAttach('<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
','<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['attachment']; ?>
')" title="选用">选用<img src="js/jquery/swfupload/11.gif"  /></a><a href="#" onclick="delAttach('<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
')" title="删除"><img src="js/jquery/swfupload/10.gif"  />删除</a>
		</span>
		</div>
<?php endfor; endif; ?>


       <!--{/loop}-->
    </form>
    </div>
    <div style="clear:both"></div>
 <style>
.upload .txt22{
    bottom: 0px;
	color:#09C;
    height: 22px;
	right:10px;
    line-height: 22px;
    position: absolute;
    text-align: left;
    width: 410px;
	text-align:right; padding-right:25px

	}
   </style>
     <p class="txt22">
        点击选用添加到内容中</b>

    </p>
    <p class="txt">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/pages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </b>

    </p>

 </div>
 <?php elseif ($_GET['a'] == 'purview'): ?>
<script type="text/javascript">
function delAttach(id)
{
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=delatt",
				data: "id="+id,
				success: function(){
				 location.reload();
				}
			});
		}
}

function setAttach(id,file)
{
	var html;
	if(confirm("确认选用该图片吗？"))
		{
			<?php if ($_GET['t']): ?>
			html = '<a target="_blank" href="<?php echo @IMG_HOST; ?>
'+file+'"> <img border="0" src="<?php echo @IMG_HOST; ?>
'+file+'.thumb.jpg"></a>';
			parent.tinyMCE.execCommand('mceInsertContent','<?php echo $_GET['input']; ?>
',html);
			<?php else: ?>
			html = parent.document.getElementById('piclist').innerHTML;
			html =  html + "<div class=\"img_mc\"><img onclick=\"dotb('上传', '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=crop&fileurl="+file+"&keepThis=true&TB_iframe=false&height=422&width=800');return false;\" class=\"image\" id=\"preview\" alt=\"\" src=\"<?php echo @IMG_HOST; ?>
"+file+"\" height=\"100\" title=\"点击替换主题图片\"/><input name=\"aid[]\" type=\"hidden\" value=\""+id+"\"/><p><a href=\"#\" onclick=\"$(this).parent().parent().remove();\">删除</a></p></div>";
			parent.document.getElementById('piclist').innerHTML = html;
			<?php endif; ?>
			self.parent.tb_remove();
		}

}
</script>

<style>

.upload ul.title2 li{ float:left !important; border:#DCDCDE solid 1px; border-bottom:0; background: url(./images/sew-8.gif) repeat-x top; margin-right:5px; padding:0 8px;height:24px !important}
.upload ul.title2 li a{ text-decoration:none; color:#666}
.upload ul.title2 li.a1{ position:static; z-index:auto !important;  border:#DCDCDE solid 1px; border-bottom:0;height:25px !important; width:auto !important}
</style>

   <div class="upload">
    <ul class="title2">
        <li class="a2"><a href="?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=multiimg&utype=<?php echo $_GET['utype']; ?>
&pid=<?php echo $_GET['pid'];  if ($_GET['t']): ?>&t=tinymce&input=<?php echo $_GET['input'];  endif; ?>">批量上传</a></li>
        <li class="a1"><a href="?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=purview&utype=<?php echo $_GET['utype']; ?>
&pid=<?php echo $_GET['pid'];  if ($_GET['t']): ?>&t=tinymce&input=<?php echo $_GET['input'];  endif; ?>">图片列表</a></li>
		<li class="a2"><a href="?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=video&utype=<?php echo $_GET['utype']; ?>
&pid=<?php echo $_GET['pid'];  if ($_GET['t']): ?>&t=tinymce&input=<?php echo $_GET['input'];  endif; ?>">其他列表</a></li>
	</ul>

     <div class="mclist">
     <form name="myform" method="POST">
       <?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['logs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['data']['show'] = true;
$this->_sections['data']['max'] = $this->_sections['data']['loop'];
$this->_sections['data']['step'] = 1;
$this->_sections['data']['start'] = $this->_sections['data']['step'] > 0 ? 0 : $this->_sections['data']['loop']-1;
if ($this->_sections['data']['show']) {
    $this->_sections['data']['total'] = $this->_sections['data']['loop'];
    if ($this->_sections['data']['total'] == 0)
        $this->_sections['data']['show'] = false;
} else
    $this->_sections['data']['total'] = 0;
if ($this->_sections['data']['show']):

            for ($this->_sections['data']['index'] = $this->_sections['data']['start'], $this->_sections['data']['iteration'] = 1;
                 $this->_sections['data']['iteration'] <= $this->_sections['data']['total'];
                 $this->_sections['data']['index'] += $this->_sections['data']['step'], $this->_sections['data']['iteration']++):
$this->_sections['data']['rownum'] = $this->_sections['data']['iteration'];
$this->_sections['data']['index_prev'] = $this->_sections['data']['index'] - $this->_sections['data']['step'];
$this->_sections['data']['index_next'] = $this->_sections['data']['index'] + $this->_sections['data']['step'];
$this->_sections['data']['first']      = ($this->_sections['data']['iteration'] == 1);
$this->_sections['data']['last']       = ($this->_sections['data']['iteration'] == $this->_sections['data']['total']);
?>
     <div class="img_a"><a href="?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=crop&fileurl=<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['attachment']; ?>
" class="lighttxt" id="attachname<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
" title="<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['filename']; ?>

		上传日期: <?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['filedate']; ?>

		文件大小: <?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['filesize']; ?>
文件大小: <?php echo $this->_tpl_vars['att'][$this->_sections['filesize']['index']]; ?>
"><img src="<?php echo @IMG_HOST;  echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['attachment']; ?>
.thumb.jpg " class="img" width="100"></a></span>
		<span>
		<a href="#" onclick="setAttach('<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
','<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['attachment']; ?>
')" title="选用">选用<img src="js/jquery/swfupload/11.gif"  /></a><a href="#" onclick="delAttach('<?php echo $this->_tpl_vars['logs'][$this->_sections['data']['index']]['id']; ?>
')" title="删除"><img src="js/jquery/swfupload/10.gif"  />删除</a>
		</span>
		</div>
		<?php endfor; endif; ?>


       <!--{/loop}-->
    </form>
    </div>
    <div style="clear:both"></div>
 <style>
.upload .txt22{
    bottom: 0px;
	color:#09C;
    height: 22px;
	right:10px;
    line-height: 22px;
    position: absolute;
    text-align: left;
    width: 410px;
	text-align:right; padding-right:25px

	}
   </style>
     <p class="txt22">
        点击选用添加到内容中</b>

    </p>
    <p class="txt">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/pages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </b>

    </p>

 </div>
<?php elseif ($_GET['a'] == 'view'): ?>
 <script type="text/javascript">
    $(document).ready(function(){
        $('#closebtn').click(function(){
				parent.document.getElementById('preview').src = "<?php echo @IMG_HOST;  echo $this->_tpl_vars['file']['url']; ?>
.100x100.jpg";
				parent.document.getElementById('picpath').value = "<?php echo $this->_tpl_vars['file']['url']; ?>
";
				self.parent.tb_remove();
        })
    })

</script>
<!---->
 <div class="avatar2">
   <div class="avatar2_250"><img src="<?php echo @IMG_HOST;  echo $this->_tpl_vars['file']['url']; ?>
.280x280.jpg"></div>
   <div class="avatar2_140"><img src="<?php echo @IMG_HOST;  echo $this->_tpl_vars['file']['url']; ?>
.140x140.jpg"></div>
   <div class="avatar2_89"><img src="<?php echo @IMG_HOST;  echo $this->_tpl_vars['file']['url']; ?>
.100x100.jpg"></div>

   <div class="avatar2_btn">
      <h3>上传成功</h3>
      <p>以上是您图片三种尺寸</p>
   <input name="closebtn" id="closebtn" type="image"  class="avatar1_btn" src="js/jquery/swfupload/avatar2_btn.gif" >
   </div>
 </div>
<?php else: ?>
<script type="text/javascript" src="js/jquery/swfupload/jquery.uploadify.min.js"></script>
 <script type="text/javascript" src="js/jquery/swfupload/swfobject.js"></script>

    <script type="text/javascript">
	$(document).ready(function() {

		$("#imgfile").uploadify({
			'uploader': 'js/jquery/swfupload/uploadify.swf',
			'cancelImg': 'images/cancel.png',
			'script': '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
',
			'buttonImg': 'images/avatar3_btn.gif',
			'width':'298',
			'height':'57',
			'folder': '<?php echo $this->_tpl_vars['path']; ?>
',
			'fileDesc': 'Image Files',
			'fileExt': '*.jpg;*.jpeg;*.gif;*.png;*.flv;*.txt;*.doc;*.docx;*.pdf;*.xls;*.xlsx;*.ppt;*.pptx',
			'multi': false,
			'scriptData': {"SESSION_ID":"<?php echo $this->_tpl_vars['session_id']; ?>
"},
			'auto': true,
			'queueID': 'fileQueue',
			onProgress:function (evt, queueID, fileObj, response, data) {
				if($.browser.msie)
				{
					$("#imgfileUploader").css({"height":"0","line-height":"0","overflow":"hidden"});
				}
				else
				{
					$("#imgfileUploader").css("visibility","hidden");
				}
			   },
			onCancel:function (evt, queueID, fileObj, response, data) {
				if($.browser.msie)
				{
					$("#imgfileUploader").css({"height":"45","line-height":"45","overflow":"visible"});
				}
				else
				{
					$("#imgfileUploader").css("visibility","visible");
				}
			   },
			onComplete: function (evt, queueID, fileObj, response, data) {
				window.location = '?m=<?php echo ((is_array($_tmp='upload')) ? $this->_run_mod_handler('encrypt', true, $_tmp) : encrypt($_tmp)); ?>
&a=crop&fileurl='+response;
			   }
			});

	});

	</script>
<!---->
 <div class="avatar1">

    <div class="avatar1_c">
     <div class="avatar1_v">
    <input type="file" name="imgfile" id="imgfile">
    <!--<div id="fileUpload">
    <input name="avatar1_btn" id="avatar1_btn_xs" type="image"  class="avatar1_btn" src="/static/image/common/images/avatar1_btn.gif">
    </div>-->
     <div id="fileQueue"></div>
     </div>
    </div>

 </div>
 <?php endif; ?>
</body>
</html>

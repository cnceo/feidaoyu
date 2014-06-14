<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="js/jquery/swfupload/style.upload.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery/jquery.min.js"></script>

</head>
<body>

<span class="y"><a onclick="self.parent.tb_remove();" class="flbc" href="javascript:;">关闭</a></span>
<!--{if ($_GET[setp] == 'upfile' && $_GET[cls] == 'picture')}--> 

<script type="text/javascript" src="js/jquery/swfupload/jquery.uploadify.min.js"></script>
 <script type="text/javascript" src="js/jquery/swfupload/swfobject.js"></script>

    <script type="text/javascript">
	$(document).ready(function() {
		
		$("#imgfile").uploadify({
			'uploader': 'js/jquery/swfupload/uploadify.swf',
			'cancelImg': 'images/cancel.png',
			'script': '/plugins/upload.php',
			'buttonImg': 'images/avatar3_btn.gif',
			'width':'298',
			'height':'57',
			'folder': '{$path}',
			'fileDesc': 'Image Files',
			'fileExt': '*.jpg;*.jpeg;*.gif;*.png',
			'multi': false,
			'auto': true,
			'queueID': 'fileQueue',
			onProgress:function (evt, queueID, fileObj, response, data) {
				//alert(response);
				//$("#imgfileUploader").css("visibility","hidden");
				//$("#imgfileUploader").css("overflow","hidden");
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
				//alert(response);
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
				window.location = 'my.php?mod=upload&cls=picture&setp=crop&fileurl='+response;
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
 
<!--{elseif ($_GET[setp] == 'crop' && $_GET[cls] == 'picture')}--> 
    <script type="text/javascript" src="{$_G[setting][jspath]}script.js"></script>
     
    <link href="{$_G[setting][jspath]}jquery-ui-1.7.2.custom.css" rel="Stylesheet" type="text/css" /> 
    
    <script type="text/javascript" src="{$_G[setting][jspath]}jquery-ui-1.7.2.custom.min.js"></script>
    <script type="text/javascript" src="{$_G[setting][jspath]}jquery.cropzoom.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
       var cropzoom = $('#crop_container').cropzoom({
            width:300,
            height:226,
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
                source:'/data/attachment/forum/{$_GET[fileurl]}',
                width:{$width},
                height:{$height},
                minZoom:10,
                maxZoom:150
            }
        });
        $('#cropbtn').click(function(){
            cropzoom.send('/plugins/upload.php','POST',{},function(rta){
            	//alert(rta);
            	window.location='my.php?mod=upload&cls=picture&setp=view&fileurl={$_GET[fileurl]}';
            });
        });
        $('#backbtn').click(function(){
            window.location='my.php?mod=upload&cls=picture&setp=upfile';
        })
    })

</script>
<!--<div id="crop_container"></div>-->
 <div class="avatar">
     <dl>
       <dt id="crop_container"></dt>
       <dd>
           <input name="backbtn"  id="backbtn"  type="image"  class="c1" src="/static/image/common/images/avatar1.gif">
           <input name="cropbtn"  id="cropbtn" type="image"  class="c2" src="/static/image/common/images/avatar2.gif">
       </dd>
     
     </dl>
 
 
 </div>
<!--{elseif $_GET[setp] == 'view'}-->
<script type="text/javascript">
    $(document).ready(function(){
        $('#closebtn').click(function(){
				parent.document.getElementById('imgshow').innerHTML = "<img src='/data/attachment/forum/{$filepath}/small_{$filename}'>";
				parent.document.getElementById('picpath').value = "{$filepath}";
				parent.document.getElementById('picname').value = "{$filename}";
				parent.document.getElementById('picflag').value = "1";
				self.parent.tb_remove();
        })
    })

</script>
<!---->
 <div class="avatar2">
   <div class="avatar2_250"><img src="/data/attachment/forum/{$filepath}/big_{$filename}"></div>
   <div class="avatar2_140"><img src="/data/attachment/forum/{$filepath}/mid_{$filename}"></div>
   <div class="avatar2_89"><img src="/data/attachment/forum/{$filepath}/small_{$filename}"></div>
   
   <div class="avatar2_btn">
      <h3>上传成功</h3>
      <p>以上是您头像三种尺寸</p>
   <input name="closebtn" id="closebtn" type="image"  class="avatar1_btn" src="/static/image/common/images/avatar2_btn.gif" >
   </div>
 </div>



<!---->
<!--{elseif ($_GET[setp] == 'upfile' && $_GET[cls] == 'rarzip')}-->
 <script type="text/javascript" src="{$_G[setting][jspath]}jquery.uploadify.min.js"></script>
 <script type="text/javascript" src="{$_G[setting][jspath]}swfobject.js"></script>
    <script type="text/javascript">
	$(document).ready(function() {
		var arr = new Array();
		$("#zipfile").uploadify({
			'uploader': '/{$_G[setting][jspath]}uploadify.swf',
			'cancelImg': '/static/image/common/images/cancel.png',
			'script': '/plugins/upload.php',
			'buttonImg': '/static/image/common/images/upload1.gif',
			'width':'60',
			'height':'32',
			'folder': '{$path}',
			'fileDesc': 'Zip Files',
			'fileExt': '*.rar;*.zip',
			'multi': false,
			'queueID': 'fileQueue',
			onComplete: function (evt, queueID, fileObj, response, data) {
				arr.push(response);	
			   },
			onAllComplete: function (evt, queueID, fileObj, response, data) {
				 $.each(arr, function(){
					    $.ajax({
									type: "POST",
									url:  "my.php?mod=upload",
									data: "fileurl="+this+"&action=saveatt"
								});    
							 });   
				setTimeout(function(){window.location = 'my.php?mod=upload&cls=rarzip&setp=purview';},1000);
				//window.location = 'my.php?mod=upload&cls=rarzip&setp=purview';
			   }
			});
		$("#upbtn").click(function(){
			$('#zipfile').uploadifyUpload();
		});

	});
	
	</script>
<!---->



   <div class="upload">
    <ul class="title2">
        <li class="a1">压缩包</li>
    </ul>  
    <div class="upload_a">
          
      <input type="file" name="zipfile" id="zipfile">
      <input name="upbtn" id="upbtn" type="image"   src="/static/image/common/images/upload2.gif">
    </div> 
    <div class="mc">
      <span class="left22">文件名（大小）</span>
      <span class="right22"> 删除</span>
      <span class="right22">上传进度</span>
    </div>
    <div class="c1" id="fileQueue"></div>
    
    <p class="txt">
        
        文件尺寸：<b>大小不限制</b>    格式要求：<b>RAR  ZIP</b>
    
    </p>
 
 </div>
<!---->

<!--{elseif ($_GET[setp] == 'purview' && $_GET[cls] == 'rarzip')}-->
<!---->

<style>

</style>
<script>
function insertAttachTag(id,fname,fdate,fsize)
{
	$.ajax({
			type: "POST",
			url:  "my.php?mod=upload",
			data: "id="+id+"&action=upatt"+"&price="+$('#price'+id).val()+"&readperm="+$('#readperm'+id).val()
		}); 	
	parent.document.getElementById('fileshow').innerHTML = "<img src='static/image/filetype/rar.gif' border='0'><a href='#' title='"+fname+" 上传日期: "+fdate+" 文件大小: "+fsize+"'>"+fname+"</a>";
	parent.document.getElementById('fileid').value = id;
	parent.document.getElementById('filedesc').value = $('#description'+id).val();
	parent.document.getElementById('fileflag').value = '1';
	self.parent.tb_remove();
}
</script>
<style>
.upload ul.title2 li{ float:left !important; border:#DCDCDE solid 1px; border-bottom:0; background: url(./images/sew-8.gif) repeat-x top; margin-right:5px; padding:0 8px;height:24px !important}
.upload ul.title2 li a{ text-decoration:none; color:#666}
.upload ul.title2 li.a1{ position:static; z-index:auto !important;  border:#DCDCDE solid 1px; border-bottom:0;height:25px !important; width:auto !important}
</style>

   <div class="upload">
    <ul class="title2">
        <li class="a1">压缩包</li>
    </ul>  
   <div class="mc" style=" width:445px">
      <span class="left22">文件名</span>
      
      <span class="right22">权限</span>
      <span class="right22">金钱</span>
      <span class="right22"> 描述</span>
    </div>
     <div class="mclist">
     <form name="myform" method="POST" >
     <table>
      <!--{loop $atts $att}-->
      <tr><td>
      <span class="left22">
      <img src="static/image/filetype/rar.gif" class="vm" alt="" border="0">
      <a href="javascript:;" class="lighttxt" id="attachname{$att[aid]}" onclick="insertAttachTag('{$att[aid]}','{$att[filename]}','{$att[filedate]}','{$att[filesize]}')" title="{$att[filename]} 
上传日期: {$att[filedate]} 
文件大小: {$att[filesize]}">{$att[filename]}</a></span>
     
     
      <span class="right22"><input class="a1" id="price{$att[aid]}" name="attachnew[{$att[aid]}][price]" value="0" size="1" type="text"></span>
      
       <span class="right22"><input class="a1" id="readperm{$att[aid]}"  name="attachnew[{$att[aid]}][readperm]" value="0" size="1" type="text"></span>
       <span class="right22"><input id="description{$att[aid]}" name="attachnew[{$att[aid]}][description]" value="" size="10" type="text"></span>
       </td></tr>
        <!--{/loop}-->   
    </table>
    </form>
    </div>
    <div style="clear:both"></div>
    <p class="txt">
        点击文件名添加到帖子内容中</b>
    
    </p>
 
 </div>
 <!---->
<!--{elseif ($_GET[setp] == 'upfile' && $_GET[cls] == 'multipic')}-->
 <script type="text/javascript" src="{$_G[setting][jspath]}jquery.uploadify.min.js"></script>
 <script type="text/javascript" src="{$_G[setting][jspath]}swfobject.js"></script>
    <script type="text/javascript">
	$(document).ready(function() {
		var arr = new Array();
		$("#mimgfile").uploadify({
			'uploader': '/{$_G[setting][jspath]}uploadify.swf',
			'cancelImg': '/static/image/common/images/cancel.png',
			'script': '/plugins/upload.php',
			'buttonImg': '/static/image/common/images/upload1.gif',
			'width':'60',
			'height':'32',
			'folder': '{$path}',
			'fileDesc': 'Image Files',
			'fileExt': '*.jpg;*.jpeg;*.gif;*.png',
			'multi': true,
			'queueID': 'fileQueue',
			onComplete: function (evt, queueID, fileObj, response, data) {
				arr.push(response);	
			   },
			onAllComplete: function (evt, queueID, fileObj, response, data) {
				 $.each(arr, function(){
					    $.ajax({
									type: "POST",
									url:  "my.php?mod=upload",
									data: "fileurl="+this+"&action=saveatt&isimage=1&thumb=1"
								});    
							 });   
				setTimeout(function(){window.location = 'my.php?mod=upload&cls=multipic&setp=purview';},1000);
				//window.location = 'my.php?mod=upload&cls=rarzip&setp=purview';
			   }
			});
		$("#upbtn").click(function(){
			$('#mimgfile').uploadifyUpload();
		});

	});
	
	</script>
<!---->
   <div class="upload">
    <ul class="title2">
        <li class="a1">图片批量上传</li>
    </ul>  
    <div class="upload_a">
          
      <input type="file" name="mimgfile" id="mimgfile">
      <input name="upbtn" id="upbtn" type="image"   src="/static/image/common/images/upload2.gif">
    </div> 
    <div class="mc">
      <span class="left22">文件名（大小）</span>
      <span class="right22"> 删除</span>
      <span class="right22">上传进度</span>
    </div>

    <div class="c1" id="fileQueue" ></div>
    
    <p class="txt">
        
        文件尺寸：<b>大小不限制</b>    格式要求：<b>GIF  JPG PNG</b>
    
    </p>
 
 </div>
<!---->

<!--{elseif ($_GET[setp] == 'purview' && $_GET[cls] == 'multipic')}-->
<!---->

<style>

</style>
<script>

function delAttach(id)
{
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "my.php?mod=upload",
				data: "id="+id+"&action=delatt",
				success: function(){ 
				 location.reload();
				} 
			}); 
		} 
}
</script>
   <div class="upload">
    <ul class="title2">
        <li class="a1">图片列表</li>
    </ul>  
 
     <div class="mclist">  
     <form name="myform" method="POST">
      <!--{loop $atts $att}-->
     

     
     <div class="img_a"><a href="my.php?mod=upload&cls=multipic&setp=crop&fileurl={$att[attachment]}" class="lighttxt" id="attachname{$att[aid]}" title="{$att[filename]} 
上传日期: {$att[filedate]} 
文件大小: {$att[filesize]}文件大小: {$att[filesize]}"><img src="/data/attachment/forum/{$att[attachment]}.thumb.jpg " class="img" width="100"></a></span>
<span>
<input name="" type="text" /><a href="#" onclick="delAttach('{$att[aid]}')"><img src="/static/image/common/images/10.gif"  /></a>
</span>
</div>



       <!--{/loop}-->   
    </form>
    </div>
    <div style="clear:both"></div>
    <p class="txt">
        点击文件名添加到帖子内容中</b>
    
    </p>
 
 </div>
 <!---->
 <!--{elseif ($_GET[setp] == 'crop' && $_GET[cls] == 'multipic')}--> 
    <script type="text/javascript" src="{$_G[setting][jspath]}script.js"></script>
     
    <link href="{$_G[setting][jspath]}jquery-ui-1.7.2.custom.css" rel="Stylesheet" type="text/css" /> 
    
    <script type="text/javascript" src="{$_G[setting][jspath]}jquery-ui-1.7.2.custom.min.js"></script>
    <script type="text/javascript" src="{$_G[setting][jspath]}jquery.cropzoom.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
       var cropzoom = $('#crop_container').cropzoom({
            width:300,
            height:226,
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
                source:'/data/attachment/forum/{$_GET[fileurl]}',
                width:{$width},
                height:{$height},
                minZoom:10,
                maxZoom:150
            }
        });
        $('#cropbtn').click(function(){
            cropzoom.send('/plugins/upload.php','POST',{},function(rta){
            	//alert(rta);
            	window.location='my.php?mod=upload&cls=picture&setp=view&fileurl={$_GET[fileurl]}';
            });
        });
        $('#backbtn').click(function(){
            window.location='my.php?mod=upload&setp=purview&cls=multipic';
        })
    })

</script>
<!--<div id="crop_container"></div>-->
 <div class="avatar">
     <dl>
       <dt id="crop_container"></dt>
       <dd>
           <input name="backbtn"  id="backbtn"  type="image"  class="c1" src="/static/image/common/images/avatar1.gif">
           <input name="cropbtn"  id="cropbtn" type="image"  class="c2" src="/static/image/common/images/avatar2.gif">
       </dd>
     
     </dl>
 
 
 </div>
<!--{/if}-->
</body>
</html>


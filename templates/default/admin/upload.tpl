<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="js/jquery/swfupload/style.upload.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery/jquery.min.js"></script>

</head>
<body>

<span class="y"><a onclick="self.parent.tb_remove();" class="flbc" href="javascript:;">关闭</a></span>
{{if $smarty.get.a=="crop"}}

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
                source:'{{$smarty.const.IMG_HOST}}{{$smarty.get.fileurl}}',
                width:{{$file.width}},
                height:{{$file.height}},
                minZoom:10,
                maxZoom:150
            }
        });
        $('#cropbtn').click(function(){
            cropzoom.send('?m={{'upload'|encrypt}}','POST',{},function(rta){
            	window.location='?m={{'upload'|encrypt}}&a=view&fileurl={{$smarty.get.fileurl}}';
            });
        });
        $('#thumbbtn').click(function(){
            cropzoom.send('?m={{'upload'|encrypt}}','POST',{thumb:1},function(rta){
            	//alert(rta);
            	window.location='?m={{'upload'|encrypt}}&a=view&fileurl={{$smarty.get.fileurl}}';
            });
        });
        $('#backbtn').click(function(){
            window.location='?m={{'upload'|encrypt}}';
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
 {{elseif $smarty.get.a=="multiimg"}}
 <script type="text/javascript" src="js/jquery/swfupload/jquery.uploadify.min.js"></script>
 <script type="text/javascript" src="js/jquery/swfupload/swfobject.js"></script>
    <script type="text/javascript">
	$(document).ready(function() {
		var arr = new Array();
		$("#mimgfile").uploadify({
			'uploader': 'js/jquery/swfupload/uploadify.swf',
			'cancelImg': 'js/jquery/swfupload/cancel.png',
			'script': '?m={{'upload'|encrypt}}',
			'buttonImg': 'js/jquery/swfupload/upload1.gif',
			'width':'60',
			'height':'32',
			'folder': '{{$path}}',
			'fileDesc': 'Image Files',
			'fileExt': '*.jpg;*.jpeg;*.gif;*.png;*.flv;*.txt;*.doc;*.docx;*.pdf;*.xls;*.xlsx;*.ppt;*.pptx',
			'multi': true,
			'scriptData': {"SESSION_ID":"{{$session_id}}","pid":"{{$smarty.get.pid}}","utype":"{{$smarty.get.utype}}"},
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
        <li class="a1"><a href="?m={{'upload'|encrypt}}&a=multiimg&utype={{$smarty.get.utype}}&pid={{$smarty.get.pid}}{{if $smarty.get.t}}&t=tinymce&input={{$smarty.get.input}}{{/if}}">批量上传</a></li>
        <li class="a2"><a href="?m={{'upload'|encrypt}}&a=purview&utype={{$smarty.get.utype}}&pid={{$smarty.get.pid}}{{if $smarty.get.t}}&t=tinymce&input={{$smarty.get.input}}{{/if}}">图片列表</a></li>
		<li class="a2"><a href="?m={{'upload'|encrypt}}&a=video&utype={{$smarty.get.utype}}&pid={{$smarty.get.pid}}{{if $smarty.get.t}}&t=tinymce&input={{$smarty.get.input}}{{/if}}">其他列表</a></li>
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

{{elseif $smarty.get.a=="video"}}
<script type="text/javascript">
function delAttach(id)
{
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'upload'|encrypt}}&a=delatt",
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
			{{if $smarty.get.t}}
			html = "<a href='http://{{$SERVER_NAME}}/uploads"+file+"' target='_blank'>点击下载</a>";
			parent.tinyMCE.execCommand('mceInsertContent','{{$smarty.get.input}}',html);
			{{else}}
			html = parent.document.getElementById('piclist').innerHTML;
			html =  html + "<div class=\"img_mc\"><img onclick=\"dotb('上传', '?m={{'upload'|encrypt}}&a=crop&fileurl="+file+"&keepThis=true&TB_iframe=false&height=422&width=800');return false;\" class=\"image\" id=\"preview\" alt=\"\" src=\"{{$smarty.const.IMG_HOST}}"+file+"\" height=\"100\" title=\"点击替换主题图片\"/><input name=\"aid[]\" type=\"hidden\" value=\""+id+"\"/><p><a href=\"#\" onclick=\"$(this).parent().parent().remove();\">删除</a></p></div>";
			parent.document.getElementById('piclist').innerHTML = html;
			{{/if}}
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
        <li class="a2"><a href="?m={{'upload'|encrypt}}&a=multiimg&utype={{$smarty.get.utype}}&pid={{$smarty.get.pid}}{{if $smarty.get.t}}&t=tinymce&input={{$smarty.get.input}}{{/if}}">批量上传</a></li>
        <li class="a2"><a href="?m={{'upload'|encrypt}}&a=purview&utype={{$smarty.get.utype}}&pid={{$smarty.get.pid}}{{if $smarty.get.t}}&t=tinymce&input={{$smarty.get.input}}{{/if}}">图片列表</a></li>
        <li class="a1"><a href="?m={{'upload'|encrypt}}&a=video&utype={{$smarty.get.utype}}&pid={{$smarty.get.pid}}{{if $smarty.get.t}}&t=tinymce&input={{$smarty.get.input}}{{/if}}">其他列表</a></li>
	</ul>

     <div class="mclist">
     <form name="myform" method="POST">
       {{section name=data loop=$logs}}
     <div class="img_a">
		<span><p>文件编号：{{$logs[data].id}}</p>
		<a href="#" onclick="setAttach('{{$logs[data].id}}','{{$logs[data].attachment}}')" title="选用">选用<img src="js/jquery/swfupload/11.gif"  /></a><a href="#" onclick="delAttach('{{$logs[data].id}}')" title="删除"><img src="js/jquery/swfupload/10.gif"  />删除</a>
		</span>
		</div>
{{/section}}


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
        {{include file=admin/pages.tpl}} </b>

    </p>

 </div>
 {{elseif $smarty.get.a=="purview"}}
<script type="text/javascript">
function delAttach(id)
{
	 if(confirm("确认删除吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'upload'|encrypt}}&a=delatt",
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
			{{if $smarty.get.t}}
			html = '<a target="_blank" href="{{$smarty.const.IMG_HOST}}'+file+'"> <img border="0" src="{{$smarty.const.IMG_HOST}}'+file+'.thumb.jpg"></a>';
			parent.tinyMCE.execCommand('mceInsertContent','{{$smarty.get.input}}',html);
			{{else}}
			html = parent.document.getElementById('piclist').innerHTML;
			html =  html + "<div class=\"img_mc\"><img onclick=\"dotb('上传', '?m={{'upload'|encrypt}}&a=crop&fileurl="+file+"&keepThis=true&TB_iframe=false&height=422&width=800');return false;\" class=\"image\" id=\"preview\" alt=\"\" src=\"{{$smarty.const.IMG_HOST}}"+file+"\" height=\"100\" title=\"点击替换主题图片\"/><input name=\"aid[]\" type=\"hidden\" value=\""+id+"\"/><p><a href=\"#\" onclick=\"$(this).parent().parent().remove();\">删除</a></p></div>";
			parent.document.getElementById('piclist').innerHTML = html;
			{{/if}}
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
        <li class="a2"><a href="?m={{'upload'|encrypt}}&a=multiimg&utype={{$smarty.get.utype}}&pid={{$smarty.get.pid}}{{if $smarty.get.t}}&t=tinymce&input={{$smarty.get.input}}{{/if}}">批量上传</a></li>
        <li class="a1"><a href="?m={{'upload'|encrypt}}&a=purview&utype={{$smarty.get.utype}}&pid={{$smarty.get.pid}}{{if $smarty.get.t}}&t=tinymce&input={{$smarty.get.input}}{{/if}}">图片列表</a></li>
		<li class="a2"><a href="?m={{'upload'|encrypt}}&a=video&utype={{$smarty.get.utype}}&pid={{$smarty.get.pid}}{{if $smarty.get.t}}&t=tinymce&input={{$smarty.get.input}}{{/if}}">其他列表</a></li>
	</ul>

     <div class="mclist">
     <form name="myform" method="POST">
       {{section name=data loop=$logs}}
     <div class="img_a"><a href="?m={{'upload'|encrypt}}&a=crop&fileurl={{$logs[data].attachment}}" class="lighttxt" id="attachname{{$logs[data].id}}" title="{{$logs[data].filename}}
		上传日期: {{$logs[data].filedate}}
		文件大小: {{$logs[data].filesize}}文件大小: {{$att[filesize]}}"><img src="{{$smarty.const.IMG_HOST}}{{$logs[data].attachment}}.thumb.jpg " class="img" width="100"></a></span>
		<span>
		<a href="#" onclick="setAttach('{{$logs[data].id}}','{{$logs[data].attachment}}')" title="选用">选用<img src="js/jquery/swfupload/11.gif"  /></a><a href="#" onclick="delAttach('{{$logs[data].id}}')" title="删除"><img src="js/jquery/swfupload/10.gif"  />删除</a>
		</span>
		</div>
		{{/section}}


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
        {{include file=admin/pages.tpl}} </b>

    </p>

 </div>
{{elseif $smarty.get.a=="view"}}
 <script type="text/javascript">
    $(document).ready(function(){
        $('#closebtn').click(function(){
				parent.document.getElementById('preview').src = "{{$smarty.const.IMG_HOST}}{{$file.url}}.100x100.jpg";
				parent.document.getElementById('picpath').value = "{{$file.url}}";
				self.parent.tb_remove();
        })
    })

</script>
<!---->
 <div class="avatar2">
   <div class="avatar2_250"><img src="{{$smarty.const.IMG_HOST}}{{$file.url}}.280x280.jpg"></div>
   <div class="avatar2_140"><img src="{{$smarty.const.IMG_HOST}}{{$file.url}}.140x140.jpg"></div>
   <div class="avatar2_89"><img src="{{$smarty.const.IMG_HOST}}{{$file.url}}.100x100.jpg"></div>

   <div class="avatar2_btn">
      <h3>上传成功</h3>
      <p>以上是您图片三种尺寸</p>
   <input name="closebtn" id="closebtn" type="image"  class="avatar1_btn" src="js/jquery/swfupload/avatar2_btn.gif" >
   </div>
 </div>
{{else}}
<script type="text/javascript" src="js/jquery/swfupload/jquery.uploadify.min.js"></script>
 <script type="text/javascript" src="js/jquery/swfupload/swfobject.js"></script>

    <script type="text/javascript">
	$(document).ready(function() {

		$("#imgfile").uploadify({
			'uploader': 'js/jquery/swfupload/uploadify.swf',
			'cancelImg': 'images/cancel.png',
			'script': '?m={{'upload'|encrypt}}',
			'buttonImg': 'images/avatar3_btn.gif',
			'width':'298',
			'height':'57',
			'folder': '{{$path}}',
			'fileDesc': 'Image Files',
			'fileExt': '*.jpg;*.jpeg;*.gif;*.png;*.flv;*.txt;*.doc;*.docx;*.pdf;*.xls;*.xlsx;*.ppt;*.pptx',
			'multi': false,
			'scriptData': {"SESSION_ID":"{{$session_id}}"},
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
				window.location = '?m={{'upload'|encrypt}}&a=crop&fileurl='+response;
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
 {{/if}}
</body>
</html>


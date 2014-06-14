{{include file=admin/header.tpl}}
<script type="text/javascript"  src="/js/jquery.form.js" ></script>
<script type="text/javascript"  src="/images/admin/js/report.js" ></script>
<script type="text/javascript"  src="/js/thickbox.js"></script>
<link href="/js/thickbox.css" rel="stylesheet" type="text/css" />
<div id="anchor-content" class="middle">
	<div class="content-header" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><h3>内容管理</h3><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="ResetData('myForm');" class="scalable" type="button"><span>重置</span></button><button style="" onclick="SaveEdit();" class="scalable save" type="button" ><span>保存</span></button><button style="" onclick="CancelBack();" class="scalable back" type="button" ><span>返回</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
	<div class="edit-head">
    <h4 class="icon-head head-edit-form fieldset-legend">{{if $log.id==""}}添加{{else}}修改{{/if}}报告</h4>
	</div>
	<div class="dashboard-container">
	<table class="form-list">
	<form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
		<tr>
         <td class="label"><label>报告编号</label></td>
          <td><input type="text" name="reportno" id="reportno" value="{{$log.reportno}}"  size="80"/>
	  </td>
	  </tr>
	  	 <tr>
          <td class="label"><label>密码</label></td>
          <td><input type="text" name="password" id="password" value="{{$log.password}}"  size="50" />
			<button style="" onclick="Generate();" class="scalable" type="button"><span>密码</span></button>
	  </td>
	 </tr>
		<tr>
          <td class="label"><label>报告文件</label></td>
          <td><input type="text" name="path" id="path" value="{{$log.path}}"  size="50"/>
          <button style="" onclick="dotb('文件管理', '{{$urlpre}}/admin/filemgrnew/filetype/pdf/fileinput/path/?keepThis=true&TB_iframe=true&height=500&width=800');return false;" class="scalable save" type="button" ><span>选择</span></button>
	  </td>
	  </tr>
    </form>
</table>
	</div>
	<div class="content-footer" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="ResetData('myForm');" class="scalable" type="button"><span>重置</span></button><button style="" onclick="SaveEdit();" class="scalable save" type="button" ><span>保存</span></button><button style="" onclick="CancelBack();" class="scalable back" type="button" ><span>返回</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
</div>
{{include file=admin/footer.tpl}}
{{include file=admin/header.tpl}}
<script type="text/javascript"  src="/js/jquery.form.js" ></script>
<script type="text/javascript"  src="/js/public.verify.js" ></script>
<script type="text/javascript"  src="/images/admin/js/templet.js" ></script>
<div id="anchor-content" class="middle">
	<div class="content-header" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><h3>模板管理</h3><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="ResetData('myForm');" class="scalable" type="button"><span>重置</span></button><button style="" onclick="SaveEdit();" class="scalable save" type="button" ><span>保存</span></button><button style="" onclick="CancelBack();" class="scalable back" type="button" ><span>返回</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
	<div class="edit-head">
    <h4 class="icon-head head-edit-form fieldset-legend">{{if $log.id==""}}添加{{else}}修改{{/if}}模板</h4>
	</div>
	<div class="dashboard-container">
	<table class="form-list">
	<form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="id" id="id" value="{{$log.id}}">
		<tr>
           <td class="label"><label>模板名称</label></td>
          <td><input type="text" name="title" id="title" value="{{$log.title}}"  size="80" {{if $log.flag=="1"}}disabled{{/if}}/>
	  </td>
	  </tr>
		<tr>
           <td class="label"><label>模板类型</label></td>
          <td >
	  {{if $log.flag=="1"}}
	  <select name="ttype"  disabled >{{html_options options=$typelist selected=$log.ttype|default:"4"}}</select>
	  <input type="hidden" name="ttype" id="ttype"  value="{{$log.ttype}}" />
	  {{else}}
	  <select name="ttype"  onchange="if(this.options[this.selectedIndex].value!='0'){Show('glabel');Show('glabe2');}else{Hide('glabel');Hide('glabe2');};if(this.options[this.selectedIndex].value!='0' && this.options[this.selectedIndex].value!='5'){Show('glabe2');}else{Hide('glabe2');};if(this.options[this.selectedIndex].value=='2' || this.options[this.selectedIndex].value=='5'){Show('glabe3');}else{Hide('glabe3');}">{{html_options options=$typelist selected=$log.ttype|default:"4"}}</select>
	  {{/if}}
	  </td>
	  </tr>
	<tr id="glabel">
	   <td class="label"><label>全局标签</label></td>
	  <td> {{section name=mydata loop=$logs}} [<a href="#" onclick="addTag('{{$logs[mydata].title}}')">{{$logs[mydata].title}}</a>]  {{/section}}</td>
	 </tr>
	<tr id="glabe2">
	   <td class="label"><label>广告标签</label></td>
	  <td> {{section name=mydata loop=$logs_ad}} [<a href="#" onclick="addAdTag('{{$logs_ad[mydata].unikey}}')">{{$logs_ad[mydata].title}}</a>]  {{/section}}</td>
	 </tr>
    <tr id="glabe3">
	   <td class="label"><label>文件名</label></td>
	  <td><input type="text" name="filename" id="filename"  value="{{$log.filename}}" {{if $log.ttype=="2"}} readonly{{/if}} {{if $log.ttype=="5"}} readonly{{/if}}/></td>
	 </tr>
	  <tr>
           <td class="label"><label>内容</label></td>
          <td><textarea name="content" id="content" cols="80" rows="20" style="width:99%; height:540px;">{{$log.content}}</textarea></td>
	  </tr>
	   <tr>
           <td class="label"><label>语言</label></td>
          <td>{{html_radios name="lang" options=$langs checked=$log.lang}}
	  </td>
	 </tr>
    </form>
</table><script>{{if $log.ttype=="2"}}Show('glabe3');{{else}}Hide('glabe3');{{/if}}</script>
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
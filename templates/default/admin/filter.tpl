{{include file=admin/header.tpl}}
<script type="text/javascript"  src="/js/jquery.form.js" ></script>
<script type="text/javascript"  src="/js/public.verify.js" ></script>
<script type="text/javascript"  src="/images/admin/js/filter.js" ></script>
<div id="anchor-content" class="middle">
	<div class="content-header" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><h3>设置</h3><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="ResetData('myForm');" class="scalable" type="button"><span>重置</span></button><button style="" onclick="SaveEdit();" class="scalable save" type="button" ><span>保存设置</span></button><button style="" onclick="CancelBack();" class="scalable back" type="button" ><span>返回</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
	<div class="edit-head">
    <h4>过滤</h4>
	</div>
	<div class="dashboard-container">
	<table class="form-list">
	<form id="myForm" name="myForm" action="" method="post">
    <tr>
          <td class="label"><label>词语</label></td>
          <td><textarea rows="2" name="filterword" id="filterword" cols="80" >{{$sites.filterword}}</textarea><span id="warning" >多个关键词用|分割</span></td>
        </tr>
         <tr>
          <td class="label"><label>替换为</label></td>
          <td><input type="text" name="filtersymbol" id="filtersymbol" size="80" value="{{$sites.filtersymbol|default:"***"}}" ></td>
        </tr>
    </form>
</table>
	</div>
	<div class="content-footer" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="ResetData('myForm');" class="scalable" type="button"><span>重置</span></button><button style="" onclick="SaveEdit();" class="scalable save" type="button" ><span>保存设置</span></button><button style="" onclick="CancelBack();" class="scalable back" type="button" ><span>返回</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
</div>
{{include file=admin/footer.tpl}}
{{include file=admin/header.tpl}}
<script type="text/javascript"  src="/js/jquery.form.js" ></script>
<script type="text/javascript"  src="/js/public.verify.js" ></script>
<script type="text/javascript"  src="/images/admin/js/seo.js" ></script>
<div id="anchor-content" class="middle">
	<div class="content-header" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><h3>设置</h3><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="ResetData('myForm');" class="scalable" type="button"><span>重置</span></button><button style="" onclick="SaveEdit();" class="scalable save" type="button" ><span>保存设置</span></button><button style="" onclick="CancelBack();" class="scalable back" type="button" ><span>返回</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
	<div class="edit-head">
    <h4>SEO</h4>
	</div>
	<div class="dashboard-container">
	<table class="form-list">
	<form id="myForm" name="myForm" action="" method="post">
	<tr>
          <td class="label"><label>Meta关键词</label></td>
          <td><input type="text" name="keywords" id="keywords" size="80" value="{{$sites.keywords}}" ><span id="warning" >少于100字符</span></td>
        </tr>
       <tr>
          <td class="label"><label>Meta Keywords</label></td>
          <td><input type="text" name="ekeywords" id="ekeywords" size="80" value="{{$sites.ekeywords}}" ><span id="warning" >少于100字符</span></td>
        </tr>
        <tr>
          <td class="label"><label>Meta 描述</label></td>
          <td><textarea rows="4" name="description" id="description" cols="80" >{{$sites.description}}</textarea><span id="warning" >少于100字符</span></td>
        </tr>
        <tr>
          <td class="label"><label>Meta Description</label></td>
          <td><textarea rows="4" name="edescription" id="edescription" cols="80" >{{$sites.edescription}}</textarea><span id="warning" >少于100字符</span></td>
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
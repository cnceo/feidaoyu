{{include file=admin/header.tpl}}
<script type="text/javascript"  src="/js/jquery.form.js" ></script>
<script type="text/javascript"  src="/js/public.verify.js" ></script>
<script type="text/javascript"  src="/images/admin/js/globals.js" ></script>
<div id="anchor-content" class="middle">
	<div class="content-header" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><h3>设置</h3><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="ResetData('myForm');" class="scalable" type="button"><span>重置</span></button><button style="" onclick="SaveEdit();" class="scalable save" type="button" ><span>保存设置</span></button><button style="" onclick="CancelBack();" class="scalable back" type="button" ><span>返回</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
	<div class="edit-head">
    <h4>全局</h4>
	</div>
	<div class="dashboard-container">
	<table class="form-list">
	<form id="myForm" name="myForm" action="" method="post">
		<tr>
          <td class="label"><label>网址重写</label></td>
          <td><select name="_URL_" id="_URL_"  >{{html_options options=$urls selected=$log.url}}</select>
	    </td>
        <tr>
          <td class="label"><label>数据库地址</label></td>
          <td><input type="text" name="_DB_HOST" id="_DB_HOST" size="50" value="{{$log.dbhost}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>数据库账户</label></td>
          <td><input type="text" name="_DB_USER" id="_DB_USER" size="50" value="{{$log.dbuser}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>数据库密码</label></td>
          <td><input type="text" name="_DB_PASS" id="_DB_PASS" size="50" value="{{$log.dbpass}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>数据库名称</label></td>
          <td><input type="text" name="_DB_NAME" id="_DB_NAME" size="50" value="{{$log.dbname}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>数据库类型</label></td>
          <td><input type="text" name="_DB_TYPE" id="_DB_TYPE" size="50" value="{{$log.dbtype}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>数据库字符集</label></td>
          <td><input type="text" name="_DB_CHAR" id="_DB_CHAR" size="50" value="{{$log.dbchar}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>DeBug</label></td>
          <td><input type="text" name="_DB_DEBUG" id="_DB_DEBUG" size="50" value="{{$log.dbdebug}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>每页显示数</label></td>
          <td><input type="text" name="_PAGES" id="_PAGES" size="50" value="{{$log.pages}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>默认语言</label></td>
          <td><input type="text" name="_LANG" id="_LANG" size="50" value="{{$log.lang}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>CSS文件目录</label></td>
          <td><input type="text" name="_CSS_PATH" id="_CSS_PATH" size="80" value="{{$log.css}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>上传文件目录</label></td>
          <td><input type="text" name="_FILE_PATH" id="_FILE_PATH" size="80" value="{{$log.file}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>缓存文件目录</label></td>
          <td><input type="text" name="_CAC_PATH" id="_CAC_PATH" size="80" value="{{$log.cache}}"/></td>
        </tr>
        <tr>
          <td class="label"><label>缓存文件目录</label></td>
          <td><input type="text" name="_TPL_PATH" id="_TPL_PATH" size="80" value="{{$log.tpl}}"/></td>
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
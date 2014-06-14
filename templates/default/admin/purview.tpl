{{include file=admin/header.tpl}}
<script type="text/javascript"  src="/js/jquery.form.js" ></script>
<script type="text/javascript"  src="/js/public.verify.js" ></script>
<script type="text/javascript"  src="/images/admin/js/purview.js" ></script>
<div id="anchor-content" class="middle">
	<div class="content-header" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><h3>权限设置</h3><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="ResetData('myForm');" class="scalable" type="button"><span>重置</span></button><button style="" onclick="SaveEdit();" class="scalable save" type="button" ><span>保存</span></button><button style="" onclick="CancelBack();" class="scalable back" type="button" ><span>返回</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
	<div class="edit-head">
    <h4 class="icon-head head-edit-form fieldset-legend">『{{$groupname|default:"自定义"}}』权限</h4>
	</div>
	<div class="dashboard-container">
	<table class="form-list">
	<form id="myForm" name="myForm" action="" method="post">
	<input type="hidden" name="uid" id="uid" value="{{$pw.uid}}">
	<input type="hidden" name="utype" id="utype" value="{{$pw.utype}}">
	<tr>
          <td class="label"><label>分类管理</label></td>
          <td>{{html_checkboxes name="SITE_CATE" options=$pw.checkboxes checked=$pw.SITE_CATE }}</td>
        </tr>
	<tr>
         <td class="label"><label>模板管理</label></td>
          <td>{{html_checkboxes name="SYS_TMPT" options=$pw.checkboxes checked=$pw.SYS_TMPT }}</td>
        </tr>
    <tr>
         <td class="label"><label>报告管理</label></td>
          <td>{{html_checkboxes name="SYS_REP" options=$pw.checkboxes checked=$pw.SYS_REP }}</td>
        </tr>
	<tr>
          <td class="label"><label>内容管理</label></td>
          <td>{{html_checkboxes name="SITE_CONT" options=$pw.checkboxes checked=$pw.SITE_CONT }}</td>
         </tr>
     <tr>
          <td class="label"><label>广告管理</label></td>
          <td>{{html_checkboxes name="SITE_AD" options=$pw.checkboxes checked=$pw.SITE_AD }}</td>
        </tr>
	<tr>
          <td class="label"><label>SEO设置</label></td>
          <td>{{html_radios name="SITE_SEO" options=$pw.radios checked=$pw.SITE_SEO }}</td>
        </tr>
	<tr>
          <td class="label"><label>订单管理</label></td>
          <td>{{html_checkboxes name="ORDERS" options=$pw.checkboxes checked=$pw.ORDERS }}</td>
        </tr>
	<tr>
          <td class="label"><label>客户管理</label></td>
          <td>{{html_checkboxes name="CLIENTS" options=$pw.checkboxes checked=$pw.CLIENTS }}</td>
        </tr>
	<tr>
          <td class="label"><label>员工管理</label></td>
          <td>{{html_checkboxes name="EMPLOYEE" options=$pw.checkboxes checked=$pw.EMPLOYEE }}</td>
        </tr>
        <tr>
          <td class="label"><label>部门管理</label></td>
          <td>{{html_radios name="EYE_DEPT" options=$pw.radios checked=$pw.EYE_DEPT }}</td>
        </tr>
      <tr>
          <td class="label"><label>用户组管理</label></td>
          <td>{{html_radios name="EYE_GROUP" options=$pw.radios checked=$pw.EYE_GROUP }}</td>
        </tr>
        <tr>
          <td class="label"><label>权限设置</label></td>
          <td>{{html_radios name="EYE_PURV" options=$pw.radios checked=$pw.EYE_PURV }}</td>
        </tr>
	<!--<tr>
          <td class="label"><label>邮件群发</label></td>
          <td>{{html_radios name="MOBILE_MSG" options=$pw.radios checked=$pw.MOBILE_MSG }}</td>
        </tr>
	<tr>
          <td class="label"><label>短信群发</label></td>
          <td>{{html_radios name="EMAIL" options=$pw.radios checked=$pw.EMAIL }}</td>
        </tr>-->
		<tr>
          <td class="label"><label>系统设置</label></td>
          <td>{{html_radios name="SYS_BASIC" options=$pw.radios checked=$pw.SYS_BASIC }}</td>
        </tr>
	<tr>
          <td class="label"><label>系统日志管理</label></td>
          <td>{{html_radios name="SYS_LOGS" options=$pw.radios checked=$pw.SYS_LOGS }}</td>
        </tr>
	<tr>
          <td class="label"><label>数据库备份</label></td>
          <td>{{html_radios name="DB_BACKUP" options=$pw.radios checked=$pw.DB_BACKUP }} </td>
        </tr>
	<tr>
          <td class="label"><label>数据库还原</label></td>
          <td>{{html_radios name="DB_REVERT" options=$pw.radios checked=$pw.DB_REVERT }}</td>
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
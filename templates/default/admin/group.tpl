{{include file=admin/header.tpl}}
<script type="text/javascript"  src="/images/admin/js/group.js" ></script>
<div id="anchor-content" class="middle">
	<div class="content-header" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><h3>用户组设定</h3><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="Add();" class="scalable save" type="button" ><span>新加</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
	<div id="notificationGrid">
<div class="grid">
	<div class="hor-scroll">
	<div id="hiddarea" class="fixfloat"></div>
	<table cellspacing="0" id="notificationGrid_table" class="data">
	    	    <col/>
	    	    <col width="200"/>
	    	    	        <thead>
	            	                <tr class="headings">
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="title" href="#"><span class="sort-title">名称</span></a></span></th>
	                	                    <th class="no-link last"><span class="nobr">操作</span></th>
	                	                </tr>
	            	            	        </thead>
	    	    	    <tbody>
	    	    {{section name=data loop=$logs}}
	    	    	<tr class="{{cycle values='even,'}} " title="">
	        	            <td>{{$logs[data].catename}}</td>
	        	            <td class="last">
	        	            <a href="#" onclick="Add('{{$logs[data].id}}','{{$logs[data].catename}}');"  alt="Save"> 修改 </a>
	        	            | <a href="#" onclick="Setup('{{$logs[data].id}}','group');"  alt="Cancel"> 权限 </a>
							| <a href="#" onclick="Del('{{$logs[data].id}}');"  alt="Cancel"> 删除 </a>
							| <a href="#" onclick="Add();"  alt="Cancel"> 新加 </a></td>
	        	        </tr>
	    	       {{sectionelse}}
         <tr>
          <td colspan="6"> <span id="warning" >暂无记录</span></td>
        </tr>
        {{/section}}   
	    	    	    </tbody>
	</table>
	</div>
</div>
</div>
</div>
{{include file=admin/footer.tpl}}
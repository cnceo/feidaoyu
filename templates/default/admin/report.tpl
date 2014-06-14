{{include file=admin/header.tpl}}
<script type="text/javascript"  src="/images/admin/js/report.js" ></script>
<div id="anchor-content" class="middle">
	<div class="content-header" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><h3>报告管理</h3><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="Add('{{$sites.ttype}}');" class="scalable save" type="button" ><span>添加新报告</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
	<div id="notificationGrid">
{{include file=admin/pages.tpl}} 
<div class="grid">
	<div class="hor-scroll">
	<table cellspacing="0" id="notificationGrid_table" class="data">
	    	    <col width="20" class="a-center"/>
	    	    <col/>
	    	    <col width="150"/>
	    	    <col/>
	    	    <col width="250"/>
	    	    	        <thead>
	            	                <tr class="headings">
	                	                    <th><span class="nobr">序号</span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="severity" href="#"><span class="sort-title">报告编号</span></a></span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="date_added" href="#"><span class="sort-title">添加日期</span></a></span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="title" href="#"><span class="sort-title">添加人</span></a></span></th>
	                	                    <th class="no-link last"><span class="nobr">操作</span></th>
	                	                </tr>
	            	            	        </thead>
	    	    	    <tbody>
	    	    {{section name=data loop=$logs}}
	    	    	<tr class="{{cycle values='even,'}} " title="">
	        	            <td class="a-center">{{$pages.current*$pages.pagenum-$pages.pagenum+$smarty.section.data.index+1}}</td>
	        	            <td class=""><span class="grid-severity-minor">{{$logs[data].reportno}}</span></td>
	        	            <td class="">{{$logs[data].addtime}}</td>
	        	            <td class=""><span class="grid-row-title">{{$logs[data].username}}</td>
	        	            <td class="last"><a href="#" onclick="Add('{{$logs[data].id}}');">修改</a> |
	        	            <a href="#" onclick="Download('{{$logs[data].path}}');"  alt="Cancel">下载</a> |
	        	            <a href="#" onclick="Del('{{$logs[data].id}}');"  alt="Cancel">删除</a> |
	        	            <a href="#" onclick="Add();">添加新报告</a></td>
	        	        </tr>
	    	       {{sectionelse}}
         <tr>
          <td colspan="5"> <span id="warning" >暂无记录</span></td>
        </tr>
        {{/section}}   
	    	    	    </tbody>
	</table>
	</div>
</div>
</div>
</div>
{{include file=admin/footer.tpl}}
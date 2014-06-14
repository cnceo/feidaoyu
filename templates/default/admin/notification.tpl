{{include file=admin/header.tpl}}
<script type="text/javascript"  src="/images/admin/js/notification.js" ></script>
<div id="anchor-content" class="middle">
	<div class="content-header" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><h3 class="icon-head head-notification">收件箱</h3></td>
	        </tr>
	    </tbody></table>
	</div>
	<div id="notificationGrid">
      {{include file=admin/pages.tpl}} 
<div class="grid">
	<div class="hor-scroll">
	<table cellspacing="0" id="notificationGrid_table" class="data">
	    	    <col width="20" class="a-center"/>
	    	    <col width="260"/>
	    	    <col width="150"/>
	    	    <col/>
	    	    <col/>
	    	    <col width="250"/>
	    	    	        <thead>
	            	                <tr class="headings">
	                	                    <th><span class="nobr">序号</span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="severity" href="#"><span class="sort-title">标题</span></a></span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="date_added" href="#"><span class="sort-title">日期</span></a></span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="title" href="#"><span class="sort-title">内容</span></a></span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="title" href="#"><span class="sort-title">添加人</span></a></span></th>
	                	                    <th class="no-link last"><span class="nobr">操作</span></th>
	                	                </tr>
	            	            	        </thead>
	    	    	    <tbody>
	    	    {{section name=data loop=$logs}}
	    	    	<tr class="{{cycle values='even,'}} " title="">
	        	            <td class="a-center">{{$pages.current*$pages.pagenum-$pages.pagenum+$smarty.section.data.index+1}}</td>
	        	            <td class=""><span class="grid-severity-minor">{{$logs[data].title}}</span></td>
	        	            <td class="">{{$logs[data].addtime}}</td>
	        	            <td class=""><span class="grid-row-title">{{$logs[data].utype}}</td>
	        	            <td class=""><span class="grid-row-title">{{$logs[data].username}}</td>
	        	            <td class="last"><a href="#" onclick="Add('{{$sites.ttype}}','{{$logs[data].id}}');">修改</a> | <a href="#" onclick="Add('{{$sites.ttype}}');">添加新模板</a></td>
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
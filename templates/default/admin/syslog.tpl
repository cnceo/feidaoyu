{{include file=admin/header.tpl}}
<script type="text/javascript"  src="/images/admin/js/notification.js" ></script>
<script type="text/javascript"  src="/images/admin/js/article.js" ></script>
<div id="anchor-content" class="middle">
	<div class="content-header" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><h3 class="icon-head head-notification">日志</h3></td>
	        </tr>
	    </tbody></table>
	</div>
	<div id="notificationGrid">
	{{include file=admin/pages.tpl}}        
<div id="notificationGrid_massaction">
</div><div class="grid">
	<div class="hor-scroll">
	<table cellspacing="0" id="notificationGrid_table" class="data">
	    	    <col width="20" class="a-center"/>
	    	    <col/>
	    	    <col width="150"/>
	    	    	        <thead>
	            	                <tr class="headings">
	                	                    <th><span class="nobr"> </span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="title" href="#"><span class="sort-title">信息</span></a></span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="date_added" href="#"><span class="sort-title">添加日期</span></a></span></th>
	                	                </tr>
	            	            	        </thead>
	    	    	    <tbody>
	    	    	     {{section name=mydata loop=$logs}}  
	    	    	        <tr class="{{cycle values='even,'}} " title="">
	        	            <td class="a-center">{{$pages.current*$pages.pagenum-$pages.pagenum+$smarty.section.mydata.index+1}}</td>
	        	            <td class=""><span class="grid-row-title">『{{if $logs[mydata].utype=="admin"}}内部账户{{else if}}注册用户{{/if}}』 	{{$logs[mydata].uname}}</span>        {{$logs[mydata].content}}</td>
	        	            <td class="">{{$logs[mydata].addtime}}</td>
	        	        </tr>
	        	        {{/section}}
	    	    	    </tbody>
	</table>
	</div>
</div>
</div>
</div>
{{include file=admin/footer.tpl}}
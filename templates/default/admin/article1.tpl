{{include file=admin/header.tpl}}
<script type="text/javascript"  src="/js/jquery.form.js" ></script>
<script type="text/javascript"  src="/images/admin/js/article.js" ></script>
<div id="anchor-content" class="middle">
	<div class="content-header" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><h3>{{$sites.curr_tpl}}内容管理</h3><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="Add('{{$sites.cateid}}');" class="scalable save" type="button" ><span>新加</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
	<div id="notificationGrid">
{{include file=admin/pages.tpl}} 
<div class="grid">
	<div class="hor-scroll">
	<table cellspacing="0" id="notificationGrid_table" class="data">
	    	    <col width="20" class="a-center"/>
	    	    <col />
	    	    <col width="100"/>
	    	    <col width="100"/>
	    	    <col width="40"/>
	    	    <col width="130"/>
	    	    <col width="40"/>
	    	    <col width="250"/>
	    	    	        <thead>
	            	                <tr class="headings">
	                	                    <th><span class="nobr">序号</span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="severity" href="#"><span class="sort-title">标题</span></a></span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="severity" href="#"><span class="sort-title">分类</span></a></span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="date_added" href="#"><span class="sort-title">添加人</span></a></span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="date_added" href="#"><span class="sort-title">点击</span></a></span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="title" href="#"><span class="sort-title">添加日期</span></a></span></th>
	                	                    <th><span class="nobr"><a class="not-sort" title="asc" name="title" href="#"><span class="sort-title">排序</span></a></span></th>
	                	                    <th class="no-link last"><span class="nobr">操作</span></th>
	                	                </tr>
	            	            	        </thead>
	    	    	    <tbody>
	    	    	<form id="myForm" name="myForm" action="" method="post">
		    	    {{section name=data loop=$logs}}
	    	    	<tr class="{{cycle values='even,'}} " title="">
	    	    	 <td class="a-center">{{$pages.current*$pages.pagenum-$pages.pagenum+$smarty.section.data.index+1}}</td>
	    	    	{{if $logs[data].pid!=""}}
	    	    	 <td class="" colspan="5">[分类]<a href="#" onclick="goCate('{{$logs[data].id}}');">{{$logs[data].catename}}</a></td>
	    	    	 <td class="grid-row-center"><input name="seque[cate][{{$logs[data].id}}]" value="0" size="2"></td>
	    	    	 <td class="last"><a href="#" onclick="AddCate('{{$logs[data].id}}');">修改</a> |
	        	             <a href="#" onclick="subAdd('{{$logs[data].pid}}');">新加</a> | 
	        	             <a href="#" onclick="goCate('{{$logs[data].id}}');">浏览</a>
	        	             </td>
	    	    	{{else if}}
	        	            <td class=""><input type="checkbox" name="id[]" id="id_{{$smarty.section.data.index}}" value="{{$logs[data].id}}" />
	        	            <a href="{{$urlpre}}/{{$logs[data].lang}}/{{$logs[data].unikey}}/{{$logs[data].addtime}}.html" target="_blank">{{$logs[data].title}}</a>
	        	            {{if $logs[data].status=="1"}}<span id="warning" >(头条)</span>{{/if}}
							{{if $logs[data].flag=="1"}}<span id="warning" >(Lock)</span>{{/if}}</td>
	        	            <td class="grid-row-center">{{$logs[data].catename}}</td>
	        	            <td class="grid-row-center">{{$logs[data].username}}</td>
	        	            <td class="grid-row-right">{{$logs[data].hits}}</td>
	        	            <td class="grid-row-center">{{$logs[data].addtime|date_format:"%Y-%m-%d %H:%M:%S"}}</td>
	        	            <td class="grid-row-center"><input name="seque[cont][{{$logs[data].id}}]" value="0" size="2"></td>
	        	            <td class="last"><a href="#" onclick="Add('{{$logs[data].classid}}','{{$logs[data].addtime}}');">修改</a> |
	        	            <a href="#" onclick="Del('{{$logs[data].addtime}}');"  alt="Cancel"> 删   除 </a> | 
	        	            {{if $logs[data].status=="1"}}
							<a href="#" onclick="NorNew('{{$logs[data].addtime}}');"  alt="normal"> 普  通 </a>
							{{else if}}
									<a href="#" onclick="TopNew('{{$logs[data].addtime}}');"  alt="top new"> 头  条 </a>
							{{/if}} | 
					        {{if $logs[data].flag=="1"}}
							<a href="#" onclick="Active('{{$logs[data].addtime}}');"  alt="Save"> 激  活 </a>
							{{else if}}
									<a href="#" onclick="Lock('{{$logs[data].addtime}}');"  alt="Revert"> 锁  定 </a>
							{{/if}} | 
							<a href="{{$urlpre}}/{{$logs[data].lang}}/{{$logs[data].unikey}}/{{$logs[data].addtime}}.html" target="_blank">浏览</a> |
	        	             <a href="#" onclick="Add('{{$sites.ttype}}');">新加</a></td>
	        	             {{/if}}
	        	        </tr>
	    	       {{sectionelse}}
         <tr>
          <td colspan="8"> <span id="warning" >暂无记录</span></td>
        </tr>
        {{/section}}
        <tr>
          <td colspan="8">
          <table style="border-width:0px 0px medium;"><tr><td style="border:0px solid">
          <input type="checkbox" name="checkedAll" id="checkedAll"/>全选/取消全选&nbsp; &nbsp; 
          <select name="classid">{{$catelist}}</select>&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="1" checked>移动&nbsp; &nbsp; 
          <input type="radio" name="more" id="more" value="0">删除&nbsp; &nbsp; 
          <button style="" onclick="Batch();" class="scalable save" type="button" ><span>操作</span></button>
		  </td><td style="border:0px solid">
			</td></tr></table>
          </td>
        </tr>   
        </form>
	    </tbody>
	</table>
	</div>
</div>
</div>
	<div class="content-footer" style="visibility: visible;">
	    <table cellspacing="0">
	        <tbody><tr>
	            <td><div class="content-buttons-placeholder"><p class="f-right"><button style="" onclick="ResetData('myForm');" class="scalable" type="button"><span>重置</span></button><button style="" onclick="SaveUpdate();" class="scalable save" type="button" ><span>排序</span></button><button style="" onclick="CancelBack();" class="scalable back" type="button" ><span>返回</span></button></p></div></td>
	        </tr>
	    </tbody></table>
	</div>
</div>
{{include file=admin/footer.tpl}}
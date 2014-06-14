{{include file=admin/header.tpl}}

<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('./images/brand.png');">商品品牌</h1>
    <div class="buttons"><a onclick="Add('{{'brand'|encrypt}}');" class="button"><span>添加新品牌</span></a></div>

  </div>
  <div class="content">
    <form action="" method="post" enctype="multipart/form-data" id="form">
      <table class="list">
        <thead>
          <tr>
            <td class="left">品牌名称</td>
            <td class="right">英文</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        {{section name=data loop=$logs}}
          <tr>
            <td class="left">{{$logs[data].cname}}</td>
            <td class="right">{{$logs[data].ename}}</td>
            <td class="right"><a href="#" onclick="Add('{{'brand'|encrypt}}','{{$logs[data].id}}');">修改</a> |
	        	            <a href="#" onclick="Del('{{'brand'|encrypt}}','{{$logs[data].id}}');"  alt="Cancel"> 删   除 </a> | 
	        	             <a href="#" onclick="Add('{{'brand'|encrypt}}');">新加</a></td>
          </tr>
        {{/section}}
                            </tbody>
      </table>
      <div class="buttons">
      {{include file=admin/pages.tpl}} 
      <div style="clear:both"></div>
      </div>
    </form>
  </div>
</div>
</div></div>

{{include file=admin/footer.tpl}}
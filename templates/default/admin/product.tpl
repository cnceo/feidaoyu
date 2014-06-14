{{include file=admin/header.tpl}}
<script type="text/javascript">
function go()
{
	location.href = "?m={{'product'|encrypt}}&prodname="+$("#prodname").val()+"&cateid="+$("#cateid").val()+"&model="+$("#model").val()+"&brand="+$("#brand").val()+"&quantity="+$("#quantity").val()+"&status="+$("#status").val();
}
function Batch()
{
	var data = $("#myForm").formToArray();
	if($("input[name='more']:checked").val()=="0")
	{
		msg = "删除";
	}
	else if($("input[name='more']:checked").val()=="3")
	{
		msg = "上架";
	}
	else if($("input[name='more']:checked").val()=="4")
	{
		msg = "下架";
	}
	else
	{
		msg = "移动";
	}

	if(confirm("您确认"+msg+"选中的商品吗？"))
		{
			$.ajax({
				type: "POST",
				url:  "?m={{'product'|encrypt}}&a=batch",
				data: data,
				success: function(msg){
						alert("操作成功");
						if($("input[name='more']:checked").val()=="3" ||$("input[name='more']:checked").val()=="4" )
						{
							location.href= "?m={{'product'|encrypt}}&status=1";
						}
						else if($("input[name='more']:checked").val()=="4")
						{
							location.href= "?m={{'product'|encrypt}}&status=0";
						}
						else
						{
							location.href= "?m={{'product'|encrypt}}&cateid="+$("#class_id").val();
						}
				}
			});
		}
}

</script>
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/product.png) no-repeat; overflow:hidden; width:160px">商品列表</h1>
    <div class="buttons"><a onclick="Add('{{'product'|encrypt}}',null,'&cateid={{$smarty.get.cateid}}');" class="button"><span>添加新商品</span></a></div>

  </div>
  <div class="content">

      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="center">图片</td>
            <td class="left">商品名称</td>
           <!--  <td class="left">品牌</td> -->
            <td class="left">型号</td>
           <!--  <td class="right">库存数量</td> -->
            <td class="left">状态</td>
            <td class="right">操作</td>
          </tr>
        </thead>
        <tbody>
        <tr class="filter">
            <td width="1" style="text-align: center;"></td>
            <td class="center"></td>
            <td class="left"><select name="cateid" id="cateid"><option value="">所有</option>{{$catelist}}</select><input type="text" value="{{$smarty.get.prodname}}" id="prodname"></td>

          <!--     <td class="left"> <input type="text" value="{{$smarty.get.brand}}" id="brand"></td> -->
            <td class="left"><input type="text" value="{{$smarty.get.model}}" id="model"></td>
          <!--   <td class="right"><input type="text" value="{{$smarty.get.quantity}}" id="quantity" size="8"></td> -->
            <td class="left"><select id="status">
                                <option value="">全部</option>
                                {{html_options options=$statuslist selected=$smarty.get.status}}
                              </select></td>
            <td class="right"><a onclick="go();" class="button"><span>搜索</span></a></td>
          </tr>
         </form>
         <form id="myForm" name="myForm" action="" method="post">
        {{section name=data loop=$logs}}
          <tr>
          <td style="text-align: center;">              <input type="checkbox" name="selected[]" value="{{$logs[data].id}}" />
              </td>
            <td class="center">{{if $logs[data].picpath}}<img src="{{$smarty.const.IMG_HOST}}{{$logs[data].picpath}}.100x100.jpg" alt="{{$logs[data].cname}}" style="padding: 1px; border: 1px solid #DDDDDD;" width="40"/>{{/if}}</td>
            <td class="left"><a href="/product/{{$logs[data].id}}.html" target="_blank">{{$logs[data].cprodname}}</a></td>
           <!--  <td class="left">{{$logs[data].brand_name}}</td> -->
            <td class="left">{{$logs[data].model}}</td>
<!--             <td class="right"><span style="color:{{if $logs[data].quantity > $logs[data].warn_quantity}}green{{else}}red{{/if}};">{{$logs[data].quantity-$logs[data].sold_quantity}}</span></td>
 -->            <td class="left">{{$logs[data].status_name}}</td>
            <td class="right"><a href="#" onclick="Add('{{'product'|encrypt}}','{{$logs[data].id}}');">修改</a> |
	        	            <a href="#" onclick="Del('{{'product'|encrypt}}','{{$logs[data].id}}');"  alt="Cancel"> 删   除 </a> |
	        	             <a href="#" onclick="Add('{{'product'|encrypt}}',null,'&cateid={{$smarty.get.cateid}}');">新加</a></td>
          </tr>
           {{sectionelse}}
          <tr>
            <td colspan="7" class="center">No results!</td>
          </tr>
        {{/section}}
                            </tbody>
      </table>
      <div class="buttons">
       <table style="border-width:0px 0px medium;"><tr><td style="border:0px solid">
          <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
          <select name="class_id" id="class_id">{{$catelist}}</select>&nbsp; &nbsp;
          <input type="radio" name="more" id="more" value="1" checked>移动&nbsp; &nbsp;
          <input type="radio" name="more" id="more" value="0">删除&nbsp; &nbsp;
          <input type="radio" name="more" id="more" value="3">上架&nbsp; &nbsp;
          <input type="radio" name="more" id="more" value="4">下架&nbsp; &nbsp;
          <a onclick="Batch();" class="button"><span>操作</span></a>
		  </td><td style="border:0px solid">
			</td></tr></table>{{include file=admin/pages.tpl}}
      <div style="clear:both"></div>
      </div>
       </form>
  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}
{{include file=admin/header.tpl}}
<div id="content">
{{include file=admin/navigation.tpl}}
<div class="box">    
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading" style="overflow:hidden">
    <h1 style="background:url(/admin/images/order.png) no-repeat; overflow:hidden; width:160px">关注度最高的商品</h1>   
  </div>   
  
  <div class="content">
    <table class="list">
      <thead>
        <tr>
          <td class="left">商品名称</td>
          <td class="left">SKU</td>
          <td class="right">浏览</td>
          <td class="right">购买</td>
          <td class="right">比率</td>
        </tr>
      </thead>
      
      <tbody>
      {{section name=data loop=$logs}}          
        <tr>
          <td class="left"><a href="/cn/product/{{$logs[data].id}}.html" target="_blank">{{$logs[data].cprodname}}</a></td>
          <td class="left">{{$logs[data].sku}}</td>
          <td class="right">{{$logs[data].hits}}</td>
          <td class="right">{{$logs[data].sold_quantity}}</td>
          <td class="right">{{$logs[data].sold_quantity/$logs[data].hits*100|string_format:"%.2f"}}%</td>
        </tr>
          {{sectionelse}}
          <tr>
            <td colspan="7" class="center">No results!</td>
          </tr>
        {{/section}}
                      </tbody>
    </table>
  </div>
</div>
</div></div>
{{include file=admin/footer.tpl}}
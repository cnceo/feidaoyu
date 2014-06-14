<div class="breadcrumb">
    <a href="./">首页</a>

     :: <a href="?m={{$sites.url}}">{{$sites.title}}</a>
     {{foreach from=$sites.navigation item=data}}
     :: <a href="?m={{'category'|encrypt}}&cateid={{$data.id}}">{{$data.cname}}</a>
     {{/foreach}}
   <div class="warning" style="display:none;">带*为必填项，不能为空请检查！</div>  
  </div>
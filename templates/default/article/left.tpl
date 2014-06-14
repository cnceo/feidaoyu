   <div class="sidebar">
   <div class="sidebar-block">
     <h3><a href="" class="topic_hd">海大培训</a></h3>
     <ul>
         <li><a href="">php培训</a></li>
         <li><a href="">wed前端培训</a></li>
         <li><a href="">3G移动开发培训</a></li>
     </ul>
     </div>
     <div class="title_Mod">
          <h2><a href="" class="technology-dynamics">php技术动态</a> </h2>
          <div class="hda_more"><a href=""></a></div>
        </div>
      <ul>
      {{foreach from=$news item=data}}
         <li><a href="/{{$data.classname|strtolower|replace:' ':'-'}}/{{$data.filename|strtolower|replace:' ':'-'}}-{{$data.id}}.html" target="_blank"  title="{{$data.title}}">{{$data.title|truncate:30:"UTF-8"}}</a></li>
         
        <!-- <li><a href="">数组遍历性能的比较</a></li>
         <li><a href="">如何提高PHP性能</a></li>
         <li><a href="">五个快速提升MySQL可扩展性的</a></li>
         <li><a href="">数组遍历性能的比较</a></li>
         <li><a href="">如何提高PHP性能</a></li>-->
        
        {{/foreach }}
     </ul>
      <div class="image3"><a href="{{$teacher.link}}"><img src="{{$smarty.const.IMG_HOST}}{{$teacher.picpath}}" width="220" height="229" /></a></div>
   </div>
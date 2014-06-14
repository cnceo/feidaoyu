{{include file=global/header.tpl}}
<div class="container">
  <div class="wrapper mt32 mb23">
    <div class="wrapper_t"></div>
    <div class="wrapper_c">
    <div class="nr-button">
      <div class="nr-button-l">
        <a href="/cases/{{$prev.filename|replace:' ':'-'}}-{{$prev.id}}.html">{{$prev.title}}</a>
      </div>
      <div class="nr-button-r">
        <a href="/cases/{{$next.filename|replace:' ':'-'}}-{{$next.id}}.html">{{$next.title}}</a>
      </div>
      <div class="clear"></div>
    </div>
      <div class="hd_article_page">
       
        <div class="hd_article_info">
          <div class="article_info_pic"><img alt="{{$log.title}}" src="{{if $log.picpath}}{{$smarty.const.IMG_HOST}}{{$log.picpath}}{{else}}/images/no_image-100x100.jpg{{/if}}" width="258" height="130">
</div>
          <div class="article_info_p">
            <h2>{{$log.title|truncate:20:"UTF-8"}}</h2>
            <P class="hd_time">{{$log.addtime|date_format:'%Y年%m月%d日 %H:%M'}} <span>分享到:<a href=""><img src="/images/weibo_ico.gif" /></a><a href=""><img src="/images/tw_ico.gif" /></a><a href=""><img src="/images/facebook_ico.gif" /></a></span></P>
            <p>{{$log.description}}</p>
          </div>
        </div>
        <div>{{$log.content}}<!-- <img src="/images/pic1.jpg" width="865" height="874" /> --></div>
        <div class="hd_related_works">
          <h3>相关作品</h3>
          <ul>
          {{foreach from=$logs item=data}}
            <li class="article_info_pic"><a href="/cases/{{$data.filename|replace:' ':'-'}}-{{$data.id}}.html" target="_blank"><img src="{{if $data.picpath}}{{$smarty.const.IMG_HOST}}{{$data.picpath}}{{else}}/images/no_image-100x100.jpg{{/if}}" /></a></li>
            {{foreachelse}}
            暂无相关作品
           {{/foreach}}
          </ul>
        </div>
      </div>
    </div>
    <div class="wrapper_b"></div>
  </div>
</div>
{{include file=global/footer.tpl}}
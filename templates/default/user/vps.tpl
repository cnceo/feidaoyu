{{include file=global/header.tpl}}
<script type="text/javascript">
function valDomain(nname)
{
	var arr = new Array(
	'.com','.net','.org','.biz','.coop','.info','.museum','.name',
	'.pro','.edu','.gov','.int','.mil','.ac','.ad','.ae','.af','.ag',
	'.ai','.al','.am','.an','.ao','.aq','.ar','.as','.at','.au','.aw',
	'.az','.ba','.bb','.bd','.be','.bf','.bg','.bh','.bi','.bj','.bm',
	'.bn','.bo','.br','.bs','.bt','.bv','.bw','.by','.bz','.ca','.cc',
	'.cd','.cf','.cg','.ch','.ci','.ck','.cl','.cm','.cn','.co','.cr',
	'.cu','.cv','.cx','.cy','.cz','.de','.dj','.dk','.dm','.do','.dz',
	'.ec','.ee','.eg','.eh','.er','.es','.et','.fi','.fj','.fk','.fm',
	'.fo','.fr','.ga','.gd','.ge','.gf','.gg','.gh','.gi','.gl','.gm',
	'.gn','.gp','.gq','.gr','.gs','.gt','.gu','.gv','.gy','.hk','.hm',
	'.hn','.hr','.ht','.hu','.id','.ie','.il','.im','.in','.io','.iq',
	'.ir','.is','.it','.je','.jm','.jo','.jp','.ke','.kg','.kh','.ki',
	'.km','.kn','.kp','.kr','.kw','.ky','.kz','.la','.lb','.lc','.li',
	'.lk','.lr','.ls','.lt','.lu','.lv','.ly','.ma','.mc','.md','.mg',
	'.mh','.mk','.ml','.mm','.mn','.mo','.mp','.mq','.mr','.ms','.mt',
	'.mu','.mv','.mw','.mx','.my','.mz','.na','.nc','.ne','.nf','.ng',
	'.ni','.nl','.no','.np','.nr','.nu','.nz','.om','.pa','.pe','.pf',
	'.pg','.ph','.pk','.pl','.pm','.pn','.pr','.ps','.pt','.pw','.py',
	'.qa','.re','.ro','.rw','.ru','.sa','.sb','.sc','.sd','.se','.sg',
	'.sh','.si','.sj','.sk','.sl','.sm','.sn','.so','.sr','.st','.sv',
	'.sy','.sz','.tc','.td','.tf','.tg','.th','.tj','.tk','.tm','.tn',
	'.to','.tp','.tr','.tt','.tv','.tw','.tz','.ua','.ug','.uk','.um',
	'.us','.uy','.uz','.va','.vc','.ve','.vg','.vi','.vn','.vu','.ws',
	'.wf','.ye','.yt','.yu','.za','.zm','.zw');

	var mai = nname;
	var val = true;

	var dot = mai.lastIndexOf(".");
	var dname = mai.substring(0,dot);
	var ext = mai.substring(dot,mai.length);
	//alert(ext);

	if(dot>2 && dot<57)
	{
		for(var i=0; i<arr.length; i++)
		{
		  if(ext == arr[i])
		  {
			val = true;
			break;
		  }
		  else
		  {
			val = false;
		  }
		}
		if(val == false)
		{
			 return false;
		}
		else
		{
			for(var j=0; j<dname.length; j++)
			{
			  var dh = dname.charAt(j);
			  var hh = dh.charCodeAt(0);
			  if((hh > 47 && hh<59) || (hh > 64 && hh<91) || (hh > 96 && hh<123) || hh==45 || hh==46)
			  {
				 if((j==0 || j==dname.length-1) && hh == 45)
				 {
					  return false;
				 }
			  }
			else	{
				 return false;
			  }
			}
		}
	}
	else
	{
	 return false;
	}
	return true;
}

function binding(id,host)
{
	var domain = document.getElementById("domains"+id).value;
	vdomain = valDomain(domain);
	if(vdomain==false)
	{
		alert("绑定失败，请输入正确的域名");
		return false;
	}
		$.ajax({
				type: "POST",
				url:  "/user/vps.html&a=binding",
				data: { domain:domain,host:host},
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							 alert("绑定成功!");
							 window.location.href='/user/vps.html';
						 }
						 else if(msg.status == "false1")
							 {
							 alert(msg.message);
							 }
						 else if(msg.status == "false2")
						 {
						 alert(msg.message);
						 }
						 else
						{
							alert("绑定失败");

						}
				   }
			});
	}

function cancel(id)
{
		$.ajax({
				type: "POST",
				url:  "/user/vps.html&a=cancel",
				data: {host:id},
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							 alert("取消成功!");
							 window.location.href='/user/vps.html';
						 }
						 else
						{
							alert("取消失败");

						}
				   }
			});

	}

function openvps(id)
{
	$("#openvps").load("/user/vps.html&a=open&vid="+id);
}
</script>
<div class="headborder"></div>
<div id="container" class="cfl">
	<div class="aside">
		<div class="nav">
			<div class="portlet" id="yw0">
<div class="portlet-decoration">
<div class="portlet-title">我的订单</div>
</div>
<div class="portlet-content">
<ul class="operations" id="yw1">
    <li><a class="T_navChange" href="/user/vps.html">主机管理</a></li>
        <li><a class="T_navChange" href="/user/domain.html">域名管理</a></li>
        <li><a class="T_navOrder" href="/user/order.html">交易订单</a></li>
</ul>

</div>
</div>
<div class="portlet" id="yw4">
<div class="portlet-decoration">
<div class="portlet-title">我的个人信息</div>
</div>
<div class="portlet-content">
    <ul class="operations" id="yw5">
  <!--       <li><a class="T_navAddress" href="">- 收货地址</a></li> -->
        <li><a target="_blank" class="T_navAddress" href="/user/changepassword.html">修改密码</a></li>
    </ul>
</div>
</div>		</div>
	</div>
	<!-- aside -->
	<div class="main">
	{{foreach from=$logs item=data}}
		<table class="odr_bigtable" style="margin-bottom:10px">
	<thead>
		<tr>
			<th colspan="5" class="cfl">
					<span class="datetime">成交日期：{{$data.addtime}}</span>
					<span>订单号：</span>
					<a href="javascript:" class="resMsgTitle" rel="{{$data.id}}">{{$data.order_id}}</a>
            </th>
		</tr>
	</thead>
	<tbody>
		<tr>
							<td class="std1 width125">
							<div class="divorder"><a class="mimg" href="" title="{{$data.cprodname}}">{{$data.cprodname}}</div>
							</td>
							<!-- <td class="width125">用户名:{{$data.ftpuser}}<br>密码:{{$data.ftppwd}}</td>
							<td class="std2 width125">
								<span>域名:{{$data.domain|default:"未绑定域名"}}</span>
							</td>-->
							<td class="std2 width45">
								<span>{{$data.year}}年</span>
							</td>
							<td class="std3 width125"><span>成功日:{{$data.stime|default:"暂未开通"}}</span></td>
			<td class="std3"><span>到期日:{{$data.etime|default:"暂未开通"}}</span></td>
			<td class="width75">
			{{if $data.status!=2}}<a href="javascript:void(0)" onclick="openvps('{{$data.id}}')">开通</a>{{else}}<a href="javascript:void(0)" class="resMsgTitle" rel="{{$data.id}}">详情</a>{{/if}}
            </td>
		</tr>
	</tbody>
</table>
            <div style="position: static; display:none;" id="msgDetail_{{$data.id}}" class="mam_orderdetail">
              <!--这里是内容-->
              <p>
			  <b>订单编号：</b>{{$data.order_id}}
			  </p>
			             <p>
			  <b>FTP地址：</b>{{$data.domain}}
			  </p>
			                <p>
			  <b>FTP账号：</b>{{$data.ftpuser}}
			  </p>
			  <p>
			  <b>FTP密码：</b>{{$data.ftppwd}} {{if $data.status==2}}<a href="/user/vps.html&a=updatevpspwd&vpsid={{$data.id}}">修改密码</a>{{/if}}
			  </p>
			        <p>
			  <b>数据库地址：</b>{{$data.dbhost}}
			  </p>
			      <p>
			  <b>数据库访问地址：</b>{{$data.phpmyadmin}}
			  </p>
			    <p>
			  <b>数据库账号：</b>{{$data.ftpuser}}
			  </p>
			  <p>
			  <b>数据库密码：</b>{{$data.ftppwd}}
			  </p>
			  		<p>
			  <b>成功日：</b>{{$data.stime|default:"暂未开通"}}
			  </p>
			  			  			  <p>
			  <b>到期日：</b>{{$data.etime|default:"暂未开通"}}
			  </p>
			  <p>
			  <b>操作：</b>{{if $data.status!=2}}<a href="/user/vps.html&a=open&vid={{$data.id}}" class="thickbox">开通</a>{{/if}}
			  </p>
			  <table class="vps-table-order">
                  <tr>
                      <th width="70%">域名</th>
                      <th width="30%">操作</th>
                  </tr>
                  {{foreach from=$data.sdomain item=data2}}
                   <tr>
                      <td>{{$data2.domain}}</td>
                      <td><a href="javascript:void(0)" onclick="cancel('{{$data2.id}}')">取消</a></td>
                  </tr>
                  {{/foreach}}
                   <input type="hidden" name="host" id="host" value="{{$data.mid}}">
                  <tr>
                      <td><input type="text" id="domains{{$data.id}}" class="textinput" name="domains"></td><td><a href="javascript:void(0)" onclick="binding('{{$data.id}}','{{$data.mid}}')"><span>绑定</span></a></td>
                  </tr>
			  </table>
            </div>
            <div id="openvps"></div>
{{foreachelse}}
暂无主机
{{/foreach}}

<style type="text/css">
ul.yiiPager .hidden a,ul.yiiPager a:link, ul.yiiPager a:visited {
    border: none;
    color: #888888;
}
.yiiPager li.selected a {
    background: none repeat scroll 0 0 #B8B8BA;
    color: #FFFFFF;
}
 </style>
<div class="acc_page" >
   </div>
	</div>
	<!-- main -->
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("a.resMsgTitle,a.resMenClose").click(function(){$("#msgDetail_"+this.rel).toggle();});
	});
</script>
{{include file=global/footer.tpl}}

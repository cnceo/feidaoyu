function AddFavorite(sURL, sTitle)
{
    try
    {
        window.external.addFavorite(sURL, sTitle);
    }
    catch (e)
    {
        try
        {
            window.sidebar.addPanel(sTitle, sURL, "");
        }
        catch (e)
        {
            alert("加入收藏失败，请使用Ctrl+D进行添加");
        }
    }
}

function SetHome(obj,vrl){
        try{
                obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);
        }
        catch(e){
                if(window.netscape) {
                        try {
                                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                        }
                        catch (e) {
                                alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将[signed.applets.codebase_principal_support]设置为'true'");
                        }
                        var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                        prefs.setCharPref('browser.startup.homepage',vrl);
                 }
        }
}

 function search()
 {
 	if($("#keyword").val()=="请输入搜索的关键词")
 	{
 		alert("请输入搜索的关键词");
 	}
 	else
 	{
 		location.href="/search/&searchtype="+$("#searchtype").val()+"&keyword="+$("#keyword").val();
 	}
 }

 function usersearch()
 {
 	if($("#uname").val()=="请输入搜索的关键词")
 	{
 		alert("请输入搜索的关键词");
 	}
 	else
 	{
 		location.href="/sns/search.html&searchtype=user&snsword="+$("#uname").val();
 	}
 }



function copyData(text)
{
	var clipBoardContent,clip,trans,str,len,str,copytext,clipid;
	clipBoardContent = text;
	if(window.clipboardData){
	   window.clipboardData.clearData();
	   window.clipboardData.setData("Text", clipBoardContent);
	}
	else if(navigator.userAgent.indexOf("Opera") != -1){
	   window.location = clipBoardContent;
	}
	else if (window.netscape){
	   try{
	    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
	   }catch (e){
	    alert("您的当前浏览器设置已关闭此功能！请按以下步骤开启此功能！\n新开一个浏览器，在浏览器地址栏输入'about:config'并回车。\n然后找到'signed.applets.codebase_principal_support'项，双击后设置为'true'。\n声明：本功能不会危极您计算机或数据的安全！");
	   }
	   clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
	   if (!clip) return;
	   trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
	   if (!trans) return;
	   trans.addDataFlavor('text/unicode');
	   str = new Object();
	   len = new Object();
	   str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
	   copytext = clipBoardContent;
	   str.data = copytext;
	   trans.setTransferData("text/unicode",str,copytext.length*2);
	   clipid = Components.interfaces.nsIClipboard;
	   if (!clip) return false;
	   clip.setData(trans,null,clipid.kGlobalClipboard);
	}
	return true;
}

$(document).ready(function(){
    $(".starpoint").toggle(
				function(){this.src='/images/marking-1.png';showstar(this.id)},
				function(){this.src='/images/marking-0.png';showstar(this.id)});
});

function showstar(str)
{
	var strs= new Array(); //定义一数组
	strs=str.split("_"); //字符分割
	$("#point_"+strs[1]).val(strs[2]);
	for (i=1;i<6;i++)
	    {
	    	$("#star_"+strs[1]+"_"+i).attr("src","/images/marking-0.png");
	    }
	var e =  parseInt(strs[2])+1;
    for (i=1;i<e;i++)
	    {
	    	$("#star_"+strs[1]+"_"+i).attr("src","/images/marking-1.png");
	    }
}
function marking(type,id)
{
	var point = $("#point_"+id).val();
	$.ajax({
				type: "POST",
				url:  "/user/userinfo.html&a=marking",
				data: "source="+id+"&category="+type+"&point="+point,
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							alert(msg.message);
						 	window.location.reload();
						 }
						 else
						{
							alert(msg.message);
							if(msg.herf)window.location.href=msg.herf;

						}
				   }
			});
}


function usetpl(id,rid)
{
	$.ajax({
				type: "POST",
				url:  "/user/userinfo.html&a=usetpl",
				data: {tid:id,
				rid:rid
				},
				dataType: 'json',
				success: function(msg){
						if(msg.status == "true")
						 {
							alert(msg.message);
						 	window.location.reload();
						 }
						 else
						{
							alert(msg.message);
							if(msg.herf)window.location.href=msg.herf;

						}
				   }
			});
}

function dotb(title, url)
{
	$(document).ready(function(){ tb_show(title, url, null); });
}


function searchp(id,keyname)
{
   	var keytext = $("#"+keyname).val();
	if(keytext)
	{
		$("#"+id).load("/user/product.html&a=slist_search&keyword="+encodeURIComponent(keytext));
	}
	else
	{
		alert("请输入关键词");return false;
	}

}

function searchp_class(id,keyname)
{
   	var keytext = $("#"+keyname).val();
	if(keytext)
	{
		$("#"+id).load("/user/product.html&a=slist_search_class&keyword="+encodeURIComponent(keytext));
	}
	else
	{
		alert("请输入关键词");return false;
	}

}

function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
		 var menu=document.getElementById(name+i);
		 var con=document.getElementById("con_"+name+"_"+i);
		
		menu.className=i==cursel?"hover":"";
		 con.style.display=i==cursel?"block":"none";
	}
}


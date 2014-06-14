	function CancelBack()
	{
		if(confirm("您确认放弃保存本次操作？"))
		{
			history.go(-1);
		}
	}
	
	function Cancel()
	{
		history.go(-1);
	}
	
	function ResetData(objid)
	{
		document.getElementById(objid).reset();
	}
	
	function Handle()
	{
		alert("操作成功");
		history.go(-1);
	}
	
	function loadByPagesize(s)
	{
		url = window.location.href;
		url = url.replace(/\/pagesize\/\d+\/{0,1}/,"");
		location=url+'&pagesize='+s.options[s.selectedIndex].value;
	}
	
	function dotb(title, url)
	{
		$(document).ready(function(){ tb_show(title, url, null); });
	}
	 
	
	function Show(id)
	{
		if(navigator.userAgent.indexOf("MSIE")>0)
		{
			document.getElementById(id).style.display="block";
		}
		else
		{
			document.getElementById(id).style.visibility = "visible";
		}
	}
	
	function Hide(id)
	{
		if(navigator.userAgent.indexOf("MSIE")>0)
		{
			document.getElementById(id).style.display="none";
		}
		else
		{
			document.getElementById(id).style.visibility = "hidden";
			document.getElementById(id).style.visibility = "collapse";
		}
	}
	
	function Add(m,id,para)
	{
		if(!id)id="";
		if(!para)para="";
		location.href="?m="+m+"&a=add&id="+id+para;
	}

	function Del(m,id)
	{
		 if(confirm("确认删除吗？"))
			{
				show_message();
				$.ajax({
					type: "POST",
					url:  "?m="+m+"&a=delete",
					data: "id="+id,
					dataType: 'json',
					success: function(msg){
						hidden_message();
					    if (msg.status=='true')
						 {
							 location.reload();
						 }
						 else
						 {
						 	alert(msg.message);
						 }
					} 
				}); 
			}
	}
	
	function show_message()
	{
		$(".warning").css('display','none');
		$("#message_box").attr("class", "message_box_show");
	}
	
	function hidden_message()
	{
		$("#message_box").attr("class", "message_box");
	}
	
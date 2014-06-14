<?php /* Smarty version 2.6.7, created on 2012-10-16 18:18:19
         compiled from user/openvps.tpl */ ?>
<script type="text/javascript" src="/js/jquery.form.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript">
$.validator.setDefaults({
	 submitHandler: function() {
	 	var data = $("#myForm").formToArray();
				$.ajax({
				type: "POST",
				url:  "/user/vps.html&a=building",
				data: data,
				dataType: 'json',
				success: function(msg){
				    if(msg.status == "true")
						    {
							parent.location = "/user/vps.html";
						    }
						    else
						    {
						    	alert(msg.message);
						    }
				   }
			});
	}
});


$(document).ready(function(){

   	   $("#myForm").validate({
    	rules: {
    		   domain: {
	    			required: true,
	    			remote:"/?type=user&m=vps&a=check"
	    		}
    	      },
    	 messages: {
    		 domain: {
    	 	    	required: "请输入您的域名",
    	 	    	remote:"该域名已拥有"
    	 	    }
    	      }
   	 });

});

</script>
<body>
     <form method="post" action="" id="myForm">
<div style="position:relative; top:auto; left:auto; margin:10px auto;">
             <h3>请直接点击开通：</h3>
                 <input type="text" class="smallboxsearch" value="<?php echo $this->_tpl_vars['doamin']; ?>
" disabled="disabled">
                 <input type="hidden" name="domain" id="domain" value="<?php echo $this->_tpl_vars['doamin']; ?>
" >
                 <div class="domainname">.feidaoyu.com</div>
                 <input type="hidden" name="id" value="<?php echo $_GET['vid']; ?>
">
                <input type="submit" class="smallboxbtn openwww" value="">
             <div class="clear"></div>
         </div>
    </form>


















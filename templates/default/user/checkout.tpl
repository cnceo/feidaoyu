{{include file=global/header.tpl}}

<script>
function CheckForm()
{
	if (document.alipayment.aliorder.value.length == 0) {
		alert("请输入商品名称.");
		document.alipayment.aliorder.focus();
		return false;
	}
	if (document.alipayment.alimoney.value.length == 0) {
		alert("请输入付款金额.");
		document.alipayment.alimoney.focus();
		return false;
	}
	if (Number(document.alipayment.alimoney.value) < 0.01) {
		alert("付款金额金额最小是0.01.");
		document.alipayment.alimoney.focus();
		return false;
	}
}

function glowit(which){
	if (document.all.glowtext[which].filters[0].strength==2)
	document.all.glowtext[which].filters[0].strength=1
	else
	document.all.glowtext[which].filters[0].strength=2
	}
	function glowit2(which){
	if (document.all.glowtext.filters[0].strength==2)
	document.all.glowtext.filters[0].strength=1
	else
	document.all.glowtext.filters[0].strength=2
	}
	function startglowing(){
	if (document.all.glowtext&&glowtext.length){
	for (i=0;i<glowtext.length;i++)
	eval('setInterval("glowit('+i+')",150)')
	}
	else if (glowtext)
	setInterval("glowit2(0)",150)
	}
	if (document.all)
	window.onload=startglowing
</script>
<div class="headborder"></div>
<div class="breadcrumbs">
<a href="/">飞刀鱼首页</a> <span class='separator'>></span> <span>选择在线支付方式</span></div><!-- breadcrumbs -->

    <div class="payOnline">
	<div class="shopCarbag">
      <ul class="cfl">
        <li class="item1"><span>1</span>购物车结算</li>
        <li class="item2 overed"><span>2</span>填写订单信息</li>
        <li class="selected item3" style="background-color:#e8e8e8;"><span>3</span>支付/确定订单</li>
      </ul>
    </div>
    <dl class="payOnline_use">


        <dt>订单：{{$log.order_id}}                        &nbsp;&nbsp;&nbsp;&nbsp;金额：<strong>&yen; {{$log.totprice}}</strong>
        </dt>
    </dl>

    <div class="payOnline_tit cfl">
        <h2>在线支付方式</h2>
                    <p>温馨提示：订单生成后请在48小时内支付，否则订单会被系统取消。</p>
                </div>
	<div class="payOnline_Box">
          <TABLE cellSpacing=0 cellPadding=0 width=960 border=0>
			  <TBODY>
			  <TR>
			    <TD class="title">支付宝即时到帐付款快速通道</TD>
			  </TR></TBODY>
			</TABLE><BR>
			<FORM name="alipayment" onSubmit="return CheckForm();" action="/pay/alipay/alipayto.php" method="post">
			<table>
			 <tr>
			   <td>
			     <TABLE cellSpacing=0 cellPadding=0 width=890 border=0>
			        <TR>
			          <TD class=form-left>收款方： </TD>
			          <TD class=form-star>* </TD>
			          <TD class="form-right yellow_g3">飞刀鱼</TD>
			        </TR>
			        <TR>
			          <TD colspan="3" align="center" style="padding:0;"><HR width=900 SIZE=2 color="#999999"></TD>
			        </TR>
			        <TR>
			          <TD class=form-left>标题： </TD>
			          <TD class=form-star>* </TD>
			          <TD class=form-right>订单{{$log.order_id}} <INPUT type="hidden" size=30 name=aliorder maxlength="200" value="{{$log.order_id}}"/></TD>
			        </TR>
			        <TR>
			          <TD class=form-left>付款金额： </TD>
			          <TD class=form-star>*</TD>
			          <TD class=form-right>{{$log.totprice|string_format:"%.2f"}}元 <INPUT type="hidden" onkeypress="return regInput(this,/^\d*\.?\d{0,2}$/,String.fromCharCode(event.keyCode))"  onpaste="return regInput(this,/^\d*\.?\d{0,2}$/,window.clipboardData.getData('Text'))" ondrop="return regInput(this,/^\d*\.?\d{0,2}$/,&#9;event.dataTransfer.getData('Text'))" maxLength=10 size=30 name=alimoney  onfocus="if(Number(this.value)==0){this.value='';}" value="{{$log.totprice|string_format:"%.2f"}}"/></TD>
			        </TR>
			        <TR>
			          <TD class=form-left>备注：</TD>
			          <TD class=form-star></TD>
			          <TD class=form-right><TEXTAREA name=alibody rows=2 cols=40 wrap="physical"></TEXTAREA><BR>
			          （如联系方法，商品要求、数量等。100汉字内）</TD>
			        </TR>
 			        <TR>
			          <TD class=form-left>支付方式：</TD>
			          <TD class=form-star></TD>
			          <TD class=form-right>
			               <table class="banks">
			                 <tr>
			                   <td><input type="radio" name="pay_bank" value="directPay" checked><img src="/images/bank/alipay_1.gif" border="0"/></td>
			                 </tr>
			                 <tr>
			                   <td><input type="radio" name="pay_bank" value="ICBCB2C"/><img src="/images/bank/ICBC_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="CMB"/><img src="/images/bank/CMB_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="CCB"/><img src="/images/bank/CCB_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="BOCB2C"><img src="/images/bank/BOC_OUT.gif" border="0"/></td>
			                 </tr>
			                 <tr>
			                   <td><input type="radio" name="pay_bank" value="ABC"/><img src="/images/bank/ABC_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="COMM"/><img src="/images/bank/COMM_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="SPDB"/><img src="/images/bank/SPDB_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="GDB"><img src="/images/bank/GDB_OUT.gif" border="0"/></td>
			                 </tr>
			                 <tr>
			                   <td><input type="radio" name="pay_bank" value="CITIC"/><img src="/images/bank/CITIC_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="CEBBANK"/><img src="/images/bank/CEB_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="CIB"/><img src="/images/bank/CIB_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="SDB"><img src="/images/bank/SDB_OUT.gif" border="0"/></td>
			                 </tr>
			                 <tr>
			                   <td><input type="radio" name="pay_bank" value="CMBC"/><img src="/images/bank/CMBC_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="HZCBB2C"/><img src="/images/bank/HZCB_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="SHBANK"/><img src="/images/bank/SHBANK_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="NBBANK "><img src="/images/bank/NBBANK_OUT.gif" border="0"/></td>
			                 </tr>
			                 <tr>
			                   <td><input type="radio" name="pay_bank" value="SPABANK"/><img src="/images/bank/SPABANK_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="BJRCB"/><img src="/images/bank/BJRCB_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="ICBCBTB"/><img src="/images/bank/ENV_ICBC_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="CCBBTB"/><img src="/images/bank/ENV_CCB_OUT.gif" border="0"/></td>
			                 </tr>
			                 <tr>
			                   <td><input type="radio" name="pay_bank" value="SPDBB2B"/><img src="/images/bank/ENV_SPDB_OUT.gif" border="0"/></td>
			                   <td><input type="radio" name="pay_bank" value="ABCBTB"/><img src="/images/bank/ENV_ABC_OUT.gif" border="0"/></td>
							   <td><input type="radio" name="pay_bank" value="fdb101"/><img src="/images/bank/FDB_OUT.gif" border="0"/></td>
							   <td></td>
			                 </tr>
			               </table>
			          </TD>
			        </TR>
			         <TR>
			          <TD class=form-left></TD>
			          <TD class=form-star></TD>
<!-- 			          <TD class=form-right><INPUT type=image
			            src="/images/bank/button_sure.gif" value=确认订单
			            name=nextstep></TD> -->
			        </TR>
			</TABLE>
            <p class="payOnline_btn cfl">
          <!--   <input type="button" value="付 款"  onclick="location.href='/user/payment.html&order_id={{$log.order_id}}'" class="shopBtn" /> -->
          <input type="submit" value="付 款"  class="shopBtn" />
        </p>
        </div>
<div id="payOnline_boxyBg" class="payOnline_boxyBg"></div>
<div class="payOnline_boxy" id="payOnline_boxy">
    <p class="payOnline_boxy_tit">
		<a href="#"><span class="hidden">关闭</span></a>
	</p>
    <h3>正在支付...</h3>
    <div class="payOnline_boxCon cfl">
        <dl class="item1">
            <dt>如果支付失败...  </dt>
            <dd>额度问题，推荐<a href="#">支付宝快捷支付</a></dd>
            <dd>其他问题，查看<a href="">支付常见问题</a></dd>
        </dl>
        <dl class="item2">
            <dt>支付成功了</dt>
            <dd>立即查看<a href="">订单详情</a></dd>
        </dl>
    </div>
</div>
{{include file=global/footer.tpl}}
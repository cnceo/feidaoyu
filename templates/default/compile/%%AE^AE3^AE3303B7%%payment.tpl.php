<?php /* Smarty version 2.6.7, created on 2012-09-18 11:21:26
         compiled from user/payment.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'user/payment.tpl', 421, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
BODY {
	BACKGROUND: #ffffff; MARGIN: 5px 0px 0px; FONT-FAMILY: ����
}
TD {
	FONT-SIZE: 14px; COLOR: #000; FONT-FAMILY: ����
}
INPUT {
	PADDING-RIGHT: 2px; PADDING-LEFT: 2px; FONT-SIZE: 14px; PADDING-BOTTOM: 0px; PADDING-TOP: 4px
}
IMG {
	BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px
}

A:link {
	/********COLOR: #003399******/

	color: #D5D5D5;
}
}
A:visited {
	COLOR: #003399
}
A:hover {
	COLOR: #ff6600
}
.box {
	BORDER-RIGHT: #cccccc 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #cccccc 3px solid; PADDING-LEFT: 8px; FONT-SIZE: 14px; PADDING-BOTTOM: 10px; BORDER-LEFT: #cccccc 1px solid; LINE-HEIGHT: 150%; PADDING-TOP: 10px; BORDER-BOTTOM: #cccccc 1px solid
}
.box-top {
	PADDING-RIGHT: 8px; BORDER-TOP: #cccccc 3px solid; PADDING-LEFT: 8px; FONT-SIZE: 14px; PADDING-BOTTOM: 10px; LINE-HEIGHT: 150%; PADDING-TOP: 10px
}
.box-list {
	BORDER-RIGHT: #cccccc 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #cccccc 1px solid; PADDING-LEFT: 8px; PADDING-BOTTOM: 10px; BORDER-LEFT: #cccccc 1px solid; LINE-HEIGHT: 150%; PADDING-TOP: 10px; BORDER-BOTTOM: #cccccc 1px solid
}
.box-o {
	PADDING-RIGHT: 8px; BORDER-TOP: #eeeedd 3px solid; PADDING-LEFT: 8px; PADDING-BOTTOM: 10px; LINE-HEIGHT: 150%; PADDING-TOP: 10px
}
.box-action {
	BORDER-RIGHT: #ff9966 2px solid; PADDING-RIGHT: 8px; BORDER-TOP: #ff9966 2px solid; PADDING-LEFT: 8px; BACKGROUND: #fff6f0; PADDING-BOTTOM: 10px; BORDER-LEFT: #ff9966 2px solid; LINE-HEIGHT: 150%; PADDING-TOP: 10px; BORDER-BOTTOM: #ff9966 2px solid
}
.box-danger {
	BORDER-RIGHT: #ffd0a8 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #ffd0a8 1px solid; PADDING-LEFT: 8px; BACKGROUND: #ffffee; PADDING-BOTTOM: 6px; BORDER-LEFT: #ffd0a8 1px solid; LINE-HEIGHT: 150%; PADDING-TOP: 6px; BORDER-BOTTOM: #ffd0a8 1px solid
}
.box-prom {
	BORDER-RIGHT: #ffd0a8 2px solid; PADDING-RIGHT: 8px; BORDER-TOP: #ffd0a8 2px solid; PADDING-LEFT: 8px; BACKGROUND: #ffffff; PADDING-BOTTOM: 6px; BORDER-LEFT: #ffd0a8 2px solid; LINE-HEIGHT: 150%; PADDING-TOP: 6px; BORDER-BOTTOM: #ffd0a8 2px solid
}
.box-note {
	BORDER-RIGHT: #ccccee 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #ccccee 1px solid; PADDING-LEFT: 8px; BACKGROUND: #eeeeff; PADDING-BOTTOM: 6px; BORDER-LEFT: #ccccee 1px solid; LINE-HEIGHT: 150%; PADDING-TOP: 6px; BORDER-BOTTOM: #ccccee 1px solid
}
.h1 {
	PADDING-RIGHT: 8px; PADDING-LEFT: 8px; FONT-WEIGHT: bold; FONT-SIZE: 14px; PADDING-BOTTOM: 6px; COLOR: #cc5500; LINE-HEIGHT: 150%; PADDING-TOP: 6px
}
.h1-top {
	PADDING-RIGHT: 8px; BORDER-TOP: #cccccc 1px solid; PADDING-LEFT: 8px; FONT-WEIGHT: bold; FONT-SIZE: 14px; PADDING-BOTTOM: 6px; COLOR: #cc5500; LINE-HEIGHT: 150%; PADDING-TOP: 6px
}
.h1-prom {
	PADDING-RIGHT: 8px; BORDER-TOP: #ffcc99 1px solid; PADDING-LEFT: 8px; FONT-WEIGHT: bold; FONT-SIZE: 14px; BACKGROUND: #ffffee; PADDING-BOTTOM: 6px; COLOR: #cc5500; LINE-HEIGHT: 150%; PADDING-TOP: 6px
}
.h1-succ {
	BORDER-RIGHT: #eeeedd 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #eeeedd 1px solid; PADDING-LEFT: 8px; FONT-WEIGHT: bold; FONT-SIZE: 14px; BACKGROUND: #ffffee; PADDING-BOTTOM: 10px; BORDER-LEFT: #eeeedd 1px solid; COLOR: #000000; LINE-HEIGHT: 150%; PADDING-TOP: 10px; BORDER-BOTTOM: #eeeedd 1px solid
}
.h1-danger {
	PADDING-RIGHT: 8px; PADDING-LEFT: 8px; FONT-WEIGHT: bold; FONT-SIZE: 14px; PADDING-BOTTOM: 6px; COLOR: #f00000; LINE-HEIGHT: 150%; PADDING-TOP: 6px
}
.h2 {
	PADDING-RIGHT: 8px; PADDING-LEFT: 8px; FONT-WEIGHT: bold; FONT-SIZE: 14px; PADDING-BOTTOM: 6px; LINE-HEIGHT: 150%; PADDING-TOP: 6px
}
.h2-top {
	PADDING-RIGHT: 8px; BORDER-TOP: #cccccc 1px solid; PADDING-LEFT: 8px; FONT-WEIGHT: bold; FONT-SIZE: 14px; PADDING-BOTTOM: 6px; LINE-HEIGHT: 150%; PADDING-TOP: 6px
}
.h2-note {
	PADDING-RIGHT: 8px; PADDING-LEFT: 8px; FONT-WEIGHT: bold; FONT-SIZE: 14px; PADDING-BOTTOM: 3px; LINE-HEIGHT: 150%; PADDING-TOP: 8px; BORDER-BOTTOM: #ccccee 1px solid
}
.h2-bottom {
	PADDING-RIGHT: 8px; PADDING-LEFT: 26px; FONT-WEIGHT: bold; FONT-SIZE: 14px; PADDING-BOTTOM: 3px; LINE-HEIGHT: 150%; PADDING-TOP: 8px; BORDER-BOTTOM: #eeeedd 2px solid; align: left
}
.h2-bottom-hot {
	PADDING-RIGHT: 8px; PADDING-LEFT: 26px; FONT-WEIGHT: bold; FONT-SIZE: 14px; PADDING-BOTTOM: 3px; LINE-HEIGHT: 150%; PADDING-TOP: 6px; BORDER-BOTTOM: #ff7300 0px solid
}
.h3 {
	PADDING-RIGHT: 8px; PADDING-LEFT: 8px; FONT-SIZE: 14px; PADDING-BOTTOM: 6px; LINE-HEIGHT: 150%; PADDING-TOP: 6px
}
.h3-top {
	PADDING-RIGHT: 8px; BORDER-TOP: #eeeedd 3px solid; PADDING-LEFT: 8px; FONT-SIZE: 14px; PADDING-BOTTOM: 6px; LINE-HEIGHT: 150%; PADDING-TOP: 6px
}
.h3-note {
	BORDER-RIGHT: #ccccee 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #ccccee 1px solid; PADDING-LEFT: 8px; FONT-SIZE: 14px; BACKGROUND: #eeeeff; PADDING-BOTTOM: 6px; BORDER-LEFT: #ccccee 1px solid; LINE-HEIGHT: 150%; PADDING-TOP: 6px; BORDER-BOTTOM: #ccccee 1px solid
}
.h3-prom {
	BORDER-RIGHT: #ff9966 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #ff9966 1px solid; PADDING-LEFT: 8px; FONT-SIZE: 14px; BACKGROUND: #ffffee; PADDING-BOTTOM: 6px; BORDER-LEFT: #ff9966 1px solid; LINE-HEIGHT: 150%; PADDING-TOP: 6px; BORDER-BOTTOM: #ff9966 1px solid
}
.h3-green {
	BORDER-RIGHT: #669966 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #669966 1px solid; PADDING-LEFT: 8px; FONT-SIZE: 14px; BACKGROUND: #dbf0dd; PADDING-BOTTOM: 6px; BORDER-LEFT: #669966 1px solid; LINE-HEIGHT: 150%; PADDING-TOP: 6px; BORDER-BOTTOM: #669966 1px solid
}
.h3-yellow {
	BORDER-RIGHT: #ffcc00 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #ffcc00 1px solid; PADDING-LEFT: 8px; FONT-SIZE: 14px; BACKGROUND: #f8f8d2; PADDING-BOTTOM: 6px; BORDER-LEFT: #ffcc00 1px solid; LINE-HEIGHT: 150%; PADDING-TOP: 6px; BORDER-BOTTOM: #ffcc00 1px solid
}
.title {
	PADDING-RIGHT: 16px; PADDING-LEFT: 10px; FONT-WEIGHT: bold; FONT-SIZE: 14px; BACKGROUND: #ff7300; PADDING-BOTTOM: 5px; BORDER-LEFT: #666677 10px solid; COLOR: #ffffff; PADDING-TOP: 8px; BORDER-BOTTOM: #cc6600 1px solid
}
.title-2 {
	BORDER-RIGHT: #ffb270 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #ffb270 1px solid; PADDING-LEFT: 8px; FONT-SIZE: 14px; BACKGROUND: #ffd0a8; PADDING-BOTTOM: 2px; BORDER-LEFT: #ffb270 1px solid; COLOR: #993300; LINE-HEIGHT: 150%; PADDING-TOP: 3px; BORDER-BOTTOM: #ffb270 1px solid
}
.title-gray {
	PADDING-RIGHT: 8px; PADDING-LEFT: 8px; FONT-SIZE: 14px; BACKGROUND: #666677; PADDING-BOTTOM: 3px; BORDER-LEFT: #ff7300 10px solid; COLOR: #ffffff; LINE-HEIGHT: 150%; PADDING-TOP: 4px; BORDER-BOTTOM: #333333 1px solid
}
.title-gray-2 {
	BORDER-RIGHT: #b6b6b6 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #b6b6b6 1px solid; PADDING-LEFT: 8px; FONT-SIZE: 14px; BACKGROUND: #dddddd; PADDING-BOTTOM: 2px; BORDER-LEFT: #b6b6b6 1px solid; COLOR: #666666; LINE-HEIGHT: 150%; PADDING-TOP: 3px; BORDER-BOTTOM: #b6b6b6 1px solid
}
.title-black {
	PADDING-RIGHT: 8px; PADDING-LEFT: 8px; FONT-SIZE: 14px; BACKGROUND: #ff0000; PADDING-BOTTOM: 2px; COLOR: #ffff00; LINE-HEIGHT: 150%; PADDING-TOP: 3px; HEIGHT: 30px
}
.listMT {
	BORDER-RIGHT: #ffffff 1px solid; PADDING-RIGHT: 4px; BORDER-TOP: #ffffff 1px solid; PADDING-LEFT: 4px; FONT-SIZE: 12px; PADDING-BOTTOM: 2px; COLOR: #e16602; PADDING-TOP: 6px; BORDER-BOTTOM: #ffd0a8 1px solid; HEIGHT: 25px; BACKGROUND-COLOR: #ffe5ce
}
.listMB {
	BORDER-RIGHT: #ffe5ce 1px solid; PADDING-RIGHT: 4px; BORDER-TOP: #ffffff 2px solid; PADDING-LEFT: 4px; FONT-SIZE: 12px; PADDING-BOTTOM: 2px; COLOR: #000000; LINE-HEIGHT: 150%; PADDING-TOP: 6px; BORDER-BOTTOM: #ffd0a8 1px solid; HEIGHT: 35px
}
.listMT-gray {
	BORDER-RIGHT: #ffffff 1px solid; PADDING-RIGHT: 4px; BORDER-TOP: #ffffff 1px solid; PADDING-LEFT: 4px; FONT-SIZE: 12px; PADDING-BOTTOM: 2px; COLOR: #666666; PADDING-TOP: 6px; BORDER-BOTTOM: #dcdcdc 1px solid; HEIGHT: 25px; BACKGROUND-COLOR: #eeeeee
}
.listMB-gray {
	BORDER-RIGHT: #dcdcdc 1px solid; PADDING-RIGHT: 4px; BORDER-TOP: #ffffff 2px solid; PADDING-LEFT: 4px; FONT-SIZE: 12px; PADDING-BOTTOM: 2px; COLOR: #000000; LINE-HEIGHT: 150%; PADDING-TOP: 6px; BORDER-BOTTOM: #dcdcdc 1px solid; HEIGHT: 35px
}
.txtNextPage {
	PADDING-RIGHT: 4px; PADDING-LEFT: 4px; FONT-SIZE: 12px; PADDING-BOTTOM: 2px; LINE-HEIGHT: 150%; PADDING-TOP: 4px; HEIGHT: 30px; TEXT-ALIGN: center
}
.nav-tabsub {
	BORDER-RIGHT: #7c7cca 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #7c7cca 1px solid; PADDING-LEFT: 8px; FONT-SIZE: 12px; BACKGROUND: #ffffff; PADDING-BOTTOM: 0px; BORDER-LEFT: #7c7cca 1px solid; COLOR: #993300; LINE-HEIGHT: 150%; PADDING-TOP: 1px; BORDER-BOTTOM: #7c7cca 1px solid
}
.nav-tabsubhot {
	BORDER-RIGHT: #ffffff 1px solid; PADDING-RIGHT: 8px; BORDER-TOP: #ffffff 1px solid; PADDING-LEFT: 8px; FONT-SIZE: 12px; BACKGROUND: #7c7cca; PADDING-BOTTOM: 0px; BORDER-LEFT: #ffffff 1px solid; COLOR: #ffffff; LINE-HEIGHT: 150%; PADDING-TOP: 1px; BORDER-BOTTOM: #ffffff 1px solid
}
.navToolbar {
	BORDER-RIGHT: #ff9966 1px solid; PADDING-RIGHT: 13px; BORDER-TOP: #ff9966 1px solid; PADDING-LEFT: 10px; FONT-SIZE: 12px; PADDING-BOTTOM: 4px; VERTICAL-ALIGN: middle; BORDER-LEFT: #ff9966 4px solid; PADDING-TOP: 4px; BORDER-BOTTOM: #ff9966 1px solid; BACKGROUND-COLOR: #fff
}
.navToolbarHot {
	PADDING-RIGHT: 16px; PADDING-LEFT: 10px; FONT-SIZE: 12px; BACKGROUND: #ff7300; PADDING-BOTTOM: 5px; BORDER-LEFT: #666677 10px solid; COLOR: #ffffff; PADDING-TOP: 6px; BORDER-BOTTOM: #cc6600 1px solid
}
.txtYouhere-tab {
	PADDING-LEFT: 3px; FONT-SIZE: 12px; COLOR: #999999; LINE-HEIGHT: 130%
}
.nav-link:link {
	COLOR: #3d362b
}
.nav-link:visited {
	COLOR: #3d362b
}
.nav-link:hover {
	COLOR: #f60
}
.nav-left {
	PADDING-RIGHT: 0px; BORDER-TOP: #ffffff 2px solid; PADDING-LEFT: 10px; FONT-SIZE: 14px; BACKGROUND: #eeeeff; PADDING-BOTTOM: 2px; BORDER-LEFT: #ff7300 3px solid; WIDTH: 180px; COLOR: #ffffff; PADDING-TOP: 3px; BORDER-BOTTOM: #ccccee 1px solid; HEIGHT: 28px
}
.nav-lefthot {
	PADDING-RIGHT: 0px; PADDING-LEFT: 10px; FONT-WEIGHT: bold; FONT-SIZE: 14px; BACKGROUND: #ff7300; PADDING-BOTTOM: 2px; BORDER-LEFT: #666677 4px solid; WIDTH: 180px; COLOR: #ffffff; PADDING-TOP: 6px; BORDER-BOTTOM: #cc6600 1px solid; HEIGHT: 28px
}
.nav-lefthot-w-b:link {
	COLOR: #ffffff
}
.nav-lefthot-w-b:visited {
	COLOR: #ffffff
}
.nav-lefthot-w-b:hover {
	COLOR: #ffffff
}
.nav-pagebott {
	PADDING-RIGHT: 8px; BORDER-TOP: #eeeedd 4px solid; PADDING-LEFT: 8px; FONT-SIZE: 12px; PADDING-BOTTOM: 16px; LINE-HEIGHT: 150%; PADDING-TOP: 40px
}
.nav-setup {
	BORDER-RIGHT: #eeeedd 0px solid; PADDING-RIGHT: 5px; PADDING-LEFT: 3px; FONT-SIZE: 12px; PADDING-BOTTOM: 1px; WIDTH: 25%; COLOR: #666666; PADDING-TOP: 5px; BORDER-BOTTOM: #eeeedd 3px solid; BACKGROUND-COLOR: #ffffff
}
.nav-setupto {
	BORDER-RIGHT: #ff9966 0px solid; PADDING-RIGHT: 5px; PADDING-LEFT: 3px; FONT-SIZE: 12px; PADDING-BOTTOM: 1px; WIDTH: 25%; COLOR: #000000; PADDING-TOP: 5px; BORDER-BOTTOM: #ff9966 3px solid; BACKGROUND-COLOR: #fff6f0
}
.nav-tab {
	BORDER-RIGHT: #ff9966 1px solid; PADDING-RIGHT: 10px; BORDER-TOP: #ff7300 3px solid; PADDING-LEFT: 10px; FONT-SIZE: 12px; PADDING-BOTTOM: 4px; VERTICAL-ALIGN: middle; BORDER-LEFT: #ff9966 1px solid; COLOR: #000000; PADDING-TOP: 4px; BORDER-BOTTOM: #ff9966 0px solid; BACKGROUND-COLOR: #ffffff
}
.nav-tabhot {
	BORDER-RIGHT: #ff9966 1px solid; PADDING-RIGHT: 10px; BORDER-TOP: #666677 3px solid; PADDING-LEFT: 10px; FONT-SIZE: 12px; PADDING-BOTTOM: 4px; BORDER-LEFT: #ff9966 1px solid; COLOR: #ffffff; PADDING-TOP: 4px; BACKGROUND-COLOR: #ff7300
}
.form-left {
	PADDING-RIGHT: 3px; PADDING-LEFT: 3px; FONT-SIZE: 14px; PADDING-BOTTOM: 3px; VERTICAL-ALIGN: top; WIDTH: 25%; LINE-HEIGHT: 150%; PADDING-TOP: 6px; TEXT-ALIGN: right
}
.form-right {
	PADDING-RIGHT: 3px; PADDING-LEFT: 3px; FONT-SIZE: 14px; PADDING-BOTTOM: 3px; VERTICAL-ALIGN: top; LINE-HEIGHT: 150%; PADDING-TOP: 6px
}
.form-right tbody td {padding:0 9px 10px 0; position:relative;}

.form-right tbody td img { padding:0 0 0 3px;}

.form-star {
	PADDING-RIGHT: 0px; PADDING-LEFT: 3px; FONT-SIZE: 12px; PADDING-BOTTOM: 3px; VERTICAL-ALIGN: top; WIDTH: 1%; COLOR: #ff0000; PADDING-TOP: 12px
}
.form-left-top {
	PADDING-RIGHT: 3px; BORDER-TOP: #eeeedd 1px solid; PADDING-LEFT: 3px; FONT-SIZE: 14px; PADDING-BOTTOM: 3px; VERTICAL-ALIGN: top; WIDTH: 25%; LINE-HEIGHT: 150%; PADDING-TOP: 6px; TEXT-ALIGN: right
}
.form-right-top {
	PADDING-RIGHT: 3px; BORDER-TOP: #eeeedd 1px solid; PADDING-LEFT: 3px; FONT-SIZE: 14px; PADDING-BOTTOM: 3px; VERTICAL-ALIGN: top; LINE-HEIGHT: 150%; PADDING-TOP: 6px
}
.form-star-top {
	PADDING-RIGHT: 0px; BORDER-TOP: #eeeedd 1px solid; PADDING-LEFT: 3px; FONT-SIZE: 12px; PADDING-BOTTOM: 3px; VERTICAL-ALIGN: top; WIDTH: 1%; COLOR: #ff0000; PADDING-TOP: 6px
}
.form-input {
	FONT-SIZE: 14px; WIDTH: 180px; HEIGHT: 25px
}
.form-input-err {
	FONT-SIZE: 14px; WIDTH: 180px; HEIGHT: 25px; BACKGROUND-COLOR: #eeeeff
}
.form-input-small {
	FONT-SIZE: 14px; WIDTH: 100px; HEIGHT: 25px
}
.form-input-big {
	FONT-SIZE: 14px; WIDTH: 260px; HEIGHT: 25px
}
.form-input-big-err {
	FONT-SIZE: 14px; WIDTH: 260px; HEIGHT: 25px; BACKGROUND-COLOR: #eeeeff
}
.form-select {
	FONT-SIZE: 14px; WIDTH: 180px
}
.form-select-err {
	FONT-SIZE: 14px; WIDTH: 180px; BACKGROUND-COLOR: #eeeeff
}
.form-select-big {
	FONT-SIZE: 14px; WIDTH: 300px
}
.form-select-big-err {
	FONT-SIZE: 14px; WIDTH: 260px; BACKGROUND-COLOR: #eeeeff
}
.form-textarea-err {
	FONT-SIZE: 14px; BACKGROUND-COLOR: #eeeeff
}
.form-button-next {
	PADDING-RIGHT: 3px; BORDER-TOP: #eeeedd 1px solid; PADDING-LEFT: 3px; FONT-SIZE: 14px; PADDING-BOTTOM: 0px; PADDING-TOP: 8px; HEIGHT: 40px; TEXT-ALIGN: right
}
.form-button-replay {
	PADDING-RIGHT: 3px; BORDER-TOP: #eeeedd 1px solid; PADDING-LEFT: 3px; FONT-SIZE: 14px; PADDING-BOTTOM: 0px; WIDTH: 20%; PADDING-TOP: 8px; HEIGHT: 40px; TEXT-ALIGN: right
}
.form-button-ok {
	PADDING-RIGHT: 3px; BORDER-TOP: #eeeedd 1px solid; PADDING-LEFT: 3px; FONT-SIZE: 14px; PADDING-BOTTOM: 0px; PADDING-TOP: 8px; HEIGHT: 40px
}
.txt14 {
	FONT-SIZE: 14px; LINE-HEIGHT: 130%
}
.txt14-w-b:link {
	FONT-WEIGHT: bold; FONT-SIZE: 14px; COLOR: #ffffff
}
.txt14-w-b:visited {
	FONT-WEIGHT: bold; FONT-SIZE: 14px; COLOR: #ffffff
}
.txt14-w-b:hover {
	FONT-WEIGHT: bold; FONT-SIZE: 14px; COLOR: #ffffff
}
.txt14-kong {
	PADDING-LEFT: 28px; FONT-SIZE: 14px; LINE-HEIGHT: 130%
}
.txt12-w:link {
	FONT-SIZE: 12px; COLOR: #ffffff
}
.txt12-w:visited {
	FONT-SIZE: 12px; COLOR: #ffffff
}
.txt12-w:hover {
	FONT-SIZE: 12px; COLOR: #ffff00
}
.txt12 {
	FONT-SIZE: 12px; LINE-HEIGHT: 130%
}
.txt12-w-b:link {
	FONT-WEIGHT: bold; FONT-SIZE: 13px; COLOR: #ffffff
}
.txt12-w-b:visited {
	FONT-WEIGHT: bold; FONT-SIZE: 13px; COLOR: #ffffff
}
.txt12-w-b:hover {
	FONT-WEIGHT: bold; FONT-SIZE: 13px; COLOR: #ffffff
}
.txt-danger {
	FONT-SIZE: 14px; COLOR: #f00000; LINE-HEIGHT: 130%
}
.txt-TIME-s {
	LINE-HEIGHT: 130%; FONT-FAMILY: "Times New Roman"
}
.txt-TIME-b {
	FONT-SIZE: 36px; LINE-HEIGHT: 150%; FONT-FAMILY: "Times New Roman"
}
.note {
	PADDING-RIGHT: 3px; PADDING-LEFT: 8px; FONT-SIZE: 12px; PADDING-BOTTOM: 3px; LINE-HEIGHT: 130%; PADDING-TOP: 6px
}
.note-strong {
	PADDING-LEFT: 3px; FONT-SIZE: 12px; COLOR: #ff7300; LINE-HEIGHT: 130%
}
.note-help {
	PADDING-LEFT: 3px; FONT-SIZE: 12px; COLOR: #999999; LINE-HEIGHT: 130%
}
.note-danger {
	PADDING-RIGHT: 8px; PADDING-LEFT: 8px; FONT-SIZE: 12px; PADDING-BOTTOM: 6px; COLOR: #f00000; LINE-HEIGHT: 130%; PADDING-TOP: 6px
}
.note-14-strong {
	PADDING-LEFT: 3px; FONT-SIZE: 14px; COLOR: #ff7300; LINE-HEIGHT: 130%
}
FORM {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px
}

.res_mem_menu_l li A:link {color:#000;}
.mod_bd {
    display: table-cell;
    width:960px;
}
.note-help {
    color: #999999;
    font-size: 12px;
    line-height: 170%;
    padding-left: 3px;
	padding-bottom:10px;
}
.mod_hd h3 { padding:20px 0 10px 0; font-size:16px;}
</style>
<SCRIPT language=JavaScript>
<!--
  //校验输入框 -->
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

<!--
  //控制文字显示-->
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


</SCRIPT>
</HEAD>
<style>
<!--
#glowtext{
filter:glow(color=red,strength=2);
width:100%;
}
-->
</style>



<div id="container">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/left.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <div class="i_content">
    <div class="mod_kong id_mod_myorder">
      <div class="mod_hd">
        <h3>在线支付</h3>
      </div>
      <div class="mod_bd">
        <div class="mod_cont status_table_on">
          <TABLE cellSpacing=0 cellPadding=0 width=960 border=0>
			  <TBODY>
			  <TR>
			    <TD class=title>支付宝即时到帐付款快速通道</TD>
			  </TR></TBODY>
			</TABLE><BR>
			<FORM name=alipayment onSubmit="return CheckForm();" action="/pay/alipay/alipayto.php" method="post">
			<table>
			 <tr>
			   <td>
			     <TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
			        <TR>
			          <TD class=form-left>收款方： </TD>
			          <TD class=form-star>* </TD>
			          <TD class=form-right>飞刀鱼</TD>
			        </TR>
			        <TR>
			          <TD colspan="3" align="center"><HR width=720 SIZE=2 color="#999999"></TD>
			        </TR>
			        <TR>
			          <TD class=form-left>标题： </TD>
			          <TD class=form-star>* </TD>
			          <TD class=form-right>订单<?php echo $this->_tpl_vars['log']['order_id']; ?>
 <INPUT type="hidden" size=30 name=aliorder maxlength="200" value="<?php echo $this->_tpl_vars['log']['order_id']; ?>
"/></TD>
			        </TR>
			        <TR>
			          <TD class=form-left>付款金额： </TD>
			          <TD class=form-star>*</TD>
			          <TD class=form-right><?php echo ((is_array($_tmp=$this->_tpl_vars['log']['totprice'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
元 <INPUT type="hidden" onkeypress="return regInput(this,/^\d*\.?\d{0,2}$/,String.fromCharCode(event.keyCode))"  onpaste="return regInput(this,/^\d*\.?\d{0,2}$/,window.clipboardData.getData('Text'))" ondrop="return regInput(this,/^\d*\.?\d{0,2}$/,&#9;event.dataTransfer.getData('Text'))" maxLength=10 size=30 name=alimoney  onfocus="if(Number(this.value)==0){this.value='';}" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['log']['totprice'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
"/></TD>
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
			               <table>
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
			          <TD class=form-right><INPUT type=image
			            src="/images/bank/button_sure.gif" value=确认订单
			            name=nextstep></TD>
			        </TR>
			</TABLE>
			   </td>
			   <td vAlign=top width=205 style="font-size:12px;font-family:'宋体'">
			   <span id="glowtext">小贴士：</span>
			   <fieldset>
			      <P class=STYLE1>本通道为<a href="/" target="_blank"><strong>飞刀鱼</strong></a>客户专用，采用支付宝付款。请在支付前与本网站达成一致。</P>
			      <P class="style2">请务必与<a href="/" target="_blank"><strong>飞刀鱼</strong></a>确认好订单和货款后，再付款。可以在快速付款通道里的“标题”、“订单金额”、“付款方”和备注中填入相应的订单信息。</P>
			      <P class="style2 style3">&nbsp;</P>
			      </fieldset>
			   </td>
			 </tr>
			</table>

			</FORM>
			<div style="padding-top:20px; "></div>
			<TABLE cellSpacing=1 width=760 border=0 style="text-align:center;">
			  <TR>
			    <TD style="line-height:23px;"><FONT class=note-help>如果您点击“购买”按钮，即表示您已经接受“支付宝服务协议”，同意向卖家购买此物品。
			      <BR>
			      您有责任查阅完整的物品登录资料，包括卖家的说明和接受的付款方式。卖家必须承担物品信息正确登录的责任！
			  </FONT>
			 </TD>
			 </TR>
			</TABLE>

			<TABLE cellSpacing=0 cellPadding=0 width=760 align=center border=0>
			  <TR align=middle>
			    <TD class="txt12 lh15" style="padding:5px 0;"><A href="http://china.alibaba.com/"
			      target=_blank>阿里巴巴旗下公司</A> | 支付宝版权所有 2004-2012</TD>
			  </TR>
			  <TR align=middle>
			    <TD class="txt12 lh15"><IMG alt="支付宝通过“国际权威安全认证” "
			      src="/images/bank/logo_vbvv.gif" style="padding:5px 0;" border=0><br />支付宝通过“国际权威安全
			  认证”

			    </TD>
			  </TR>
			</TABLE>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
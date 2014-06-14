<?php /* Smarty version 2.6.7, created on 2012-07-27 19:04:21
         compiled from default/services.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'default/services.tpl', 11, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="container">
  <div class="wrapper mt32 mb23">
    <div class="wrapper_t"></div>
    <div class="wrapper_c con">
      <h1>服务与支持</h1>
      <p class="summary_concent" style="padding:0 53px 30px 53px;">海大软件团队创建于2006年,由三名资深留美技术人员回国创办,并与2009年正式成立公司开始商业化运作。海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。我们以成熟的产品、专业的技术和热诚服务态度为客户提供优质信息系统，协助企业实现管理系统信息化、智能化，提高企业效率，增强企业核心竞争力，让我们与客户一起成长。</p>
      <ul class="pic ml_25">
      <?php if (count($_from = (array)$this->_tpl_vars['logs'])):
    foreach ($_from as $this->_tpl_vars['data']):
?>
        <li><img src="/images/img01.jpg"/>
          <h2><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 12, "UTF-8") : smarty_modifier_truncate($_tmp, 12, "UTF-8")); ?>
</h2>
          <p><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['content'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 150, "UTF-8") : smarty_modifier_truncate($_tmp, 150, "UTF-8")); ?>
</p>
        </li>
        <?php endforeach; endif; unset($_from); ?>
        <!--<li><img src="/images/img01.jpg"/>
          <h2>移动界面设计</h2>
          <p>海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。</p>
        </li>
        <li><img src="/images/img01.jpg"/>
          <h2>移动界面设计</h2>
          <p>海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。</p>
        </li>
        <li><img src="/images/img01.jpg"/>
          <h2>移动界面设计</h2>
          <p>海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。</p>
        </li>
        <li><img src="/images/img01.jpg"/>
          <h2>移动界面设计</h2>
          <p>海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。</p>
        </li>
        <li><img src="/images/img01.jpg"/>
          <h2>移动界面设计</h2>
          <p>海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。</p>
        </li>
        <li><img src="/images/img01.jpg"/>
          <h2>移动界面设计</h2>
          <p>海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。</p>
        </li>
        <li><img src="/images/img01.jpg"/>
          <h2>移动界面设计</h2>
          <p>海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。</p>
        </li>
        <li><img src="/images/img01.jpg"/>
          <h2>移动界面设计</h2>
          <p>海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。</p>
        </li>
        <li><img src="/images/img01.jpg"/>
          <h2>移动界面设计</h2>
          <p>海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。</p>
        </li>
        <li><img src="/images/img01.jpg"/>
          <h2>移动界面设计</h2>
          <p>海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。</p>
        </li>
        <li><img src="/images/img01.jpg"/>
          <h2>移动界面设计</h2>
          <p>海大软件早期定位于展示和实践梦想，基于互联网提供简单实用的应用解决方案。公司以高效率、高素质团队的自我发展为基础，致力于为客户提供高附加值软件服务和解决方案。</p>
        </li>-->
        <div class="clear"></div>
      </ul>
    </div>
    <div class="wrapper_b"></div>
  </div>
  <div  class="three">
    <div class="threeup"> <img class="fr" src="/images/module_selfservice.png" alt=""/>
      <h2>自助服务</h2>
      <p> 使用我们的 <a href="">在线服务助理</a> 查看您所有的服务选项并安排维修。 </p>
      <div class="divider"></div>
      <ul>
        <li> <a href="" class="">查看服务和支持范围</a> </li>
        <li> <a href="" class="">查看维修状态</a> </li>
        
      </ul>
    </div>
    <div class="threeup" style="margin-left:12px">
      <h2>联系我们</h2>
      <p style="margin-bottom:10px;"> 了解您可以获取 海大 产品的支持和服务的所有方式。 <a href="/contact" class="" >从这里开始</a> </p>
      <img src="/images/module_contactus.png" alt=""/> </div>
    <div class="threeup"  style="margin-left:12px;">
      <div class="threeup_r"> <img class="applecare" src="/images/module_applecare.png" /> 
        <h2>AppleCare</h2>
        <p>Apple 产品的扩展支持范围。 </p>
        <ul>
          <li> <a href="" class="">深入了解</a> </li>
          <li> <a href="" class="">注册 AppleCare 协议</a> </li>
        </ul>
     </div>
    </div>
  </div>
  <div class="wrapper mb23">
    <div class="wrapper_t"></div>
    <div class="wrapper_c">
      <div class="column first fl ">
        <h2>更换和维修扩展计划</h2>
        <p>查看当前计划的详细信息。</p>
        <ul>
          <li><a href="">iPod nano（第 1 代）更换计划</a></li>
          <li><a href="">iMac 1TB Seagate 硬盘驱动器更换计划</a></li>
          <li><a href="">所有计划</a></li>
        </ul>
      </div>
      <div class="column last fl">
        <h2>其他资源</h2>
        <ul>
          <li> <a href="">Apple ID 支持</a></li>
          <li><a href="">Apple ID 支持</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="wrapper_b"></div>
  </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
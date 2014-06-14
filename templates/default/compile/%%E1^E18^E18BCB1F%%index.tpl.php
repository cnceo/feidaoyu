<?php /* Smarty version 2.6.7, created on 2012-09-03 14:01:52
         compiled from ask/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'ask/index.tpl', 42, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="question-header">
   <img class="question_image" src="/images/top_01_03.png" width="154" height="48" />
   <input name="" type="text" class="question_text"/>
   <a class="question_button" href="">找答案</a>
   <a class="question_button" href="">提问题</a>
</div>
<div class="question-main">
   <div class="question-main-l">
      <div class="question-main-block-t">
         <h3><a href="" class="topic_classified">问题分类</a></h3>
         <ul>
          <?php $this->_foreach['i'] = array('total' => count($_from = (array)$this->_tpl_vars['catelist']), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
            <li><a href=""><span><?php echo $this->_tpl_vars['data']['cname']; ?>
</span></a><br />
            <?php $this->_foreach['i'] = array('total' => count($_from = (array)$this->_tpl_vars['data']['child']), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data1']):
        $this->_foreach['i']['iteration']++;
?>
            <a href=""><?php echo $this->_tpl_vars['data1']['cname']; ?>
</a>
            <?php endforeach; endif; unset($_from); ?>
            </li>
          <?php endforeach; endif; unset($_from); ?>

            <li><a href=""><em>更多分类》</em></a></li>
         </ul>
      </div>
      <div class="question-main-block-c">
         <h3><a href="" class="special-subject">问答专题</a></h3>
          <ul>
              <li><a href=""><span class="block13">1</span><p class="block14">onkvaKeSbtseBPg</p></a><div class="clear"></div></li>
              <li><a href=""><span class="block13">2</span><p class="block14">pkRteCemgqpMNv</p></a><div class="clear"></div></li>
              <li><a href=""><span class="block13">3</span><p class="block14">ofGtItpiq</p></a><div class="clear"></div></li>
              <li><a href=""><span class="block13-1">4</span><p class="block14">GTMYuCZtAlpIO</p></a><div class="clear"></div></li>
              <li><a href=""><span class="block13-1">5</span><p class="block14">ZvbDtifoYK</p></a><div class="clear"></div></li>
              <li><a href=""><span class="block13-1">6</span><p class="block14">牟定化湖雅墅</p></a><div class="clear"></div></li>
              <li><a href=""><span class="block13-1">7</span><p class="block14"> ZGjHHWmoWFbhf</p></a><div class="clear"></div></li>
              <div class="clear"></div>
          </ul>
       </div>

        <div class="question-main-block-b">
             <h3><a href="" class="topic_hot">最热问答</a></h3>
             <ul>
             <?php $this->_foreach['i'] = array('total' => count($_from = (array)$this->_tpl_vars['hot']), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
                <li><span>·</span><a href="" title="<?php echo $this->_tpl_vars['data']['title']; ?>
" target="_blank"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 24, "UTF-8", "") : smarty_modifier_truncate($_tmp, 24, "UTF-8", "")); ?>
</a></li>
                <?php endforeach; endif; unset($_from); ?>
             </ul>
       </div>

        <div class="question-main-block-b">
             <h3><a href="" class="topic_newest">最新问答</a></h3>
             <ul>
              <?php $this->_foreach['i'] = array('total' => count($_from = (array)$this->_tpl_vars['newask']), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
                <li><span>·</span><a href="" title="<?php echo $this->_tpl_vars['data']['title']; ?>
" target="_blank"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 24, "UTF-8", "") : smarty_modifier_truncate($_tmp, 24, "UTF-8", "")); ?>
</a></li>
                <?php endforeach; endif; unset($_from); ?>
             </ul>
       </div>
   </div>
   <div class="question-main-c">
         <div class="question-main-block2">
             <div class="title_Mod">
                  <h2><a href="" class="recommend">推荐问题</a></h2>
                  <div class="hda_more"><a href=""></a></div>
             </div>
             <div class="question-main-c-l"><img src="/images/Hda_edu_81.jpg" width="145" height="100" /></div>
             <div class="question-main-c-r">
                <ul>
                <?php $this->_foreach['i'] = array('total' => count($_from = (array)$this->_tpl_vars['recommend']), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
                   <li><a href=""><?php echo $this->_tpl_vars['data']['title']; ?>
</a><a href=""><span>[意见建议]</span></a></li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
             </div>
             <div class="clear"></div>
          </div>

          <div class="question-main-block2">
              <div class="title_Mod">
                  <h2><a href="" class="wait">待解决问题</a></h2>
                  <div class="hda_more"><a href=""></a></div>
             </div>
             <ul>
             <?php $this->_foreach['i'] = array('total' => count($_from = (array)$this->_tpl_vars['notsolvel']), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
                <li><span class="block15"><?php echo $this->_foreach['i']['iteration']; ?>
</span><a href="" target="_blank"><p class="block14"><?php echo $this->_tpl_vars['data']['title']; ?>
<span>[意见建议]</span></p></a><div class="clear"></div></li>
                <?php endforeach; endif; unset($_from); ?>
                <div class="clear"></div>
            </ul>
          </div>

          <div class="question-main-block2">
              <div class="title_Mod">
                  <h2><a href="" class="complete">已解决问题</a></h2>
                  <div class="hda_more"><a href=""></a></div>
             </div>
             <ul>
             <?php $this->_foreach['i'] = array('total' => count($_from = (array)$this->_tpl_vars['solve']), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
                <li><span class="block15"><?php echo $this->_foreach['i']['iteration']; ?>
</span><a href="" target="_blank"><p class="block14"><?php echo $this->_tpl_vars['data']['title']; ?>
<span>[意见建议]</span></p></a><div class="clear"></div></li>
                <?php endforeach; endif; unset($_from); ?>

                <div class="clear"></div>
            </ul>
          </div>

          <div class="question-main-block2">
              <div class="title_Mod">
                  <h2><a href="" class="emergency">紧急问题</a></h2>
                  <div class="hda_more"><a href=""></a></div>
             </div>
             <ul>
              <?php $this->_foreach['i'] = array('total' => count($_from = (array)$this->_tpl_vars['urgent']), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
                <li><a href=""><span class="block15"><?php echo $this->_foreach['i']['iteration']; ?>
</span><p class="block14"><?php echo $this->_tpl_vars['data']['title']; ?>
<span>[意见建议]</span></p></a><div class="clear"></div></li>
                 <?php endforeach; endif; unset($_from); ?>
                <div class="clear"></div>
            </ul>
          </div>

   </div>
   <div class="question-main-r">
       <div class="question-main-block-b">
             <h3><a href="" class="topic_wtzx">问答咨询</a></h3>
             <ul>
                <li><span>·</span><a href="">试一下，看看怎么样</a></li>
                <li><span>·</span><a href="">kPuLlzqHXoGwV</a></li>
                <li><span>·</span><a href="">aHgmRENrCEqfMG</a></li>
                <li><span>·</span><a href="">TuUIMhYkyhMkEOaTP</a></li>
                <li><span>·</span><a href="">bmPiLneiUYmFczHw</a></li>
                <li><span>·</span><a href="">PeFtvdWTgkeO</a></li>
             </ul>
       </div>

       <div class="question-main-block-b">
             <h3><a href="" class="topic_expert">专家</a></h3>

       </div>

       <div class="question-main-block-b">
             <div class="question-main-block-b-menu">
                  <ul class="label">
                      <li><a href="">问题排行</a></li>
                      <li><a href="">回答排行</a></li>
                       <div class="clear"></div>
                  </ul>
              </div>
             <ol>
                <li><span>1</span><a href="">admin</a></li>
                <li><span>2</span><a href="">杨菊莲</a></li>
                <li><span>3</span><a href="">18627950280</a></li>
                <li><span>4</span><a href="">lucy</a></li>
                <li><span>5</span><a href="">cqmei123</a></li>
                <li><span>6</span><a href="">huhangzhe</a></li>
                <li><span>7</span><a href="">jianfei</a></li>
                <li><span>8</span><a href=""> vipvvp</a></li>
                <li><span>9</span><a href="">jfaf12</a></li>
                <li><span>10</span><a href="">a1258771</a></li>
             </ol>
       </div>

       <div class="question-main-block-b">
             <h3><a href="" class="topic_label">标签</a></h3>
             <ul>
                <li><span>·</span><a href="">试一下，看看怎么样</a></li>
                <li><span>·</span><a href="">kPuLlzqHXoGwV</a></li>
                <li><span>·</span><a href="">aHgmRENrCEqfMG</a></li>
                <li><span>·</span><a href="">TuUIMhYkyhMkEOaTP</a></li>
                <li><span>·</span><a href="">bmPiLneiUYmFczHw</a></li>
                <li><span>·</span><a href="">PeFtvdWTgkeO</a></li>
             </ul>
       </div>

       <div class="question-main-block-b">
             <h3><a href="" class="topic_test">测试</a></h3>

       </div>

   </div>
   <div class="clear"></div>
</div>




































<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "global/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
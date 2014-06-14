

<div class="suc_content">
  <div class="suc_kuang">
    <div class="hei_513">
      <div class="info">
        <span class="left_name">
          <span class="m_name"><a class="color_33" href="/">小米账户</a>&nbsp;&nbsp;&gt;</span>
          <span class="m_func">重设账户密码</span>
        </span>
      </div>
      <form action="/pass/changePassword" method="post" id="changePwdForm">
        <div class="new_pwd">
          <!--<p class="p_tips new_tips">请重设您的账户密码</p>-->
          <table class="reset_pwd">
            <tbody><tr>
              <td class="td1">&#12288;原密码：</td>
              <td><input type="password" name="oldpassword" isrequired="true" class="input_kuang new_width item errortip" id="txtPwd" >
                <span id="emailCode" class="check_tips empty_tip">请输入原密码</span>
                <!-- <span class="succ_tips"></span> -->
              </td>
            </tr>
            <tr>
              <td class="td1">&#12288;新密码：</td>
              <td>
              <div id="pwdTd" class="td2">
                  <input type="password" name="password" id="pwd" isrequired="true" class="input_kuang new_width item errortip">
                  <span class="prompt_info change_info">密码长度为6~16位字符，由数字和字母组成</span>
                </div>
              </td>
            </tr>
            <tr>
              <td class="td1">确认密码：</td>
              <td><input type="password" name="password2" class="input_kuang new_width item errortip" mjs="13470085613034"><span class="check_tips repeat_tip">密码输入不一致</span><span class="check_tips empty_tip">请输入确认密码</span><span class="succ_tips"></span></td>
            </tr>
          </tbody>
          </table>
          <div class="sub_bg marl_170">
            <input type="submit" value="提交" class="no_bg">
          </div>
        </div>
      </form>
    </div>
  <div class="suc_botm"></div><!--这部分是卷角效果-->
  </div>
</div>



<div id="mastheadholder">
  <div id="masthead">
    <div id="logo">
      <img src="images/logo.png" height="132" />
    </div>
    <div id="storeinfo">
      <table cellpadding="0" cellspacing="5">
        <tbody>
          <tr>
            <td align="left"><b>Current User :</b>&nbsp;&nbsp;<span id="headerControl_lblCashierName" style="display: inline-block; border-style: none;"><?php echo $this->session->userdata('full_name'); ?></span></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="topnav">
      <ul>
        <?php if($privileges['sales_main']==1){ ?>
        <li><a href="sales" <?php if($menu=='sales'){ ?>class="current"<?php } ?>>Sales</a></li>
        <?php
          }
          if($privileges['accounts']==1){
        ?>
        <li><a href="accounts" <?php if($menu=='accounts'){ ?>class="current"<?php } ?>>Accounts</a></li>
        <?php
          }
          if($privileges['settings']==1){
        ?>
        <li><a href="settings" <?php if($menu=='settings'){ ?>class="current"<?php } ?>>Settings</a></li>
        <?php
          }
          if($privileges['reports']==1){
        ?>
        <li><a href="reports" <?php if($menu=='reports'){ ?>class="current"<?php } ?>>Reports</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
<div id="site">
  <div id="content_2_column">
    <?php $this->load->view('admin/settings/sub_menu'); ?>
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">User Privilege</h1>
      </div>

      <?php $this->load->view('admin/settings/left'); ?>

      <div id="ManagerWorkArea">
        <div style="overflow: scroll;" id="mgrFullChannel">
          <?php echo form_open('settings/user_privileges'); ?>
          <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
            <tbody>
              <tr>
                <th colspan="4" align="center">User Privileges of <?php echo $ref_user['full_name']; ?></th>
              </tr>
              <tr>
                <th colspan="4">Sales Option</th>
              </tr>
              <tr>
                <td width="70"><b>Sales</b></td>
                <td width="50">
                  <select name="sales_main">
                    <option value="0" <?php if($privileges){ if($privileges['sales_main']==0){ echo 'selected'; } }?>>No</option>
                    <option value="1" <?php if($privileges){ if($privileges['sales_main']==1){ echo 'selected'; } }?>>Yes</option>
                  </select>
                </td>
                <td width="70"><b>Setup</b></td>
                <td>
                  <select name="sales_setup">
                    <option value="0" <?php if($privileges){ if($privileges['sales_setup']==0){ echo 'selected'; } }?>>No</option>
                    <option value="1" <?php if($privileges){ if($privileges['sales_setup']==1){ echo 'selected'; } }?>>Yes</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th colspan="4">Accounts Option</th>
              </tr>
              <tr>
                <td><b>Accounts</b></td>
                <td colspan="3">
                  <select name="accounts">
                    <option value="0" <?php if($privileges){ if($privileges['accounts']==0){ echo 'selected'; } }?>>No</option>
                    <option value="1" <?php if($privileges){ if($privileges['accounts']==1){ echo 'selected'; } }?>>Yes</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th colspan="4">Settings Option</th>
              </tr>
              <tr>
                <td><b>Settings</b></td>
                <td colspan="3">
                  <select name="settings">
                    <option value="0" <?php if($privileges){ if($privileges['settings']==0){ echo 'selected'; } }?>>No</option>
                    <option value="1" <?php if($privileges){ if($privileges['settings']==1){ echo 'selected'; } }?>>Yes</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th colspan="4">Reports Option</th>
              </tr>
              <tr>
                <td><b>Reports</b></td>
                <td colspan="3">
                  <select name="reports">
                    <option value="0" <?php if($privileges){ if($privileges['reports']==0){ echo 'selected'; } }?>>No</option>
                    <option value="1" <?php if($privileges){ if($privileges['reports']==1){ echo 'selected'; } }?>>Yes</option>
                  </select>
                </td>
              </tr>
              <tr class="bg">
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
                <th align="center" colspan="4"><input type="submit" name="submit" value="Save Privilege" /></th>
              </tr>
            </tbody>
          </table>
          <?php
            echo form_hidden('ref_user', $ref_user['id']);
            echo form_close();
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
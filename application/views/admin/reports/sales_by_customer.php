<div id="site">
  <div id="content_2_column">
    <?php $this->load->view('admin/reports/sub_menu'); ?>
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Sales by Customer</h1>
      </div>

      <?php $this->load->view('admin/reports/left'); ?>

      <div id="ManagerWorkArea">
        <div style="overflow: scroll;" id="mgrFullChannel">
          <?php echo form_open('reports/sales_by_customer'); ?>
          <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
            <tbody>
              <tr>
                <th colspan="4">&nbsp;</th>
              </tr>
              <tr>
                <td width="120"><b>Select Customer :</b></td>
                <td colspan="3">
                  <select name="customer_id" style="width: 171px;">
                    <option value="all">All Customer</option>
                    <?php foreach ($customers as $key => $value) { ?>
                      <option value="<?php echo $value['code']; ?>"><?php echo $value['name']; ?></option>
                    <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>Start Date</strong></td>
                <td style="padding-left: 5px; text-align: left;"><input type="text" class="jq_date" name="s_date" value="<?php echo date('Y-m-01'); ?>" style="width: 170px;" /></td>
                <td><strong>End Date</strong></td>
                <td><input type="text" class="jq_date" name="e_date" value="<?php echo date('Y-m-t'); ?>" style="width: 170px;" /></td>
              </tr>
              <tr class="bg">
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
                <th align="center" colspan="4"><input type="submit" name="submit" value="Show Report" /></th>
              </tr>
            </tbody>
          </table>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
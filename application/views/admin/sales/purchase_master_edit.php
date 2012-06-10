<div id="site">
  <div id="content_2_column">
    <?php $this->load->view('admin/sales/sub_menu'); ?>
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Purchase Master Edit</h1>
      </div>

      <?php $this->load->view('admin/sales/left'); ?>

      <div id="ManagerWorkArea">
        <div style="overflow: scroll;" id="mgrFullChannel">
          <?php echo form_open('sales_setup/purchase_master_edit', 'name="purchase_master" id="purchase_master"'); ?>
          <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
            <tbody>
              <tr>
                <th style="width: 70px;" scope="col">&nbsp;</th>
                <th style="width: 150px;" scope="col">&nbsp;</th>
                <th style="width: 70px;" scope="col">&nbsp;</th>
                <th style="width: 150px;" scope="col">&nbsp;</th>
              </tr>
              <tr>
                <td><strong>Purchase No</strong></td>
                <td><input name="purchase_no" value="<?php echo $purchase['purchase_no']; ?>" style="width: 230px;" /></td>
                <td><strong>Purchase Date</strong></td>
                <td><input type="text" class="jq_date" name="purchase_date" value="<?php echo $purchase['purchase_date']; ?>" style="width: 230px;" /></td>
              </tr>
              <tr>
                <td class="first" valign="top"><strong>Notes</strong></td>
                <td class="last" colspan="3"><textarea name="notes" style="width: 620px;"><?php echo $purchase['notes']; ?></textarea></td>
              </tr>
              <tr>
                <td align="center" colspan="4"><input type="submit" name="submit" value="Save &amp; Add Item" /></td>
              </tr>
            </tbody>
          </table>
          <?php
            echo form_hidden('id', $purchase['id']);
            echo form_close();
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  document.purchase_master.purchase_no.focus();
</script>
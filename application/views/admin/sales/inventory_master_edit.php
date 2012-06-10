<div id="site">
  <div id="content_2_column">
    <?php $this->load->view('admin/sales/sub_menu'); ?>
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Inventory Master Edit</h1>
      </div>

      <?php $this->load->view('admin/sales/left'); ?>

      <div id="ManagerWorkArea">
        <div style="overflow: scroll;" id="mgrFullChannel">
          <?php echo form_open('sales_setup/inventory_master_edit', 'name="inventory_master" id="inventory_master"'); ?>
          <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
            <tbody>
              <tr>
                <th style="width: 70px;" scope="col">&nbsp;</th>
                <th style="width: 150px;" scope="col">&nbsp;</th>
                <th style="width: 70px;" scope="col">&nbsp;</th>
                <th style="width: 150px;" scope="col">&nbsp;</th>
              </tr>
              <tr>
                <td><strong>Inventory No</strong></td>
                <td><input name="inventory_no" value="<?php echo $inventory['inventory_no']; ?>" readonly style="width: 230px;" /></td>
                <td><strong>Inventory Date</strong></td>
                <td><input type="text" class="jq_date" name="inventory_date" value="<?php echo $inventory['inventory_date']; ?>" style="width: 230px;" /></td>
              </tr>
              <tr>
                <td class="first" valign="top"><strong>Notes</strong></td>
                <td class="last" colspan="3"><textarea name="notes" style="width: 620px;"><?php echo $inventory['notes']; ?></textarea></td>
              </tr>
              <tr>
                <td align="center" colspan="4"><input type="submit" name="submit" value="Save &amp; Add Item" /></td>
              </tr>
            </tbody>
          </table>
          <?php
            echo form_hidden('id', $inventory['id']);
            echo form_close();
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  document.inventory_master.inventory_no.focus();
</script>
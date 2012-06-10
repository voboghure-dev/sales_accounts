<div id="site">
  <div id="content_full">
    <?php $this->load->view('admin/sales/sub_menu'); ?>
    
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Inventory Check</h1>
      </div>
      
      <?php $this->load->view('admin/sales/left'); ?>
      
      <div id="ManagerWorkArea">
        <div style="overflow: scroll;" id="mgrFullChannel">
          <div>
            <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
              <tbody>
                <tr>
                  <th colspan="2">&nbsp;</th>
                </tr>
                <?php echo form_open('sales_setup/inventory_check', 'name="inventory_check" style="display: inline;"'); ?>
                <tr>
                  <td>Barcode : </td>
                  <td><input type="text" name="barcode" style="width: 200px;" /></td>
                </tr>
                <tr>
                  <th align="center" colspan="2"><input type="submit" name="submit" value="Check" /></th>
                </tr>
                <?php echo form_close(); ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script language=javascript>
  document.inventory_check.barcode.focus();
</script>
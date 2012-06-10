<div id="site">
  <div id="content_2_column">
    <?php $this->load->view('admin/sales/sub_menu'); ?>
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Inventory Details Entry</h1>
      </div>

      <?php $this->load->view('admin/sales/left'); ?>

      <div id="ManagerWorkArea">
        <div style="overflow: scroll;" id="mgrFullChannel">
          <?php echo form_open('sales_setup/inventory_details_add', 'name="inventory_details"'); ?>
          <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
            <tr>
              <th align="center" class="full" colspan="2">Inventory Item</th>
            </tr>
            <tr>
              <td>Barcode : </td>
              <td><input type="text" name="barcode" style="width: 200px;" /></td>
            </tr>
            <tr>
              <td class="full" colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <th align="center" class="full" colspan="2"><input type="submit" name="submit" value="Add Particulars" /></th>
            </tr>
          </table>
          <?php
            echo form_hidden('inventory_no', $inventory_no);
            echo form_close();
            echo form_open('sales_setup/inventory_complete');
          ?>
          
          <table cellspacing="0" border="0" style="border-collapse: collapse; margin-top: 20px;" id="gvItemList" class="GridView">
            <tr>
              <th align="center" class="full" colspan="8">List Inventory Details</th>
            </tr>
            <tr>
              <th align="center" width="30">Serial</th>
              <th align="center">Item Name</th>
              <th align="center">Bar Code</th>
              <th align="center">Price (BDT)</th>
              <th align="center">Price (RS)</th>
              <th align="center">Sales Price (BDT)</th>
              <th align="center">Status</th>
            </tr>
            <?php
            $i = 1;
            foreach ($inventory_details as $key => $value) {
              ?>
              <tr>
                <td align="center"><strong><?php echo $i; ?></strong></td>
                <td><?php echo $value['item_name']; ?></td>
                <td><?php echo $value['barcode']; ?></td>
                <td align="right"><?php echo number_format($value['pur_price_bdt'], 2); ?></td>
                <td align="right"><?php echo number_format($value['price_rs'], 2); ?></td>
                <td align="right"><?php echo number_format($value['price_bdt'], 2); ?></td>
                <td style="text-align: center;"><?php echo $value['status']; ?></td>
              </tr>
              <?php
              $i++;
            }
            ?>
            <tr>
              <td class="full" colspan="8">&nbsp;</td>
            </tr>
            <tr>
              <th align="center" class="full" colspan="8"><input type="submit" name="submit" value="Inventory Complete" /></th>
            </tr>
          </table>
          <?php
          echo form_close();
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  document.inventory_details.item_id.focus();
</script>

<script type="text/javascript">
  $(function(){
    $('.delete').click(function(){
      $(this).parent().parent().fadeTo(400, 0, function () {
        $(this).remove();
      });
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>sales_setup/purchase_item_delete",
        data: "id="+$(this).prev().val(),
        success: function(html){
          $(".top-bar").html(html);
        }
      });

      return false
    });
  });
</script>
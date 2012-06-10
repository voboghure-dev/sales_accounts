<div id="site">
  <div id="content_2_column">
    <?php $this->load->view('admin/sales/sub_menu'); ?>
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Purchase Details Entry</h1>
      </div>

      <?php $this->load->view('admin/sales/left'); ?>

      <div id="ManagerWorkArea">
        <div style="overflow: scroll;" id="mgrFullChannel">
          <?php echo form_open('sales_setup/purchase_details_add', 'name="purchase_details" id="purchase_details"'); ?>
          <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
            <tr>
              <th align="center" class="full" colspan="6">Purchase Item</th>
            </tr>
            <tr>
              <td class="first"><strong>Select Item</strong></td>
              <td style="padding-left: 5px; text-align: left;">
                <select name="item_id" class="required" style="width: 120px;">
                  <option value="">Select One</option>
                  <?php foreach($items as $key=>$value){ ?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php } ?>
                </select>
              </td>
              <td class="first"><strong>Select Supplier</strong></td>
              <td style="padding-left: 5px; text-align: left;">
                <select name="supplier_id" class="required" style="width: 120px;">
                  <option value="">Select One</option>
                  <?php foreach($suppliers as $key=>$value){ ?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php } ?>
                </select>
              </td>
              <td><strong>Supplier Code</strong></td>
              <td><input type="text" name="supplier_code" style="width: 120px;" /></td>
            </tr>
            <tr>
              <td class="first"><strong>Price (BDT)</strong></td>
              <td><input type="text" name="pur_price_bdt" style="width: 120px;" /></td>
              <td><strong>Price (RS)</strong></td>
              <td class="last"><input type="text" name="price_rs" style="width: 120px;" /></td>
              <td><strong>Sales Price (BDT)</strong></td>
              <td class="last"><input type="text" name="price_bdt" style="width: 120px;" /></td>
            </tr>
            <tr>
              <td class="full" colspan="6">&nbsp;</td>
            </tr>
            <tr>
              <th align="center" class="full" colspan="6"><input type="submit" name="submit" value="Add Particulars" /></th>
            </tr>
          </table>
          <?php
          echo form_hidden('purchase_no', $purchase_no);
          echo form_close();
          echo form_open('sales_setup/purchase_complete', 'name="purchase_list" id="purchase_list"');
          ?>
          
          <table cellspacing="0" border="0" style="border-collapse: collapse; margin-top: 20px;" id="gvItemList" class="GridView">
            <tr>
              <th align="center" class="full" colspan="8">Added Purchase Details</th>
            </tr>
            <tr>
              <th align="center" width="30">Serial</th>
              <th align="center">Item Name</th>
              <th align="center">Bar Code</th>
              <th align="center">Price (BDT)</th>
              <th align="center">Price (RS)</th>
              <th align="center">Sales Price (BDT)</th>
              <th align="center">Quantity</th>
              <th align="center">Action</th>
            </tr>
            <?php
            $pur_price_bdt = 0;
            $price_bdt = 0;
            $price_rs = 0;
            $qty = 0;
            $i = 1;
            foreach ($purchase_details as $key => $value) {
              ?>
              <tr>
                <td align="center"><strong><?php echo $i; ?></strong></td>
                <td><?php echo $value['item_name']; ?></td>
                <td><?php echo $value['barcode']; ?></td>
                <td align="right"><?php echo number_format($value['pur_price_bdt'], 2); ?></td>
                <td align="right"><?php echo number_format($value['price_rs'], 2); ?></td>
                <td align="right"><?php echo number_format($value['price_bdt'], 2); ?></td>
                <td align="right"><?php echo $value['quantity']; ?></td>
                <td style="text-align: center;"><input type="hidden" value="<?php echo $value['id']; ?>" /><img src="images/icon_delete.gif" class="delete" alt="delete" style="cursor: pointer;" /></td>
              </tr>
              <?php
              $pur_price_bdt += $value['pur_price_bdt'];
              $price_bdt += $value['price_bdt'];
              $price_rs += $value['price_rs'];
              $qty += $value['quantity'];
              $i++;
            }
            ?>
            <tr>
              <td colspan="3">&nbsp;</td>
              <td align="right"><b><?php echo number_format($pur_price_bdt, 2); ?></b></td>
              <td align="right"><b><?php echo number_format($price_rs, 2); ?></b></td>
              <td align="right"><b><?php echo number_format($price_bdt, 2); ?></b></td>
              <td align="right"><b><?php echo $qty; ?></b></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="full" colspan="8">&nbsp;</td>
            </tr>
            <tr>
              <th align="center" class="full" colspan="8"><input type="submit" name="submit" value="Purchase Complete" /></th>
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
  document.purchase_details.item_id.focus();
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
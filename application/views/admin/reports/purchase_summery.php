<div id="site">
  <div id="content_2_column">
    <?php $this->load->view('admin/reports/sub_menu'); ?>
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Purchase details</h1>
      </div>

      <?php $this->load->view('admin/reports/left'); ?>

      <div id="ManagerWorkArea">
        <div id="mgrFullChannel">
          <div>
            <table cellspacing="0" border="0" style="border-collapse: collapse;" id="GridSuplList" causesvalidation="False" allowediting="True" class="GridView">
              <tbody>
                <tr align="left" style="font-family: Arial; text-decoration: none;">
                  <th align="center" scope="col" width="50">SL #</th>
                  <th align="left" scope="col" width="80">Purchase No</th>
                  <th align="left" scope="col" width="140">Purchase Date</th>
                  <th align="left" scope="col" width="100">Item Quantity</th>
                  <th align="left" scope="col" width="100">Total Price</th>
                </tr>
                <?php
                $i = 1;
                $j = 1;
                $quantity = 0;
                $price = 0;
                foreach ($purchase as $key => $value) {
                  if($value['item_quantity']) {
                    ?>
                    <tr <?php if ($i == 1) { ?>class="RowStyle"<?php } else { ?>class="AlternatingRowStyle"<?php } ?>>
                      <td align="center"><?php echo $j; ?></td>
                      <td align="left"><?php echo $value['purchase_no']; ?></td>
                      <td align="center"><?php echo $value['purchase_date']; ?></td>
                      <td align="right"><?php echo number_format($value['item_quantity']); ?></td>
                      <td align="right"><?php echo number_format($value['total_price'], 2); ?></td>
                    </tr>
                    <?php
                    $quantity += $value['item_quantity'];
                    $price += $value['total_price'];
                    $j++;
                    if ($i == 1) {
                      $i = 0;
                    } else {
                      $i = 1;
                    }
                  }
                }
                ?>
                <tr <?php if ($i == 1) { ?>class="RowStyle"<?php } else { ?>class="AlternatingRowStyle"<?php } ?>>
                  <td align="center" colspan="3"><b>Grand Total</b></td>
                  <td align="right"><?php echo number_format($quantity); ?></td>
                  <td align="right"><?php echo number_format($price, 2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
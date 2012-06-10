<div id="site">
  <div id="content">
    <?php $this->load->view('admin/sales/sub_menu'); ?>

    <div id="itemlisting">
      <div id="customerheader">
        <form name="sales" method="post" action="sales/add">
          <div style="width: 100%; height: 45px; float: left;">
            <b>Bar Code : </b><input type="text" name="barcode" id="item_code" style="width: 150px;" <?php if (isset($barcode)) { ?>value="<?php echo $barcode; ?>"<?php } ?> />&nbsp;&nbsp;&nbsp;&nbsp;
            <b>Fixed Price : </b><input type="text" name="fixed_price_bdt" style="width: 120px;" />&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" name="submit" value="Add Item" />
          </div>
          <?php
          if (isset($sales['id'])) {
            echo form_hidden('sales_id', $sales['id']);
          }
          ?>
        </form>
        <div style="width: 100%; float: left; font-size: 15px; font-weight: bold;">
          Customer : <?php
          if (isset($customer)) {
            echo $customer['name'];
          } else {
            echo 'Annynimous';
          }
          ?>
        </div>
        <div style="width: 100%; padding-top: 10px; float: left; font-size: 15px; font-weight: bold;">
          Sales Man : <?php
          if (isset($sales_man)) {
            echo $sales_man['name'];
          } else {
            echo 'Annynimous';
          }
          ?>
        </div>
      </div>
      <div id="itemheader">
        <table class="itemtable" border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <th width="22">&nbsp;</th>
              <th width="115">&nbsp;Item</th>
              <th width="90">&nbsp;Description</th>
              <th align="center" width="65">&nbsp;Discount</th>
              <th align="center" width="60">&nbsp;Price</th>
              <th align="center" width="57">&nbsp;Vat(2%)</th>
              <th align="center">&nbsp;Total</th>
            </tr>
          </tbody>
        </table>
      </div>
      <div id="items">
        <table class="itemtable" id="tblItems" border="0" cellpadding="0" cellspacing="0" width="554">
          <tbody>
            <?php
            $i = 1;
            $total = 0;
            if (isset($details)) {
              foreach ($details as $key => $value) {
                ?>
                <tr <?php if ($i == 1) { ?>class="row"<?php } else { ?>class="rowalternate"<?php } ?>>
                  <td align="center" width="22">
                    <a href="sales/delete_item/<?php echo $value['id'] . '/' . $this->uri->segment(3); ?>"><img src="images/icon_delete.gif" name="delete" id="delete" border="0" height="20" width="20"></a>
                  </td>
                  <td width="115"><?php echo $value['barcode']; ?></td>
                  <td width="90"><?php echo $value['item_name']; ?></td>
                  <?php
                  if ($value['fixed_price_bdt']) {
                    $price = $value['fixed_price_bdt'];
                    $discount = $value['price_bdt'] - $value['fixed_price_bdt'];
                  } else {
                    $price = $value['price_bdt'];
                    $discount = 0;
                  }
                  ?>
                  <td width="66" align="right"><?php echo number_format($discount, 2);  ?></td>
                  <td width="60" align="right"><?php echo number_format($price, 2); ?></td>
                  <td width="57" align="right"><?php echo number_format($value['vat_amount'], 2); ?></td>
                  <td align="right"><?php echo number_format(($price + $value['vat_amount']), 2); ?></td>
                </tr>
                <?php
                $total += $value['price_total'];
                if ($i == 1) {
                  $i = 0;
                } else {
                  $i = 1;
                }
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <div id="itemtotal" style="text-align: right;">
        <table align="right" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            <tr>
              <td valign="top">
                <div id="discount">
                  <span id="lblDiscount" style="display: inline-block; border-style: none; color: rgb(138, 138, 138);">
                    <?php
                    if ($this->uri->segment(3)) {
                      if ($sales['type'] == 'percent') {
                        $discount = ($sales['discount'] * $total) / 100;
                      } else {
                        $discount = $sales['discount'];
                      }
                    } else {
                      $discount = 0;
                    }
                    ?>
                    Total : <?php echo number_format($total, 2); ?> /= 
                    Discount : <?php echo number_format($discount, 2); ?> /=
                  </span>
                </div>
              </td>
              <td width="20">&nbsp;</td>
              <td>
                <div id="totalprice"> <?php echo number_format(($total - $discount), 2); ?> /=
                  <div class="totallabel" id="totallabel">GRAND TOTAL</div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div id="mainsalenav">
      <ul>
        <li><a href="sales/find_item/<?php echo $this->uri->segment(3); ?>?height=400&width=400&modal=true" class="thickbox" title="Find Item"><img src="images/btn_add_item.png" border="0" height="105" width="113" /></a></li>
        <li><a href="sales/set_customer/<?php echo $this->uri->segment(3); ?>?height=400&width=400&modal=true" class="thickbox" title="Set Customer"><img src="images/btn_set_customer.png" border="0" height="105" width="113" /></a></li>
        <li><a href="sales/set_sales_man/<?php echo $this->uri->segment(3); ?>?height=400&width=400&modal=true" class="thickbox" title="Set Sales Man"><img src="images/btn_set_salesman.png" border="0" height="105" width="113" /></a></li>
        <li><a href="#"><img src="images/btn_return.png" border="0" height="105" width="113" /></a></li>
      </ul>
    </div>
    <div id="secondarysalenav">
      <ul>
        <!--<li><a href="sales/new_item/?height=250&width=400&modal=true" class="thickbox" title="New Item">New Item</a></li>-->
        <li><a href="sales_setup/customer_add?height=440&width=500&modal=true" class="thickbox" title="New Customer">New Customer</a></li>
        <li><?php if ($this->uri->segment(3)) { ?><a href="sales/delete/<?php echo $this->uri->segment(3); ?>">Cancel Transaction</a><?php } else { ?>Cancel Transaction<?php } ?></li>
        <li><?php if ($this->uri->segment(3)) { ?><a href="sales/discount/<?php echo $this->uri->segment(3); ?>?height=170&width=300&modal=true" class="thickbox" title="Discount">Discount</a><?php } else { ?>Discount<?php } ?></li>
        <li><?php if ($this->uri->segment(3)) { ?><a href="sales/payout/<?php echo $this->uri->segment(3); ?>?height=170&width=300&modal=true" class="thickbox" title="Payout">Payout</a><?php } else { ?>Payout<?php } ?></li>
        <li><a id="showCalc" href="javascript:void(0)">Calculator</a></li><div id="calc"></div>
      </ul>
    </div>

  </div>
</div>
<script language=javascript>
  document.sales.item_code.focus();
  function change_amount(){
    document.payout.change.focus();
  }
</script>
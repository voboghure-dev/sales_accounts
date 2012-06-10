<div style="width: 100%; font-size: 15px; font-weight: bold; text-align: center;">
  Click Item Code to Add
</div>
<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr bgcolor="#C9EAFC">
    <th>Bar Code</th>
    <th>Item Name</th>
    <th>Price (BDT)</th>
  </tr>
  <?php foreach($items as $key=>$value){ ?>
  <tr>
    <td><a href="sales/add/<?php echo $sales_id; ?>/<?php echo $value['barcode']; ?>"><?php echo $value['barcode']; ?></a></td>
    <td><?php echo $value['name']; ?></td>
    <td><?php echo $value['price_bdt']; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input type="button" value="Cancel" onclick="tb_remove()" /></td>
  </tr>
</table>
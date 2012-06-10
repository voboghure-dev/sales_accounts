<div style="width: 100%; font-size: 15px; font-weight: bold; text-align: center;">
  Click Full Name to Add
</div>
<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr bgcolor="#C9EAFC">
    <th>Code</th>
    <th>Full Name</th>
    <th>City</th>
    <th>Mobile</th>
  </tr>
  <?php foreach($customers as $key => $value){ ?>
  <tr>
    <td><?php echo $value['code']; ?></td>
    <td><a href="sales/set_customer/<?php echo $sales_id; ?>/<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
    <td><?php echo $value['city']; ?></td>
    <td><?php echo $value['mobile']; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input type="button" value="Cancel" onclick="tb_remove()" /></td>
  </tr>
</table>
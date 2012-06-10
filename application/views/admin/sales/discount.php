<div style="width: 100%; font-size: 15px; font-weight: bold; text-align: center;">
  Add Discount
</div>
<?php echo form_open('sales/discount', 'name="discount"'); ?>
<table width="100%" border="0" cellpadding="5" cellspacing="5">
  <tr>
    <td><b>Discount :</b></td>
    <td><input type="text" name="discount" onload="" style="width: 200px;" /></td>
  </tr>
  <tr>
    <td><b>Type :</b></td>
    <td>
      <select name="type" style="width: 200px;">
        <option value="taka">Taka</option>
        <option value="percent">Percent</option>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="submit" value="Submit" />&nbsp;&nbsp;<input type="button" value="Cancel" onclick="tb_remove()" /></td>
  </tr>
</table>
<?php
  echo form_hidden('sales_id', $sales_id);
  echo form_close();
?>
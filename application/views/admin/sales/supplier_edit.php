<?php echo form_open('sales_setup/supplier_edit', 'name="supplier"'); ?>
<div style="width: 100%; font-size: 15px; font-weight: bold; text-align: center;">
  Supplier Edit
</div>
<table width="100%" cellpadding="5" cellspacing="5">
  <tr>
    <td width="120"><strong>Supplier Code</strong></td>
    <td><input type="text" name="code" value="<?php echo $supplier['code']; ?>" style="width: 200px;" /></td>
  </tr>
  <tr>
    <td><strong>Supplier Name</strong></td>
    <td><input type="text" name="name" value="<?php echo $supplier['name']; ?>" style="width: 200px;" /></td>
  </tr>
  <tr>
    <td><strong>Contact Person</strong></td>
    <td><input type="text" name="contact_person" value="<?php echo $supplier['contact_person']; ?>" style="width: 200px;" /></td>
  </tr>
  <tr>
    <td valign="top"><strong>Address</strong></td>
    <td><textarea name="address" style="width: 200px;"><?php echo $supplier['address']; ?></textarea></td>
  </tr>
  <tr>
    <td><strong>Phone</strong></td>
    <td><input type="text" name="phone" value="<?php echo $supplier['phone']; ?>" style="width: 200px;" /></td>
  </tr>
  <tr>
    <td><strong>Fax</strong></td>
    <td><input type="text" name="fax" value="<?php echo $supplier['fax']; ?>" style="width: 200px;" /></td>
  </tr>
  <tr>
    <td><strong>Email</strong></td>
    <td><input type="text" name="email" value="<?php echo $supplier['email']; ?>" style="width: 200px;" /></td>
  </tr>
  <tr>
    <td><strong>Web</strong></td>
    <td><input type="text" name="web" value="<?php echo $supplier['web']; ?>" style="width: 200px;" /></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" name="submit" value="Submit" />&nbsp;<input type="button" value="Cancel" onclick="tb_remove()" />
    </td>
  </tr>
</table>
<?php
  echo form_hidden('id', $supplier['id']);
  echo form_close();
?>
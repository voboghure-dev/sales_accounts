<?php echo form_open('pharmacy_setup/edit'); ?>
<div style="width: 100%; font-size: 15px; font-weight: bold; text-align: center;">
  Item Edit
</div>
<table width="100%" cellpadding="5" cellspacing="5">
  <tr>
    <td width="100"><b>Item Code :</b></td>
    <td><input type="text" class="text" name="code" style="width: 250px;" value="<?php echo $item['code']; ?>" /></td>
  </tr>
  <tr>
    <td><b>Item Name :</b></td>
    <td><input type="text" class="text" name="name" style="width: 250px;" value="<?php echo $item['name']; ?>" /></td>
  </tr>
  <tr>
    <td><b>Description :</b></td>
    <td><input type="text" class="text" name="description" style="width: 250px;" value="<?php echo $item['description']; ?>" /></td>
  </tr>
  <tr>
    <td><b>Purchase Price :</b></td>
    <td><input type="text" class="text" name="purchase_price" style="width: 250px;" value="<?php echo $item['purchase_price']; ?>" /></td>
  </tr>
  <tr>
    <td><b>Sale Price :</b></td>
    <td><input type="text" class="text" name="sale_price" style="width: 250px;" value="<?php echo $item['sale_price']; ?>" /></td>
  </tr>
  <tr>
    <td><b>Re Order Level :</b></td>
    <td><input type="text" class="text" name="re_order" style="width: 250px;" value="<?php echo $item['re_order']; ?>" /></td>
  </tr>
  <tr>
    <td><b>Supplier Name :</b></td>
    <td>
      <select name="supplier_id" style="width: 250px;">
        <?php foreach($suppliers as $key => $value){ ?>
        <option value="<?php echo $value['id']; ?>" <?php if($value['id']==$item['supplier_id']){ ?>selected<?php } ?>><?php echo $value['name']; ?></option>
        <?php } ?>
      </select>
    </td>
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
  echo form_hidden('id', $item['id']);
  echo form_close();
?>
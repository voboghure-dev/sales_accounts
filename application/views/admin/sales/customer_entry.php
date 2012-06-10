<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.13.custom.css" rel="stylesheet" />

<script>
  $(function() {
    $( ".jq_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
</script>

<div>
  <div style="width: 100%; padding-bottom: 10px; font-size: 15px; font-weight: bold; text-align: center;">
    Customer Details Entry
  </div>
  <?php echo form_open('sales_setup/customer_add'); ?>
  <table width="100%" border="0" cellpadding="5" cellspacing="5">
    <tr>
      <td><b>Code :</b></td>
      <td><input type="text" name="code" style="width: 350px;" value="<?php echo $code; ?>" /></td>
    </tr>
    <tr>
      <td><b>Full Name :</b></td>
      <td><input type="text" name="name" style="width: 350px;" /></td>
    </tr>
    <tr>
      <td valign="top"><b>Address :</b></td>
      <td><textarea name="address" style="width: 350px;"></textarea></td>
    </tr>
    <tr>
      <td><b>City :</b></td>
      <td><input type="text" name="city" style="width: 350px;" /></td>
    </tr>
    <tr>
      <td><b>Zip Code :</b></td>
      <td><input type="text" name="zip" style="width: 350px;" /></td>
    </tr>
    <tr>
      <td><b>Country :</b></td>
      <td><input type="text" name="country" style="width: 350px;" /></td>
    </tr>
    <tr>
      <td><b>Mobile :</b></td>
      <td><input type="text" name="mobile" style="width: 350px;" /></td>
    </tr>
    <tr>
      <td><b>Phone :</b></td>
      <td><input type="text" name="phone" style="width: 350px;" /></td>
    </tr>
    <tr>
      <td><b>Email :</b></td>
      <td><input type="text" name="email" style="width: 350px;" /></td>
    </tr>
    <tr>
      <td><b>Date of Birth :</b></td>
      <td><input type="text" name="dob" class="jq_date" style="width: 150px;" />&nbsp;[ year-month-day ]</td>
    </tr>
    <tr>
      <td><b>Web Site :</b></td>
      <td><input type="text" name="web" style="width: 350px;" /></td>
    </tr>
    <tr>
      <td valign="top"><b>Notes :</b></td>
      <td><textarea name="notes" style="width: 350px;"></textarea></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
      <td colspan="2" align="center"><input value="Submit" type="submit" />&nbsp;<input type="button" value="Cancel" onclick="tb_remove()" /></td>
    </tr>
  </table>
  <?php
    echo form_hidden('referrer', $this->agent->referrer());
    echo form_close();
  ?>
</div>
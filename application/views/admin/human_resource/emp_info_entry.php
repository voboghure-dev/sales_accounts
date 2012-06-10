<div style="width: 100%; font-size: 15px; font-weight: bold; text-align: center; padding-bottom: 10px;">
  New Employee Entry
</div>
<?php echo form_open('human_resource/emp_add', 'name="emp_add"'); ?>
<table cellpadding="2" cellspacing="3">
  <tr>
    <td width="120"><strong>Full Name</strong></td>
    <td><input type="text" name="name" autocomplete="off" style="width: 250px;" /></td>
  </tr>
  <tr>
    <td><strong>Father's Name</strong></td>
    <td><input type="text" name="father_name" autocomplete="off" style="width: 250px;" /></td>
  </tr>
  <tr>
    <td><strong>Mother's Name</strong></td>
    <td><input type="text" name="mother_name" autocomplete="off" style="width: 250px;" /></td>
  </tr>
  <tr>
    <td><strong>Date of Birth</strong></td>
    <td>
      <select name="day">
        <option value="">Day</option>
        <?php for($i=1; $i<=31; $i++){ ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php } ?>
      </select>
      <select name="month">
        <option>Month</option>
        <?php for($i=1;$i<=12;$i++){ ?>
        <option value="<?php echo $i; ?>"><?php echo getMonthString($i); ?></option>
        <?php } ?>
      </select>
      <select name="year">
        <option>Year</option>
        <?php for($i=1930;$i<=2000;$i++){ ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php } ?>
      </select>
    </td>
  </tr>
  <tr>
    <td valign="top"><strong>Present Address</strong></td>
    <td><textarea name="present_address" style="width: 250px;"></textarea></td>
  </tr>
  <tr>
    <td valign="top"><strong>Permanent Address</strong></td>
    <td><textarea name="permanent_address" style="width: 250px;"></textarea></td>
  </tr>
  <tr>
    <td><strong>Voter ID No.</strong></td>
    <td><input type="text" name="voter_id" autocomplete="off" style="width: 250px;" /></td>
  </tr>
  <tr>
    <td><strong>Department</strong></td>
    <td><input type="text" name="department" autocomplete="off" style="width: 250px;" /></td>
  </tr>
  <tr>
    <td><strong>Position</strong></td>
    <td>
      <select name="position" style="width: 155px;">
        <option value="Sales Executive">Sales Executive</option>
      </select>
    </td>
  </tr>
  <tr>
    <td><strong>Joining Date</strong></td>
    <td>
      <select name="jday">
        <option>Day</option>
        <?php for($i=1; $i<=31; $i++){ ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php } ?>
      </select>
      <select name="jmonth">
        <option>Month</option>
        <?php for($i=1;$i<=12;$i++){ ?>
        <option value="<?php echo $i; ?>"><?php echo getMonthString($i); ?></option>
        <?php } ?>
      </select>
      <select name="jyear">
        <option>Year</option>
        <?php for($i=1930;$i<=2000;$i++){ ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php } ?>
      </select>
    </td>
  </tr>
  <tr>
    <td><strong>Status</strong></td>
    <td>
      <select name="status" style="width: 155px;">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
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
<?php echo form_close(); ?>

<script language=javascript>
  document.emp_add.name.focus();
</script>


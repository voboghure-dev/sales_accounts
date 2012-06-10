<div style="width: 100%; font-size: 15px; font-weight: bold; text-align: center; padding-bottom: 10px;">
  Employee Info Edit
</div>
<?php echo form_open_multipart('human_resource/emp_edit', 'name="emp_edit"'); ?>
<table cellpadding="2" cellspacing="3">
  <tr>
    <td width="120"><strong>Full Name</strong></td>
    <td><input type="text" name="name" value="<?php echo $employee['name']; ?>" style="width: 250px;" /></td>
  </tr>
  <tr>
    <td><strong>Father's Name</strong></td>
    <td><input type="text" name="father_name" value="<?php echo $employee['father_name']; ?>" style="width: 250px;" /></td>
  </tr>
  <tr>
    <td><strong>Mother's Name</strong></td>
    <td><input type="text" name="mother_name" value="<?php echo $employee['mother_name']; ?>" style="width: 250px;" /></td>
  </tr>
  <tr>
    <td><strong>Date of Birth</strong></td>
    <td>
      <select name="day">
        <option>Day</option>
        <?php for($i=1; $i<=31; $i++){ ?>
        <option value="<?php echo $i; ?>" <?php if($i==$dob[2]){echo 'selected';} ?>><?php echo $i; ?></option>
        <?php } ?>
      </select>
      <select name="month">
        <option>Month</option>
        <?php for($i=1;$i<=12;$i++){ ?>
        <option value="<?php echo $i; ?>" <?php if($i==$dob[1]){echo 'selected';} ?>><?php echo getMonthString($i); ?></option>
        <?php } ?>
      </select>
      <select name="year">
        <option>Year</option>
        <?php for($i=1930;$i<=2000;$i++){ ?>
        <option value="<?php echo $i; ?>" <?php if($i==$dob[0]){echo 'selected';} ?>><?php echo $i; ?></option>
        <?php } ?>
      </select>
    </td>
  </tr>
  <tr>
    <td valign="top"><strong>Present Address</strong></td>
    <td><textarea name="present_address" style="width: 250px;"><?php echo $employee['present_address']; ?></textarea></td>
  </tr>
  <tr>
    <td valign="top"><strong>Permanent Address</strong></td>
    <td><textarea name="permanent_address" style="width: 250px;"><?php echo $employee['permanent_address']; ?></textarea></td>
  </tr>
  <tr>
    <td><strong>Voter ID No.</strong></td>
    <td><input type="text" name="voter_id" value="<?php echo $employee['voter_id']; ?>" style="width: 250px;" /></td>
  </tr>
  <tr>
    <td><strong>Department</strong></td>
    <td><input type="text" name="department" value="<?php echo $employee['department']; ?>" style="width: 250px;" /></td>
  </tr>
  <tr>
    <td><strong>Position</strong></td>
    <td>
      <select name="position" style="width: 153px;">
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
        <option value="<?php echo $i; ?>" <?php if($i==$joining[2]){echo 'selected';} ?>><?php echo $i; ?></option>
        <?php } ?>
      </select>
      <select name="jmonth">
        <option>Month</option>
        <?php for($i=1;$i<=12;$i++){ ?>
        <option value="<?php echo $i; ?>" <?php if($i==$joining[1]){echo 'selected';} ?>><?php echo getMonthString($i); ?></option>
        <?php } ?>
      </select>
      <select name="jyear">
        <option>Year</option>
        <?php for($i=1930;$i<=2000;$i++){ ?>
        <option value="<?php echo $i; ?>" <?php if($i==$joining[0]){echo 'selected';} ?>><?php echo $i; ?></option>
        <?php } ?>
      </select>
    </td>
  </tr>
  <tr>
    <td><strong>Status</strong></td>
    <td>
      <select name="status" style="width: 153px;">
        <option value="active" <?php if($employee['status']=='active'){ ?>selected<?php } ?>>Active</option>
        <option value="inactive" <?php if($employee['status']=='inactive'){ ?>selected<?php } ?>>Inactive</option>
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
  echo form_hidden('id', $employee['id']);
  echo form_close();
?>


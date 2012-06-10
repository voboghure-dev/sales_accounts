<div style="width: 100%; font-size: 16px; padding-bottom: 20px; font-weight: bold; text-align: center;">
  Chart of A/C Entry
</div>
<?php echo form_open('accounts/edit_chart_ac', 'name="chart_ac"'); ?>
<table class="listing form" cellpadding="5" cellspacing="5">
  <tr>
    <td class="first" width="120"><b>Under A/C of</b></td>
    <td class="last">
      <select name="parent_id" style="width: 270px;">
        <option value="">Root</option>
        <?php foreach ($ac_charts as $key => $value) { ?>
          <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $ac_chart['parent_id']) { ?>selected<?php } ?>><?php echo $value['name']; ?></option>
        <?php } ?>
      </select>
    </td>
  </tr>
  <tr class="bg">
    <td class="first" width="120"><strong>A/C Code</strong></td>
    <td class="last"><input type="text" class="text" name="code" value="<?php echo $ac_chart['code']; ?>" autocomplete="off" style="width: 267px;" /></td>
  </tr>
  <tr>
    <td class="first" width="120"><strong>A/C Name</strong></td>
    <td class="last"><input type="text" class="text" name="name" value="<?php echo $ac_chart['name']; ?>" autocomplete="off" style="width: 267px;" /></td>
  </tr>
  <tr class="bg">
    <td class="first" width="120" valign="top"><strong>Memo</strong></td>
    <td class="last"><textarea name="memo" style="width: 267px;"><?php echo $ac_chart['memo']; ?></textarea></td>
  </tr>
  <tr>
    <td class="first"><strong>Opening Balance</strong></td>
    <td class="last"><input type="text" class="text" name="opening" value="<?php echo $ac_chart['opening']; ?>" autocomplete="off" style="width: 267px;" /></td>
  </tr>
  <tr>
    <td class="full" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <th class="full" colspan="2" align="center">
      <input type="submit" name="submit" value="Save A/C" />&nbsp;
      <input type="button" value="Cancel" onclick="tb_remove()" />
    </th>
  </tr>
</table>
<?php
echo form_hidden('id', $ac_chart['id']);
echo form_close();
?>

<script type="text/javascript">
  document.chart_ac.code.focus();
</script>
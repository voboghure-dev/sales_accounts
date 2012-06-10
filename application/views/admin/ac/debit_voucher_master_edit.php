<div id="site">
  <div id="content_2_column">
    <?php $this->load->view('admin/sub_menu'); ?>
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Debit Voucher Edit</h1>
      </div>

      <?php $this->load->view('admin/ac/left'); ?>

      <div id="ManagerWorkArea">
        <div style="overflow: scroll;" id="mgrFullChannel">
          <?php echo form_open('accounts/edit_debit_voucher_master', 'name="debit_voucher" id="debit_voucher"'); ?>
          <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
            <tr>
              <th style="width: 70px;" scope="col">&nbsp;</th>
              <th style="width: 150px;" scope="col">&nbsp;</th>
              <th style="width: 70px;" scope="col">&nbsp;</th>
              <th style="width: 150px;" scope="col">&nbsp;</th>
            </tr>
            <tr>
              <td class="first" width="80"><strong>Voucher No</strong></td>
              <td style="padding-left: 5px; text-align: left;"><input name="voucher_no" value="<?php echo $debit_voucher['voucher_no']; ?>" style="width: 230px;" /></td>
              <td width="90"><strong>Voucher Date</strong></td>
              <td class="last"><input type="text" class="jq_date" name="voucher_date" value="<?php echo $debit_voucher['voucher_date']; ?>" style="width: 230px;" /></td>
            </tr>
            <tr class="bg">
              <td class="first" valign="top"><strong>Ref. Employee</strong></td>
              <td valign="top" style="padding-left: 5px; text-align: left;">
                <select name="emp_id" class="required" style="width: 236px;">
                  <option value="">Select One</option>
                  <?php foreach ($employees as $key => $value) { ?>
                    <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $debit_voucher['emp_id']) { ?>selected<?php } ?>><?php echo $value['full_name']; ?></option>
                  <?php } ?>
                </select>
              </td>
              <td valign="top"><strong>Memo</strong></td>
              <td class="last"><textarea name="memo" style="width: 230px;"><?php echo $debit_voucher['memo']; ?></textarea></td>
            </tr>
            <tr>
              <td class="full" colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <th align="center" class="full" colspan="4"><input type="submit" name="submit" value="Update Voucher" /></th>
            </tr>
          </table>
          <?php
          echo form_hidden('id', $debit_voucher['id']);
          echo form_close();
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  document.debit_voucher.voucher_no.focus();
  $(document).ready(function(){
    $("#debit_voucher").validate();
  });
</script>
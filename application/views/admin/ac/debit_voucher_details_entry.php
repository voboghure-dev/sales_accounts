<div id="site">
  <div id="content_2_column">
    <?php $this->load->view('admin/sub_menu'); ?>
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Debit Voucher Posting</h1>
      </div>

      <?php $this->load->view('admin/ac/left'); ?>

      <div id="ManagerWorkArea">
        <div style="overflow: scroll;" id="mgrFullChannel">
          <?php echo form_open('accounts/add_debit_voucher_details', 'name="journal_voucher" id="journal_voucher"'); ?>
          <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
            <tr>
              <th align="center" class="full" colspan="6">Voucher Particulars</th>
            </tr>
            <tr>
              <td class="first"><strong>Chart of A/C</strong></td>
              <td style="padding-left: 5px; text-align: left;">
                <select name="chart_id" class="required" style="width: 270px;">
                  <option value="">Select One</option>
                  <?php echo $ac_chart_tree; ?>
                </select>
              </td>
              <td><strong>Debit</strong></td>
              <td><input type="text" name="debit" style="width: 100px;" /></td>
              <td><strong>Credit</strong></td>
              <td class="last"><input type="text" name="credit" style="width: 100px;" /></td>
            </tr>
            <tr>
              <td class="full" colspan="6">&nbsp;</td>
            </tr>
            <tr>
              <th align="center" class="full" colspan="6"><input type="submit" name="submit" value="Add Particulars" /></th>
            </tr>
          </table>
          <?php
          echo form_hidden('voucher_no', $voucher_no);
          echo form_close();
          echo form_open('accounts/debit_voucher_list', 'name="voucher_list" id="voucher_list"');
          ?>
          
          <table cellspacing="0" border="0" style="border-collapse: collapse; margin-top: 20px;" id="gvItemList" class="GridView">
            <tr>
              <th align="center" class="full" colspan="4">Added Voucher Details</th>
            </tr>
            <tr>
              <th>Chart of A/C Name</th>
              <th>Debit</th>
              <th>Credit</th>
              <th>Action</th>
            </tr>
            <?php
            $debit = 0;
            $credit = 0;
            foreach ($voucher_particulars as $key => $value) {
              ?>
              <tr>
                <td><?php echo $value['chart_name']; ?></td>
                <td align="right"><?php echo number_format($value['debit'], 2); ?></td>
                <td align="right"><?php echo number_format($value['credit'], 2); ?></td>
                <td style="text-align: center;"><input type="hidden" value="<?php echo $value['id']; ?>" /><img src="images/hr.gif" width="16" height="16" class="delete" alt="delete" style="cursor: pointer;" /></td>
              </tr>
              <?php
              $debit += $value['debit'];
              $credit += $value['credit'];
            }
            ?>
            <tr>
              <td>&nbsp;</td>
              <td align="right"><b><?php echo number_format($debit, 2); ?></b></td>
              <td align="right"><b><?php echo number_format($credit, 2); ?></b></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td class="full" colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <th align="center" class="full" colspan="4"><input type="submit" name="submit" value="Voucher Complete" /></th>
            </tr>
          </table>
          <?php
          echo form_hidden('debit', $debit);
          echo form_hidden('credit', $credit);
          echo form_hidden('voucher_no', $voucher_no);
          echo form_close();
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  document.journal_voucher.cr_chart_id.focus();
  $(document).ready(function(){
    $("#journal_voucher").validate();
  });
</script>

<script type="text/javascript">
  $(function(){
    $('.delete').click(function(){
      $(this).parent().parent().fadeTo(400, 0, function () {
        $(this).remove();
      });
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>accounts/delete_debit_voucher_item",
        data: "id="+$(this).prev().val(),
        success: function(html){
          $(".top-bar").html(html);
        }
      });

      return false
    });
  });
</script>
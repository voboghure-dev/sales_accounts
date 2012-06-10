<div id="site">
  <div id="content_full">
    <?php $this->load->view('admin/sales/sub_menu'); ?>
    
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Purchase List</h1>
      </div>
      
      <?php $this->load->view('admin/sales/left'); ?>
      
      <div id="ManagerWorkArea">
        <div style="overflow: scroll;" id="mgrFullChannel">
          <div>
            <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
              <tbody>
                <tr>
                  <td colspan="6"><a href="sales_setup/purchase_master_add" title="Purchase Entry"><img src="images/btn_add.gif" border="0" /></a></td>
                </tr>
                <tr align="left" style="font-family: Arial; text-decoration: none;">
                  <th align="center" width="50" scope="col">&nbsp;</th>
                  <th align="left" scope="col" width="100">Purchase #</th>
                  <th align="left" scope="col" width="100">Date</th>
                  <th align="left" scope="col">Notes</th>
                  <th align="right" scope="col" width="70">Total Qty</th>
                  <th align="right" scope="col" width="100">Total Price BDT</th>
                </tr>
                <?php
                  $i = 1;
                  foreach($purchase as $key=>$value){
                ?>
                <tr <?php if($i==1){ ?>class="RowStyle"<?php }else{ ?>class="AlternatingRowStyle"<?php } ?>>
                  <td align="center" style="height: 22px;">
                    <a href="sales_setup/purchase_master_edit/<?php echo $value['id']; ?>" title="Receive Edit"><img src="images/icon_edit.gif" border="0" /></a>
                    <a href="sales_setup/purchase_delete/<?php echo $value['id']; ?>" title="Receive Delete"><img src="images/icon_delete.gif" border="0" /></a>
                  </td>
                  <td align="left"><?php echo $value['purchase_no']; ?></td>
                  <td align="left"><?php echo $value['purchase_date']; ?></td>
                  <td align="left"><?php echo $value['notes']; ?></td>
                  <td align="right"><?php echo $value['total_qty']; ?></td>
                  <td align="right"><?php echo number_format($value['total_price'], 2); ?></td>
                </tr>
                <?php
                    if($i==1){
                      $i=0;
                    }else{
                      $i=1;
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
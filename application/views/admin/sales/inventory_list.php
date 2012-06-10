<div id="site">
  <div id="content_full">
    <?php $this->load->view('admin/sales/sub_menu'); ?>
    
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Inventory List</h1>
      </div>
      
      <?php $this->load->view('admin/sales/left'); ?>
      
      <div id="ManagerWorkArea">
        <div id="mgrFullChannel">
          <div>
            <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
              <tbody>
                <tr>
                  <td colspan="6"><a href="sales_setup/inventory_master_add" title="Purchase Entry"><img src="images/btn_add.gif" border="0" /></a></td>
                </tr>
                <tr align="left" style="font-family: Arial; text-decoration: none;">
                  <th align="center" width="50" scope="col">&nbsp;</th>
                  <th align="left" scope="col" width="150">Inventory #</th>
                  <th align="left" scope="col" width="200">Date</th>
                  <th align="left" scope="col">Notes</th>
                </tr>
                <?php
                  $i = 1;
                  foreach($inventory as $key=>$value){
                ?>
                <tr <?php if($i==1){ ?>class="RowStyle"<?php }else{ ?>class="AlternatingRowStyle"<?php } ?>>
                  <td align="center" style="height: 22px;">
                    <a href="sales_setup/inventory_master_edit/<?php echo $value['id']; ?>" title="Receive Delete"><img src="images/icon_edit.gif" border="0" /></a>
                    <a href="sales_setup/inventory_delete/<?php echo $value['id']; ?>" title="Receive Delete"><img src="images/icon_delete.gif" border="0" /></a>
                  </td>
                  <td align="left"><?php echo $value['inventory_no']; ?></td>
                  <td align="left"><?php echo $value['inventory_date']; ?></td>
                  <td align="left"><?php echo $value['notes']; ?></td>
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
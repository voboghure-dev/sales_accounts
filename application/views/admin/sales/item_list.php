<div id="site">
  <div id="content_full">
    <?php $this->load->view('admin/sales/sub_menu'); ?>
    
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Item List</h1>
      </div>
      
      <?php $this->load->view('admin/sales/left'); ?>
      
      <div id="ManagerWorkArea">
        <div id="mgrFullChannel">
          <div>
            <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvItemList" class="GridView">
              <tbody>
                <tr>
                  <td colspan="8"><a href="sales_setup/add?height=250&width=400&modal=true" class="thickbox" title="Item Entry"><img src="images/btn_add.gif" border="0" /></a></td>
                </tr>
                <tr align="left" style="font-family: Arial; text-decoration: none;">
                  <th align="center" scope="col" width="50">&nbsp;</th>
                  <th align="left" scope="col" width="50">Serial</th>
                  <th align="left" scope="col">Code</th>
                  <th align="left" scope="col">Name</th>
                  <th align="left" scope="col">Description</th>
                  <th align="left" scope="col">Re-Order</th>
                </tr>
                <?php
                  $i = 1;
                  $j = 1;
                  foreach($items as $key=>$value){
                ?>
                <tr <?php if($i==1){ ?>class="RowStyle"<?php }else{ ?>class="AlternatingRowStyle"<?php } ?>>
                  <td align="center" style="height: 22px;">
                    <a href="sales_setup/edit/<?php echo $value['id']; ?>?height=250&width=400&modal=true" class="thickbox" title="Item Edit"><img src="images/icon_edit.gif" border="0" /></a>
                    <a href="sales_setup/delete/<?php echo $value['id']; ?>" title="Item Delete"><img src="images/icon_delete.gif" border="0" /></a>
                  </td>
                  <td align="left"><?php echo $j; ?></td>
                  <td align="left"><?php echo $value['code']; ?></td>
                  <td align="left"><?php echo $value['name']; ?></td>
                  <td align="left"><?php echo $value['description']; ?></td>
                  <td align="right"><?php echo $value['re_order']; ?></td>
                </tr>
                <?php
                    if($i==1){
                      $i=0;
                    }else{
                      $i=1;
                    }
                    $j++;
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
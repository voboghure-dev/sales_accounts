<div id="site">
  <div id="content_full">
    <?php $this->load->view('admin/sales/sub_menu'); ?>
    
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Supplier List</h1>
      </div>
      
      <?php $this->load->view('admin/sales/left'); ?>
      
      <div id="ManagerWorkArea">
        <div style="overflow: scroll;" id="mgrFullChannel">
          <div>
            <div>
              <table cellspacing="0" border="0" style="border-collapse: collapse;" id="GridCategList" cacheexpirationpolicy="Absolute" cacheduration="2" enablecaching="True" allowselecting="True" causesvalidation="False" allowediting="True" class="GridView">
                <tbody>
                  <tr>
                    <td colspan="6"><a href="sales_setup/supplier_add?height=320&width=350&modal=true" class="thickbox" title="Supplier Entry"><img src="images/btn_add.gif" border="0" /></a></td>
                  </tr>
                  <tr align="left" style="font-family: Arial; text-decoration: none;">
                    <th scope="col">&nbsp;</th>
                    <th align="left" scope="col">Code</th>
                    <th align="left" scope="col">Supplier Name</th>
                    <th align="left" scope="col">Contact Person</th>
                    <th align="left" scope="col">Phone</th>
                    <th align="left" scope="col">Address</th>
                  </tr>
                  <?php
                  $i = 1;
                  if(count($suppliers)>0){
                    foreach ($suppliers as $key => $value) {
                  ?>
                    <tr <?php if ($i == 1) { ?>class="RowStyle"<?php } else { ?>class="AlternatingRowStyle"<?php } ?>>
                      <td style="width: 50px;">
                        <a href="sales_setup/supplier_edit/<?php echo $value['id']; ?>?height=320&width=350&modal=true" class="thickbox" title="Supplier Edit"><img src="images/icon_edit.gif" border="0" /></a>
                        <a href="sales_setup/supplier_delete/<?php echo $value['id']; ?>" title="Supplier Delete"><img src="images/icon_delete.gif" border="0" /></a>
                      </td>
                      <td><?php echo $value['code'] ?></td>
                      <td><?php echo $value['name'] ?></td>
                      <td><?php echo $value['contact_person'] ?></td>
                      <td><?php echo $value['phone'] ?></td>
                      <td><?php echo $value['address'] ?></td>
                    </tr>
                  <?php
                      if ($i == 1) {
                        $i = 0;
                      } else {
                        $i = 1;
                      }
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
</div>
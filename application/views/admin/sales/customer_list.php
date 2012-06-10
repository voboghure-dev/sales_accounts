<div id="site">
  <div id="content_full">
    <?php $this->load->view('admin/sales/sub_menu'); ?>
    
    <div id="channel_full">
      <div id="manager_header">
        <h1 id="lblPageName">Customer List</h1>
      </div>

      <?php $this->load->view('admin/sales/left'); ?>

      <div id="ManagerWorkArea">
        <div id="mgrFullChannel">
          <div>
            <table cellspacing="0" border="0" style="border-collapse: collapse;" id="gvCustomers" class="GridView">
              <tbody>
                <tr>
                  <td colspan="6"><a href="sales_setup/customer_add?height=440&width=500&modal=true" class="thickbox" title="Item Entry"><img src="images/btn_add.gif" border="0" /></a></td>
                </tr>
                <tr align="left" style="font-family: Arial; text-decoration: none;">
                  <th scope="col">&nbsp;</th>
                  <th align="left" scope="col">Code</th>
                  <th align="left" scope="col">Name</th>
                  <th align="left" scope="col">Address</th>
                  <th align="left" scope="col">Mobile #</th>
                  <th align="left" scope="col">E-Mail</th>
                </tr>
                <?php foreach ($customers as $key => $value) { ?>
                  <tr class="RowStyle">
                    <td style="width: 45px;">
                      <a href="sales_setup/customer_edit/<?php echo $value['id']; ?>?height=440&width=500&modal=true" class="thickbox" title="Customer Entry"><img src="images/icon_edit.gif" border="0" /></a>
                      <a href="sales_setup/customer_delete/<?php echo $value['id']; ?>" title="Customer Delete"><img src="images/icon_delete.gif" border="0" /></a>
                    </td>
                    <td align="left"><?php echo $value['code']; ?></td>
                    <td align="left"><?php echo $value['name']; ?></td>
                    <td align="left"><?php echo $value['address']; ?></td>
                    <td><?php echo $value['mobile']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
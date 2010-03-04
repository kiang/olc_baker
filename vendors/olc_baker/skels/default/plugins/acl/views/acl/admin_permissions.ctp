<?php print $this->element('acl_scripts') ?>
<?php print $this->element('acl_menu') ?>
<div>
  <?php print $html->image('/acl/img/tango/32x32/emblems/emblem-readonly.png', array('align' => 'absmiddle')) ?>
  <b>Manage Permissions</b>
</div>
<div class="acl_message">
<h4>Navigating The Tree</h4>
<p>Try double-clicking on each aro/aco to find out if it has any children. If it does,
the children will load in the select box. You can move back one level by double-clicking
the two dots. If you single click an aro/aco, its already assigned permissions appear
in the chart below.</p>
<h4>Granting Permissions</h4>
<p>Navigate to an aro on the left side and an aco on the right side. When you are ready
to grant permission, click 'Grant', and you will see the newly assigned permission appear
below.</p>
<h4>Revoking Permissions</h4>
<p>You can easily revoke a permission by first browsing an aro/aco. When you click on one,
the granted permissions appear below. You can revoke a permission at any time by clicking
revoke.</p>
</div>
<table>
  <thead>
  <tr>
    <th>
      <?php print $html->image('/acl/img/tango/32x32/apps/system-users.png', array('align' => 'absmiddle')) ?>
      Access Request Objects
    </th>
    <th></th>
    <th>
      <?php print $html->image('/acl/img/tango/32x32/apps/preferences-system-windows.png', array('align' => 'absmiddle')) ?>
      Access Control Objects
    </th>
  </tr>
  </thead>
  <tr>
    <td>
      <select id="aro_editor_parentId" class="acl_select" size="10">
		<option>Empty</option>
      </select><br />
    </td>
    <td width="80">
      <?php print $html->image('/acl/img/tango/32x32/actions/edit-redo.png', array( 'id'=>'acl_link_button','class' => 'acl_button')) ?>
    </td><td>
      <select id="aco_editor_parentId" class="acl_select" size="10">
		<option>Empty</option>
      </select><br />
    </td>
  </tr>
  <tr>
    <td colspan="3">
    <div id="aro_permissions"></div>
    </td>
  </tr>
  <tr>
    <td colspan="3">
    <div id="aco_permissions"></div>
    </td>
  </tr>
</table>
<script type="text/javascript">
$(document).ready(function() {
	acl_permission_setup();
});
</script>

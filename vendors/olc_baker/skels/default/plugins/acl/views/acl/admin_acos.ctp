<?php print $this->element('acl_scripts') ?>
<?php print $this->element('acl_menu') ?>
<div>
  <?php print $html->image('/acl/img/tango/32x32/apps/preferences-system-windows.png', array('align' => 'absmiddle')) ?>
  <b>Manage Acos</b>
  <span id="indicator" style="display:none;"><?php print $html->image('/acl/img/indicator.gif') ?> Loading.</span>
</div>
<table>
  <tr>
    <td>
      <select id="aco_editor_parentId" class="acl_select" size="10" >
		<option>Empty</option>
      </select>
      <input id="aco_editor_edit" type="button" value="Edit" >
    </td>
    <td>
      <table>
        <tr>
          <td>Alias</td>
          <td><input id="aco_editor_alias" type="text"></td>
        </tr>
        <tr>
          <td>Model</td>
          <td><input id="aco_editor_model" type="text"></td>
        </tr>
        <tr>
          <td>Key</td>
          <td><input id="aco_editor_foreignKey" type="text"></td>
        </tr>
      </table>
      <input id="aco_editor_id" type="hidden">
      <input id="aco_editor_originalParentId" type="hidden">
      <input id="aco_editor_create" type="button" value="Create">
      <input id="aco_editor_cancel" type="button" value="Cancel" style="display:none">
      <input id="aco_editor_update" type="button" value="Update" style="display:none">
      <input id="aco_editor_delete" type="button" value="Delete" style="display:none">
    </td>
  </tr>
</table>
<script type="text/javascript">
$(document).ready(function() {
	acl_aco_setup();
});
</script>
      

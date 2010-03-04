/* ACL Common Functions */
function indicator_show() {
	$('#indicator').show();
}
function indicator_hide() {
	$('#indicator').hide();
}

/* ARO functions */
function acl_aro_editor_load() {
	indicator_show();
	var id = $('#aro_editor_parentId').attr('value');
	$.ajax({
		url: acl_base_url + '/aclAros/load/' + id,
		dataType: 'json',
		success: function(data,textStatus) {
			$('#aro_editor_id').attr('value',data.id);
			$('#aro_editor_originalParentId').attr('value', data.parent_id);
			$('#aro_editor_alias').attr('value', data.alias);
			$('#aro_editor_model').attr('value',data.model);
			$('#aro_editor_foreignKey').attr('value',data.key);
			$('#aro_editor_create').hide();
			$('#aro_editor_update').show();
			$('#aro_editor_cancel').show();
			$('#aro_editor_delete').show();
			indicator_hide();
		}
	});
}

function acl_aro_editor_children(id) {
	indicator_show();
	$.ajax({
		url: acl_base_url + '/aclAros/children/' + id,
		dataType: 'html',
		success: function(data,textStatus) {
			$('#aro_editor_parentId').html(data);
			indicator_hide();
		}
	});
}
function acl_aro_editor_reload() {
	indicator_show();
	$.ajax({
		url: acl_base_url + '/aclAros/children',
		dataType: 'html',
		success: function(data,textStatus) {
			$('#aro_editor_parentId').html(data);
			indicator_hide();
		}
	});
}
function acl_aro_editor_delete() {
	indicator_show();
	var id = $('#aro_editor_parentId').attr('value');
	$.ajax({
		url: acl_base_url + '/aclAros/delete/' + id,
		success: function(data,textStatus) {
			acl_aro_editor_children($('#aro_editor_originalParentId').attr('value'));
			acl_aro_editor_cancel();
			indicator_hide();
		}
	});
}
function acl_aro_editor_cancel() {
	$('#aro_editor_id,#aro_editor_parentId,#aro_editor_alias,#aro_editor_foreignKey,#aro_editor_model').attr('value','');
	$('#aro_editor_create').show();
	$('#aro_editor_update').hide();
	$('#aro_editor_cancel').hide();
	$('#aro_editor_delete').hide();
}
function acl_aro_editor_create() {
	indicator_show();
	var parent_id = $('#aro_editor_parentId').attr('value');
	var alias     = $('#aro_editor_alias').attr('value');
	var key       = $('#aro_editor_foreignKey').attr('value');
	var model     = $('#aro_editor_model').attr('value');
	if (!parent_id) {
		parent_id = $('#aro_editor_defaultParentId').attr('value');
	}
	var h = {'data[AclAro][alias]':alias, 'data[AclAro][foreign_key]':key, 'data[AclAro][model]':model, 'data[AclAro][parent_id]':parent_id};
	$.ajax({
		url: acl_base_url + '/aclAros/add',
		data: h,
		type: 'POST',
		success: function(data,statusText) {
			acl_aro_editor_children(parent_id); 
			acl_aro_editor_cancel();
			indicator_hide();
		}
	});
}
function acl_aro_editor_update() {
	indicator_show();
	var id        = $('#aro_editor_id').attr('value');
	var parent_id = $('#aro_editor_parentId').attr('value');
	var alias     = $('#aro_editor_alias').attr('value');
	var key       = $('#aro_editor_foreignKey').attr('value');
	var model     = $('#aro_editor_model').attr('value');
	if (parent_id != id) {
		var h = {'data[AclAro][id]':id, 'data[AclAro][alias]':alias, 'data[AclAro][foreign_key]':key, 'data[AclAro][model]':model, 'data[AclAro][parent_id]':parent_id};
	} else {
		var h = {'data[AclAro][id]':id, 'data[AclAro][alias]':alias, 'data[AclAro][foreign_key]':key, 'data[AclAro][model]':model};
	}
	$.ajax({
		url: acl_base_url + '/aclAros/update',
		data: h,
		type: 'POST',
		success: function(data,statusText) {
			acl_aro_editor_children($('#aro_editor_parentId').attr('value'));
			acl_aro_editor_cancel();
			indicator_hide();
		}
	}) 
}
function acl_aro_setup() {
	// ondblclick="acl_aro_editor_children(this.value)
	$('#aro_editor_parentId').dblclick(function() {
		acl_aro_editor_children($(this).attr('value'));
	});

	$('#aro_editor_edit').click(acl_aro_editor_load);
	$('#aro_editor_create').click(acl_aro_editor_create);
	$('#aro_editor_cancel').click(acl_aro_editor_cancel);
	$('#aro_editor_update').click(acl_aro_editor_update);
	$('#aro_editor_delete').click(acl_aro_editor_delete);

	acl_aro_editor_reload();
}

/* ACO Functions */
function acl_aco_editor_load() {
	indicator_show();
	var id = $('#aco_editor_parentId').attr('value');
	$.ajax({
		url: acl_base_url + '/aclAcos/load/' + id,
		dataType: 'json',
		success: function(data,statusText) {
			$('#aco_editor_id').attr('value',data.id);
			$('#aco_editor_originalParentId').attr('value',data.parent_id);
			$('#aco_editor_alias').attr('value',data.alias);
			$('#aco_editor_model').attr('value',data.model);
			$('#aco_editor_foreignKey').attr('value',data.key);
			$('#aco_editor_create').hide();
			$('#aco_editor_update,#aco_editor_cancel,#aco_editor_delete').show();
			indicator_hide();
		}
	});
}
function acl_aco_editor_children(id) {
	indicator_show();
	$.ajax({
		url: acl_base_url + '/aclAcos/children/' + id,
		dataType: 'html',
		success: function(data,statusText) {
			$('#aco_editor_parentId').html(data);
			indicator_hide();
		}
	});
}

function acl_aco_editor_reload() {
	indicator_show();
	$.ajax({
		url: acl_base_url + '/aclAcos/children',
		dataType: 'html',
		success: function(data,statusText) {
			$('#aco_editor_parentId').html(data);
			indicator_hide();
		}
	});
}
function acl_aco_editor_delete() {
	indicator_show();
	var id = $('#aco_editor_parentId').attr('value');
	$.ajax({
		url: acl_base_url + '/aclAcos/delete/' + id,
		success: function(data,statusText) {
			acl_aco_editor_children($('#aco_editor_originalParentId').attr('value'));
			acl_aco_editor_cancel();
			indicator_hide();
		}
	});
}
function acl_aco_editor_cancel() {
	$('#aco_editor_id,#aco_editor_parentId,#aco_editor_alias,#aco_editor_foreignKey,#aco_editor_model').attr('value','');
	$('#aco_editor_create').show();
	$('#aco_editor_update,#aco_editor_cancel,#aco_editor_delete').hide();
}
function acl_aco_editor_create() {
	indicator_show();
	var parent_id = $('#aco_editor_parentId').attr('value');
	var alias     = $('#aco_editor_alias').attr('value');
	var key       = $('#aco_editor_foreignKey').attr('value');
	var model     = $('#aco_editor_model').attr('value');
	if (!parent_id) {
		parent_id = $('#aco_editor_defaultParentId').attr('value');
	}
	var h = {'data[AclAco][alias]':alias, 'data[AclAco][foreign_key]':key, 'data[AclAco][model]':model, 'data[AclAco][parent_id]':parent_id};
	$.ajax({
		url: acl_base_url + '/aclAcos/add',
		data: h,
		type: 'POST',
		success: function() {
			acl_aco_editor_children(parent_id); 
			acl_aco_editor_cancel();
			indicator_hide();
		}
	});
}
function acl_aco_editor_update() {
	indicator_show();
	var id        = $('#aco_editor_id').attr('value');
	var parent_id = $('#aco_editor_parentId').attr('value');
	var alias     = $('#aco_editor_alias').attr('value');
	var key       = $('#aco_editor_foreignKey').attr('value');
	var model     = $('#aco_editor_model').attr('value');
	if (parent_id != id) {
		var h = {'data[AclAco][id]':id, 'data[AclAco][alias]':alias, 'data[AclAco][foreign_key]':key, 'data[AclAco][model]':model, 'data[AclAco][parent_id]':parent_id};
	} else {
		h = {'data[AclAco][id]':id, 'data[AclAco][alias]':alias, 'data[AclAco][foreign_key]':key, 'data[AclAco][model]':model};
	}
	$.ajax({
		url: acl_base_url + '/aclAcos/update',
		data: h,
		type: 'POST',
		success: function() {
			acl_aco_editor_children($('#aco_editor_parentId').attr('value')); 
			acl_aco_editor_cancel();
			indicator_hide();
		}
	});
}
function acl_aco_setup() {
	$('#aco_editor_parentId').dblclick(function() {
		acl_aco_editor_children($(this).attr('value'));
	});

	$('#aco_editor_edit').click(acl_aco_editor_load);
	$('#aco_editor_create').click(acl_aco_editor_create);
	$('#aco_editor_cancel').click(acl_aco_editor_cancel);
	$('#aco_editor_update').click(acl_aco_editor_update);
	$('#aco_editor_delete').click(acl_aco_editor_delete);

	acl_aco_editor_reload();
}

/* Permissions */
function acl_aco_permission_refresh() {
	var aco_id = $('#aco_editor_parentId').attr('value');
	$.ajax({
		url: acl_base_url + '/aclPermissions/acos/' + aco_id,
		dataType: 'html',
		success: function(data,statusText) {
			$('#aco_permissions').html(data);
		}
	});
}
function acl_aro_permission_refresh() {
	var aro_id = $('#aro_editor_parentId').attr('value');
	$.ajax({
		url: acl_base_url + '/aclPermissions/aros/' + aro_id,
		dataType: 'html',
		success: function(data,statusText) {
			$('#aro_permissions').html(data);
		}
	});
}
/* PERMISSION */
function acl_permission_link() {
	var aro_id = $('#aro_editor_parentId').attr('value');
	var aco_id = $('#aco_editor_parentId').attr('value');
	var h = {'data[AclAroAco][aro_id]':aro_id, 'data[AclAroAco][aco_id]':aco_id};
	$.ajax({
		url: acl_base_url + '/aclPermissions/create',
		data: h,
		type: 'POST',
		success: function(data,statusText) {
			acl_aro_permission_refresh();
			acl_aco_permission_refresh();
		}
	});
}
function acl_permission_revoke(id) {
	if (confirm("You sure you want to revoke this ACL?")) {
		$.ajax({
			url: acl_base_url + '/aclPermissions/revoke/' + id,
			success: function(data,statusText) {
				acl_aro_permission_refresh();
				acl_aco_permission_refresh();
			}
		});
	}
}

function acl_permission_crud_update(el) {
	var id = $(el).parents('.acl_permission_item').attr('aro_aco');
	var crud = 'data[AclAroAco][' + $(el).attr('name').substring(4) + ']';
	var checked = $(el).attr('checked') ? '1' : '0';
	var h = { 'data[AclAroAco][id]': id };
	h[crud] = checked;
	$.ajax({
		url: acl_base_url + '/aclPermissions/crud',
		data: h,
		type: 'POST',
		success: function(data,statusText) {
		}
	});
}	

function acl_permission_setup() {
	$('#aro_editor_parentId').click(acl_aro_permission_refresh).dblclick(function(id) {
	 acl_aro_editor_children($(this).attr('value'));
	});
	$('#aco_editor_parentId').click(acl_aco_permission_refresh).dblclick(function(id) {
	 acl_aco_editor_children($(this).attr('value'));
	});
	$('#acl_link_button').click(acl_permission_link);
	$('.acl_permission_link').live('click',function() {
		var aro_aco_id = $(this).parent().attr('aro_aco');
		acl_permission_revoke(aro_aco_id);
	});
	$('.acl_permission_item input[type=checkbox]').live('change',function() {
		acl_permission_crud_update(this);
	});
	acl_aro_editor_reload();
	acl_aco_editor_reload();
}


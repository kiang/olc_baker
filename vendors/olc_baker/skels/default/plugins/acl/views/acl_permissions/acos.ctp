<div class="acl_permission_box">
  <div class="acl_permission_title"><?php print $aco ?> Access Granted To</div>
  <?php $i=0; foreach ($nodes as $k => $n) { $i++; ?>
    <div class="acl_permission_item <?php print ($i % 2 == 0) ? 'acl_row_even' : 'acl_row_odd' ?>" aro_aco="<?php echo $n['AclAroAco']['id'];?>" >
      <?php print $html->image('/acl/img/tango/16x16/actions/edit-undo.png', 
		array('class' => 'acl_permission_link')) ?>
      <?php print $k ?>
			<?php echo $this->element('crud',array('aro_aco'=>$n['AclAroAco'])); ?>
    </div>
<?php } ?>
</div>
</div>



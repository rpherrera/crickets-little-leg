<h2>Reports</h2>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Show all entries', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('View Iptables rules', true), array('action' => 'iptables')); ?></li>
		<li><?php echo $html->link(__('Remove all database entries', true), array('action' => 'remove', 'All'), array(), "Are you sure you wish to delete ALL database entries?"); ?></li>
	</ul>
</div>

<div class="entries form">
	<fieldset>
		<?php echo $form->create( 'Entry', array('type' => 'file') );?>
			<legend><?php __( 'Upload Log File' );?></legend>
			<?php echo $form->input('logfile', array('type'=>'file')); ?>
		<?php echo $form->end('Upload');?>
	</fieldset>
</div>

<div class="entries form">
	<fieldset>
		<?php echo $form->create( 'Entry' );?>
			<legend><?php __( 'System Log' );?></legend>
			<?php echo $form->input('logpath'); ?>
		<?php echo $form->end('Read');?>
	</fieldset>
</div>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Show all entries', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('View Iptables rules', true), array('action' => 'iptables')); ?></li>
		<li><?php echo $html->link(__('Remove all database entries', true), array('action' => 'remove', 'All'), array(), "Are you sure you wish to delete ALL database entries?"); ?></li>
	</ul>
</div>

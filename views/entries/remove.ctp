<h2><?php __('All database entries was removed.');?></h2>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Add more entries', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('Show all entries', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('View Iptables rules', true), array('action' => 'iptables')); ?></li>
		<li><?php echo $html->link(__('Remove all database entries', true), array('action' => 'remove', 'All'), array(), "Are you sure you wish to delete ALL database entries?"); ?></li>
	</ul>
</div>
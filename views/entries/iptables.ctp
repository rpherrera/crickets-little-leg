<h2><?php __('Iptables rules');?></h2>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Show all entries', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('Add more entries', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('Remove all database entries', true), array('action' => 'remove', 'All'), array(), "Are you sure you wish to delete ALL database entries?"); ?></li>
	</ul>
</div>

<div class="iptables form">
	<form action="#">
		<textarea name="iptables_rules" cols=60 rows=40><?php
foreach ($ip_entries as $ip_address) {
	echo 'iptables -I INPUT -s '.$ip_address.' -j DROP'."\n";
}
?></textarea>
	</form>
</div>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Show all entries', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('Add more entries', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('Remove all database entries', true), array('action' => 'remove', 'All'), array(), "Are you sure you wish to delete ALL database entries?"); ?></li>
	</ul>
</div>
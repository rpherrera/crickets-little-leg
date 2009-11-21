<h2><?php __('Entries');?></h2>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Add more entries', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('View Iptables rules', true), array('action' => 'iptables')); ?></li>
	</ul>
</div>

<fieldset id='Entries'>
	<?php echo $form->create( 'Entry', array('action'=>'show')); ?>
	<legend>Find by Date</legend>
	<label for="data_inicial">Initial Date</label>
	<?php echo $form->dateTime( 'data_inicial', 'DMY', '24', $data_inicial ); ?>
	<br/>
	<br/>
	<label for="data_final">Final Date</label>
	<?php echo $form->dateTime( 'data_final', 'DMY', '24', $data_final ); ?>
	<?php echo $form->end( 'Filter' ); ?>
</fieldset>

<div class="entries index">
	<p>
		<?php

		if( ! $no_busca ) {
		    $paginator->options(array('url' => array(strtotime($data_inicial), strtotime($data_final))));
		}

		echo $paginator->counter(array(
		    'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
		));

		?>
	</p>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $paginator->sort('id');?></th>
			<th><?php echo $paginator->sort('ip_address');?></th>
			<th><?php echo $paginator->sort('user');?></th>
			<th><?php echo $paginator->sort('incident_time');?></th>
			<th><?php echo $paginator->sort('country');?></th>
		</tr>

<?php

$i = 0;
foreach ($entries as $entry): $class = null;
if ($i++ % 2 == 0) {
	$class = ' class="altrow"';
}

?>
			<tr<?php echo $class;?>>
				<td><?php echo $entry['Entry']['id']; ?></td>
				<td><?php echo $entry['Entry']['ip_address']; ?></td>
				<td><?php echo $entry['Entry']['user']; ?></td>
				<td><?php echo $entry['Entry']['incident_time']; ?></td>
				<td><?php echo $entry['Entry']['country'] ?></td>
			</tr>
<?php endforeach; ?>

	</table>
</div>

<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	|
	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Add more entries', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('View Iptables rules', true), array('action' => 'iptables')); ?></li>
	</ul>
</div>
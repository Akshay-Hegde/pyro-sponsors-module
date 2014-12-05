<section class="title">
	<h4><?php echo lang('sponsors:item_list'); ?></h4>
</section>

<section class="item">
	<div class="content">
	<?php echo form_open('admin/sponsors/delete');?>
	<?php if (!empty($sponsors)): ?>
		<table border="0" class="table-list" cellspacing="0">
			<thead>
				<tr>
					<th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
					<th><?php echo lang('sponsors:name'); ?></th>
					<th>Category</th>
					<th></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5">
						<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody class="ui-sortable-container">
				<?php foreach( $sponsors as $item ): ?>
				<tr id="item_<?php echo $item->id; ?>">
					<td><?php echo form_checkbox('action_to[]', $item->id); ?></td>
					<td><?php echo $item->title; ?></td>
					<td><?php echo ($item->featured) ? 'featured': 'regular'; ?></td>
					<td class="actions">
						<?php echo
						//anchor('sponsors', lang('sponsors:view'), 'class="button" target="_blank"').' '.
						anchor('admin/sponsors/edit/'.$item->id, lang('sponsors:edit'), 'class="button"').' '.
						anchor('admin/sponsors/delete/'.$item->id, 	lang('sponsors:delete'), array('class'=>'button')); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div class="table_action_buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))); ?>
		</div>
	<?php else: ?>
		<div class="no_data"><?php echo lang('sponsors:no_items'); ?></div>
	<?php endif;?>
	<?php echo form_close(); ?>
</div>
</section>

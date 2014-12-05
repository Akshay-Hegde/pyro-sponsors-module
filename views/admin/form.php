<section class="title">
	<!-- We'll use $this->method to switch between sponsors.create & sponsors.edit -->
	<h4><?php echo lang('sponsors:'.$this->method); ?></h4>
</section>

<section class="item">
	<div class="content">
		<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>

		<div class="form_inputs">

			<ul class="fields">
			<?php if($allow_featured || $featured): ?>
				<li>
					<label for="featured">Feature count: <?php echo $feature_count ?> out of <?php echo $max_featured ?></label>
					<div class="input">
						<?php echo form_checkbox('featured', 1, $featured); ?>
					</div>
				</li>
			<?php else: ?>
				<li>
					<label for="featured">Feature count: <?php echo $feature_count ?> out of <?php echo $max_featured ?></label>
				</li>
			<?php endif; ?>
				<li>
					<label for="title">Title</label>
					<div class="input">
						<?php echo form_input("title", set_value("title", $title)); ?>
					</div>
				</li>
				<li>
					<label for="link">Link</label>
					<div class="input">
						<?php echo form_input("link", set_value("link", $link)); ?>
					</div>
				</li>
				<li>
					<label for="image">Image</label>
					<div class="input">
					<?php echo form_dropdown('image', $image_choices, $image); ?>
					</div>
				</li>
			<!-- <li>
				<label for="fileinput">Fileinput
					<?php if (isset($fileinput->data)): ?>
					<small>Current File: <?php echo $fileinput->data->filename; ?></small>
					<?php endif; ?>
					</label>
				<div class="input"><?php echo form_upload('fileinput', NULL, 'class="width-15"'); ?></div>
			</li> -->
		</ul>

	</div>

	<div class="buttons">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	</div>

	<?php echo form_close(); ?>
</div>
</section>

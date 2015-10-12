<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="searchLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" style="color: #a9a9a9;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="searchLabel">Search</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<?php
						echo $this->Form->create('User', array('type' => 'get',
							'action' => 'search',
							'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
								'label' => false,
								'div' => 'form-group',
								'class' => 'form-control',
								'required' => false)));
						
						echo $this->Form->input('search',
							array('label' => array('text' => 'User:', 'class' => 'control-label')));
						echo "<br />";
						echo $this->Form->end(array('label' => 'Search', 'class' => 'btn btn-default'));
						?>
					</div>
					<div class="col-sm-6">
						<?php
						echo $this->Form->create('Work', array('type' => 'get',
							'action' => 'search',
							'inputDefaults' => array('error' => array('attributes' => array('wrap' => 'span', 'class' => 'text-danger')),
								'label' => false,
								'div' => 'form-group',
								'class' => 'form-control',
								'required' => false)));
						
						echo $this->Form->input('search',
							array('label' => array('text' => 'Works:', 'class' => 'control-label')));
						echo "<br />";
						echo $this->Form->end(array('label' => 'Search', 'class' => 'btn btn-default'));
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
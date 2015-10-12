<div class="collapse navbar-collapse" id="homeNavbar">
	<ul class="nav navbar-nav">
		<li class="dropdown"><?php
		echo $this->Html->link(
		    'watch <span class="caret"></span>',
		    '#',
		    array('class' => 'dropdown-toggle', 'aria-expanded' => 'false', 'data-toggle' => 'dropdown', 'role' => 'button', 'escape' => false)
		);
		echo "<ul class=\"dropdown-menu\" role=\"menu\">";
			?>
			<li role="presentation"><?php
			echo $this->Html->link(
			    'main gallery',
			    array('controller' => 'works', 'action' => 'main'), array('role' => 'menuitem')
			);
			?></li>
			<li role="presentation"><?php
			echo $this->Html->link(
			    'initial gallery',
			    array('controller' => 'works', 'action' => 'initial'), array('role' => 'menuitem')
			);
			?></li>
			<li role="presentation"><?php
			echo $this->Html->link(
			    'entrees',
			    array('controller' => 'entrees', 'action' => 'index'), array('role' => 'menuitem')
			);
			?></li>
			<li role="presentation"><?php
			echo $this->Html->link(
			    'works of the week',
			    array('controller' => 'WorksOfTheWeeks', 'action' => 'index'), array('role' => 'menuitem')
			);
			?></li>
			<li role="presentation"><?php
			echo $this->Html->link(
			    'nominations',
			    array('controller' => 'WorksOfTheWeeks', 'action' => 'nominations'), array('role' => 'menuitem')
			);
			?></li>
			<li role="presentation">
                        <?php
                        echo $this->Html->link(
                            'users',
                            array('controller' => 'users', 'action' => 'index'),
                            array('role' => 'menuitem')
                        );
                        ?>
			</li>
			<?php
		echo "</ul>";
		?></li>
		<li class="dropdown"><?php
		echo $this->Html->link(
		    'read <span class="caret"></span>',
		    '#',
		    array('class' => 'dropdown-toggle', 'aria-expanded' => 'false', 'data-toggle' => 'dropdown', 'role' => 'button', 'escape' => false)
		);
		echo "<ul class=\"dropdown-menu\" role=\"menu\">";
			?>
			<li role="presentation"><?php
			echo $this->Html->link(
			    'forum',
			    array('controller' => 'forums', 'action' => 'index'),
			    array('role' => 'menuitem')
			);
			?></li>
			<li role="presentation"><?php
			echo $this->Html->link(
			    'news',
			    array('controller' => 'news', 'action' => 'index'),
			    array('role' => 'menuitem')
			);
			?></li>
			<?php
		echo "</ul>";
		?></li>
		<li class="dropdown"><?php
		echo $this->Html->link(
		    'categories <span class="caret"></span>',
		    '#',
		    array('class' => 'dropdown-toggle', 'aria-expanded' => 'false', 'data-toggle' => 'dropdown', 'role' => 'button', 'escape' => false)
		);
		echo "<ul class=\"dropdown-menu\" role=\"menu\">";
			$categories = $this->requestAction('/categories/sideCategories');
			foreach($categories as $category):
				echo "<li role=\"presentation\">";
				echo $this->Html->link($category['Category']['title'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id']), array('role' => 'menuitem'));
				echo "</li>";
			endforeach;
		echo "</ul>";
		?></li>
		<li class="dropdown"><?php
		echo $this->Html->link(
		    'gallery <span class="caret"></span>',
		    '#',
		    array('class' => 'dropdown-toggle', 'aria-expanded' => 'false', 'data-toggle' => 'dropdown', 'role' => 'button', 'escape' => false)
		);
		echo "<ul class=\"dropdown-menu\" role=\"menu\">";
			?>
			<li role="presentation"><?php
			echo $this->Html->link(
			    'contact us',
			    '/pages/contact_us',
			    array('role' => 'menuitem')
			);
			?></li>
			<li role="presentation"><?php
			echo $this->Html->link(
			    'termin and conditions',
			    '/pages/terms_condition',
			    array('role' => 'menuitem')
			);
			?></li>
			<li role="presentation"><?php
			echo $this->Html->link(
			    'privacy policy',
			    '/pages/privacy_policy',
			    array('role' => 'menuitem')
			);
			?></li>
			<?php
		echo "</ul>";
		?></li>
		<li>
			<?php
			echo $this->Html->link(
			    '<span class="glyphicon glyphicon-search" aria-hidden="true"></span>',
			    '#',
				array('data-toggle' => 'modal', 'role' => 'button', 'data-target' => '#search', 'escape' => false)
			);
			?>
		</li>
		<?php
		if($level > 2){
			echo "<li class=\"dropdown\">";
				$moderatorHeaderWaiting = $this->requestAction('/news/moderatorHeaderWaiting');
				if($moderatorHeaderWaiting > 0) {
					$moderatorHeaderWaiting = ' <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
				} else {
					$moderatorHeaderWaiting = "";
				}
				
				$moderatorHeaderNoEntrees = $this->requestAction('/entrees/moderatorHeaderNoEntrees');
				if ($moderatorHeaderNoEntrees == 0) {
					$moderatorHeaderNoEntrees = ' <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
				} else {
					$moderatorHeaderNoEntrees = "";
				}
				
				echo $this->Html->link(
				    'moderator <span class="caret"></span>'.$moderatorHeaderWaiting . $moderatorHeaderNoEntrees,
				    '#',
				    array('class' => 'dropdown-toggle', 'aria-expanded' => 'false', 'data-toggle' => 'dropdown', 'role' => 'button', 'escape' => false)
				);
				echo "<ul class=\"dropdown-menu\" role=\"menu\">";
					echo "<li role=\"presentation\">";
					echo $this->Html->link(
					    'users',
					    array('controller' => 'users', 'action' => 'moderatorIndex'),
					    array('role' => 'menuitem')
					);
					echo "</li>";
					echo "<li role=\"presentation\">";
					echo $this->Html->link(
					    'news - awaiting'.$moderatorHeaderWaiting,
					    array('controller' => 'news', 'action' => 'moderatorIndexWaiting'),
					    array('role' => 'menuitem', 'escape' => false)
					);
					echo "</li>";
					echo "<li role=\"presentation\">";
					echo $this->Html->link(
					    'news - removed',
					    array('controller' => 'news', 'action' => 'moderatorIndexNotActivated'),
					    array('role' => 'menuitem')
					);
					echo "</li>";
					echo "<li role=\"presentation\">";
					echo $this->Html->link(
					    'news - accepted',
					    array('controller' => 'news', 'action' => 'moderatorIndexActivated'),
					    array('role' => 'menuitem')
					);
					echo "</li>";
					echo "<li role=\"presentation\">";
					echo $this->Html->link(
					    'entrees'.$moderatorHeaderNoEntrees,
					    array('controller' => 'entrees', 'action' => 'moderatorIndex'),
					    array('role' => 'menuitem', 'escape' => false)
					);
					echo "</li>";
					echo "<li role=\"presentation\">";
					echo $this->Html->link(
					    'register',
					    array('controller' => 'registers', 'action' => 'index'),
					    array('role' => 'menuitem')
					);
					echo "</li>";
				echo "</ul>";
			echo "</li>";
		}
		?>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<?php
		if(!isset($user_id)){
			echo "<li>";
				echo $this->Html->link(
				    'login',
				    '#',
				    array('data-toggle' => 'modal', 'role' => 'button', 'data-target' => '#login')
				);
			echo "</li>";
			echo "<li>";
			echo $this->Html->link(
			    'registration',
			    array('controller' => 'users', 'action' => 'register'),
			    array('role' => 'button')
			);
			echo "</li>";
		} else {
			echo "<li class=\"dropdown\">";
				echo $this->Html->link(
				    $this->App->showAvatarHeaderMenu($user_id, $is_avatar) . ' ' . $this->App->formatLevel($level, $master_level) . $username . '<span class="caret"></span>',
				    '#',
				    array('class' => 'dropdown-toggle', 'aria-expanded' => 'false', 'data-toggle' => 'dropdown', 'role' => 'button', 'escape' => false)
				);
				echo "<ul class=\"dropdown-menu\" role=\"menu\">";
					
					echo "<li role=\"presentation\" class=\"dropdown-header\">gallery</li>";
					echo "<li role=\"presentation\">";
						echo $this->Html->link('my gallery', array('controller' => 'works', 'action' => 'user', $user_id), array('role' => 'menuitem'));
					echo "</li>";
					echo "<li role=\"presentation\">";
						echo $this->Html->link('add work', array('controller' => 'works', 'action' => 'add'), array('role' => 'menuitem'));
					echo "</li>";
					
					echo "<li role=\"presentation\" class=\"divider\"></li>";
					echo "<li role=\"presentation\" class=\"dropdown-header\">news</li>";
					echo "<li role=\"presentation\">";
						echo $this->Html->link('my news', array('controller' => 'news', 'action' => 'indexMy'), array('role' => 'menuitem'));
					echo "</li>";
					echo "<li>";
						echo $this->Html->link('add news', array('controller' => 'news', 'action' => 'add'), array('role' => 'menuitem'));
					echo "</li>";
					
					echo "<li role=\"presentation\" class=\"divider\"></li>";
					echo "<li role=\"presentation\" class=\"dropdown-header\">profil</li>";
					echo "<li role=\"presentation\">";
						echo $this->Html->link('edit', array('controller' => 'users', 'action' => 'edit', $user_id), array('role' => 'menuitem'));
					echo "</li>";
					echo "<li role=\"presentation\">";
						echo $this->Html->link('avatar', array('controller' => 'users', 'action' => 'editAvatar', $user_id), array('role' => 'menuitem'));
					echo "</li>";
					echo "<li role=\"presentation\">";
						echo $this->Html->link('photo', array('controller' => 'users', 'action' => 'editPhoto', $user_id), array('role' => 'menuitem'));
					echo "</li>";
					echo "<li role=\"presentation\">";
						echo $this->Html->link('password', array('controller' => 'users', 'action' => 'editPassword', $user_id), array('role' => 'menuitem'));
					echo "</li>";
					echo "<li role=\"presentation\">";
						echo $this->Html->link('messages', array('controller' => 'messages', 'action' => 'inbox'), array('role' => 'menuitem'));
					echo "</li>";
					
					echo "<li role=\"presentation\" class=\"divider\"></li>";
					echo "<li role=\"presentation\" class=\"dropdown-header\">users</li>";
					echo "<li role=\"presentation\">";
						echo $this->Html->link('favorite', array('controller' => 'LikeGalleries', 'action' => 'view'), array('role' => 'menuitem'));
					echo "</li>";
					echo "<li role=\"presentation\">";
						echo $this->Html->link('blocked', array('controller' => 'DontLikeGalleries', 'action' => 'view'), array('role' => 'menuitem'));
					echo "</li>";
					
					echo "<li role=\"presentation\" class=\"divider\"></li>";
					echo "<li role=\"presentation\">";
						echo $this->Html->link('log out', array('controller' => 'users', 'action' => 'logout'), array('role' => 'menuitem'));
					echo "</li>";
					
				echo "</ul>";
			echo "</li>";
			echo "<li>";
			echo $this->Html->link(
			    '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>',
			    array('controller' => 'works', 'action' => 'add'),
			    array('role' => 'button', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'add work', 'escape' => false)
			);
			echo "</li>";
			echo "<li>";
			$countNewMessages = $this->requestAction('/messages/homeNewMessages');
			if ($countNewMessages > 0) {
				echo $this->Html->link('<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="badge">' . $countNewMessages . '</span>', array('controller' => 'messages', 'action' => 'inbox'), array('role' => 'button', 'escape' => false));
			} else {
				echo $this->Html->link('<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>', array('controller' => 'messages', 'action' => 'inbox'), array('role' => 'button', 'escape' => false));
			}
			echo "</li>";
			
			$countNewComments = $this->requestAction('/comments/homeNewMessages');
			$newWorksComments = $this->requestAction('/worksComments/homeNewMessages');
			$newNewsComments = $this->requestAction('/newsComments/homeNewMessages');
			
			$countWorksComments = count($newWorksComments);
			$countNewsComments = count($newNewsComments);
			
			$countSum = $countNewComments + $countWorksComments + $countNewsComments;
			
			if ($countSum > 0) {
				echo "<li class=\"dropdown\">";
					echo $this->Html->link('<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <span class="badge">' . $countSum . '</span>',
					'#',
					array('class' => 'dropdown-toggle', 'aria-expanded' => 'false', 'data-toggle' => 'dropdown', 'role' => 'button', 'escape' => false));
						echo "<ul class=\"dropdown-menu\" role=\"menu\">";
							if($countNewComments > 0) {
								echo "<li role=\"presentation\">";
									echo $this->Html->link('in your gallery <span class="badge">' . $countNewComments . '</span>', array('controller' => 'comments', 'action' => 'user', $user_id), array('role' => 'menuitem', 'escape' => false));
								echo "</li>";
							}
							
							foreach($newWorksComments as $newWorksComment):
								echo "<li role=\"presentation\">";
									echo $this->Html->link(
									    'in your work ['. $newWorksComment['Work']['title'] .']',
									    array('controller' => 'works', 'action' => 'view', $newWorksComment['Work']['id']),
									    array('role' => 'menuitem')
									);
								echo "</li>";
							endforeach;
							
							foreach($newNewsComments as $newNewsComment):
								echo "<li role=\"presentation\">";
									echo $this->Html->link(
									    'in your news ['. $newNewsComment['News']['title'] .']',
									    array('controller' => 'news', 'action' => 'view', $newNewsComment['News']['id']),
									    array('role' => 'menuitem')
									);
								echo "</li>";
							endforeach;
						echo "</ul>";
				echo "</li>";
			}
			
			$newNewWorksInLikeGalleries = $this->requestAction('/NewWorksInLikeGalleries/homeNewMessages');
			
			$countNewWorksInLikeGalleries = count($newNewWorksInLikeGalleries);
			
			if($countNewWorksInLikeGalleries > 0){
				echo "<li class=\"dropdown\">";
					echo $this->Html->link('<span class="glyphicon glyphicon-picture" aria-hidden="true"></span> <span class="badge">' . $countNewWorksInLikeGalleries . '</span>',
					'#',
					array('class' => 'dropdown-toggle', 'aria-expanded' => 'false', 'data-toggle' => 'dropdown', 'role' => 'button', 'escape' => false));
					echo "<ul class=\"dropdown-menu\" role=\"menu\">";
						foreach($newNewWorksInLikeGalleries as $newNewWorksInLikeGallery):
							echo "<li role=\"presentation\">";
								echo $this->Html->link(
								    $newNewWorksInLikeGallery['Work']['title'],
								    array('controller' => 'works', 'action' => 'view', $newNewWorksInLikeGallery['Work']['id']),
								    array('role' => 'menuitem')
								);
							echo "</li>";
						endforeach;
					echo "</ul>";
				echo "</li>";
			}
		}
		?>
	</ul>
</div>
<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {
	public $helpers = array('Html', 'Paginator', 'Form');
	
	
	
	public function formatLevel($level, $master_level) {
		if($master_level == 1) {
			$master_level = "Red";
		} else {
			$master_level = "";
		}
		
		if($level == 0) {
			$level = "<span class=\"rangi$master_level\">~</span>";
		} elseif($level == 1) {
			$level = "<span class=\"rangi$master_level\">&#8226;</span>";
		} elseif($level == 2) {
			$level = "<span class=\"rangi$master_level\">^</span>";
		} elseif($level == 3) {
			$level = "<span class=\"rangi$master_level\">*</span>";
		} elseif($level == 4) {
			$level = "<span class=\"rangi$master_level\">&#170;</span>";
		}
		return $level;
	}
	
	public function showAvatar($user_id, $is_avatar) {
		$avatar = "avatar_d.gif";
		if ($is_avatar == 1){
			$avatar = "avatars/$user_id.jpg";
		} elseif ($is_avatar == 2){
			$avatar = "avatars/$user_id.gif";
		}
		return $this->Html->image($avatar);
	}
	
	public function showAvatarMediaObject($user_id, $is_avatar) {
		$avatar = "avatar_d.gif";
		if ($is_avatar == 1){
			$avatar = "avatars/$user_id.jpg";
		} elseif ($is_avatar == 2){
			$avatar = "avatars/$user_id.gif";
		}
		return $this->Html->image($avatar, array('class' => 'media-object'));
	}
	
	public function showAvatarHeaderMenu($user_id, $is_avatar) {
		$avatar = "avatar_d.gif";
		if ($is_avatar == 1){
			$avatar = "avatars/$user_id.jpg";
		} elseif ($is_avatar == 2){
			$avatar = "avatars/$user_id.gif";
		}
		return $this->Html->image($avatar, array('style' => 'height: auto; width: 22px;'));
	}
	
	public function showAvatarForum($user_id, $is_avatar) {
		$avatar = "avatar_d.gif";
		if ($is_avatar == 1){
			$avatar = "avatars/$user_id.jpg";
		} elseif ($is_avatar == 2){
			$avatar = "avatars/$user_id.gif";
		}
		return $this->Html->image($avatar, array('style' => 'border: 0;'));
	}
	
	public function showPhoto($user_id, $is_photo){
		if ($is_photo == 1){
			return $this->Html->image("photos/$user_id.jpg", array('style' => 'border: 0;'));
		} else {
			return "";
		}
	}
	
	public function showNewsStatus($news){
		$status = "Accepted";
		if ($news['News']['is_activated'] == 0){
			$status = "Awainting";
		} elseif ($news['News']['is_activated'] == 1) {
			$status = "Accepted";
		} elseif ($news['News']['is_activated'] == 2){
			$status = "Not accepted";
		}
		return $status;
	}
	
	public function showMiniWorkWithDetails($is_of_age, $work){
		
			echo $this->Html->link(
			$this->showOnlyMiniWork($work['User']['id'], $work['Work']['file_name'], $work['Work']['title'], $work['Work']['is_for_of_age'], $is_of_age),
			array('controller' => 'works', 'action' => 'view', $work['Work']['id']),
			array('escapeTitle' => false));
			
			echo '<h5>'.$work['Work']['title'].'<br /><small>';
			
			echo $this->Html->link(
			$this->formatLevel($work['User']['level'], $work['User']['master_level']) . $work['User']['username'],
			array('controller' => 'users', 'action' => 'view', $work['User']['id']),
			array('escapeTitle' => false));
			
			echo "</small></h5>";
		
	}
	
	public function showMiniWorkEntree($is_of_age, $work){
			
			echo $this->Html->link(
			$this->showOnlyMiniWork($work['Work']['User']['id'], $work['Work']['file_name'], $work['Work']['title'], $work['Work']['is_for_of_age'], $is_of_age),
			array('controller' => 'works', 'action' => 'view', $work['Work']['id']),
			array('escapeTitle' => false));
			
			echo '<h5>'.$work['Work']['title'].'<br /><small>';
			
			echo $this->Html->link(
			$this->formatLevel($work['Work']['User']['level'], $work['Work']['User']['master_level']) . $work['Work']['User']['username'],
			array('controller' => 'users', 'action' => 'view', $work['Work']['User']['id']),
			array('escapeTitle' => false));
			
			echo "</small></h5>";
			
	}
	
	public function showMiniWorkWithDetailsHome($is_of_age, $work){
		
			echo $this->Html->link(
			$this->showOnlyMiniWork($work['User']['id'], $work['Work']['file_name'], $work['Work']['title'], $work['Work']['is_for_of_age'], $is_of_age),
			array('controller' => 'works', 'action' => 'view', $work['Work']['id']),
			array('escapeTitle' => false));
			
			echo '<h5>'.$work['Work']['title'].'<br /><small>';
			
			echo $this->Html->link(
			$this->formatLevel($work['User']['level'], $work['User']['master_level']).''.$work['User']['username'],
			array('controller' => 'users', 'action' => 'view', $work['User']['id']),
			array('escapeTitle' => false));
			
			echo "</small></h5>";
			
		
	}
	
	public function showMiniWorkInUserHome($is_of_age, $work){
		
		echo $this->Html->link(
		$this->showOnlyMiniWork($work['User']['id'], $work['Work']['file_name'], $work['Work']['title'], $work['Work']['is_for_of_age'], $is_of_age),
		array('controller' => 'works', 'action' => 'view', $work['Work']['id']),
		array('escapeTitle' => false));
		
		echo '<h5>'.$work['Work']['title'].'</h5>';
		
		if(AuthComponent::user('id') == $work['User']['id']){
			
			//edytowanie
			echo $this->Html->link('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', array('controller' => 'works', 'action' => 'edit', $work['Work']['id']), array('escape' => false));
			
			echo " ";
		}
		
		if(AuthComponent::user('id') == $work['User']['id'] OR AuthComponent::user('level') > 2){
			
			//usuwanie
			echo $this->Form->postLink('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', array('controller' => 'works', 'action' => 'delete', $work['Work']['id']), array('escape' => false), ('Do you really want to remove this work?'));
			
		}
	}
	
	public function showMiniWorkWithDetailsInteresting($is_of_age, $work){
		
			echo $this->Html->link(
			$this->showOnlyMiniWork($work['User']['id'], $work['Work']['file_name'], $work['Work']['title'], $work['Work']['is_for_of_age'], $is_of_age),
			array('controller' => 'works', 'action' => 'view', $work['Work']['id']),
			array('escapeTitle' => false));
			
			echo '<h5>'.$work['Work']['title'].'<br /><small>';
			
			echo $this->Html->link(
			$this->formatLevel($work['User']['level'], $work['User']['master_level']).''.$work['User']['username'],
			array('controller' => 'users', 'action' => 'view', $work['User']['id']),
			array('escapeTitle' => false));
			
			echo "</small></h5>";
	}
	
	public function showMiniWorkwotW($is_of_age, $work){
			echo $this->Html->link(
			$this->showOnlyMiniWork($work['Work']['User']['id'], $work['Work']['file_name'], $work['Work']['title'], $work['Work']['is_for_of_age'], $is_of_age),
			array('controller' => 'works', 'action' => 'view', $work['Work']['id']),
			array('escapeTitle' => false));
			
			echo '<h5>'.$work['Work']['title'].'<br /><small>';
			
			echo $this->Html->link(
			$this->formatLevel($work['Work']['User']['level'], $work['Work']['User']['master_level']).''.$work['Work']['User']['username'],
			array('controller' => 'users', 'action' => 'view', $work['Work']['User']['id']),
			array('escapeTitle' => false));
			
			echo "</small></h5>";
	}
	
	public function showOnlyMiniWork($user_id, $file_name, $title, $is_for_of_age, $is_of_age){
		$imgUrl = "osiemnascie_96.gif";
		if ($is_for_of_age == 1 AND ($is_of_age == 0 OR $is_of_age == 1)){
			$imgUrl = "osiemnascie_96.gif";
		} else {
			$imgUrl = "works/minis/mini/$user_id/".$user_id."_".$file_name."";
		}
		return $this->Html->image($imgUrl, array('class' => 'img-responsive'));
	}
	
	public function showMiniWorkInGallery($userIdFromUrl, $work, $is_of_age, $level){
		echo "<div class=\"dContentMiniaturka\">";
			$imgUrl = "osiemnascie_96.gif";
			if ($work['Work']['is_for_of_age'] == 1 AND ($is_of_age == 0 OR $is_of_age == 1)){
				$imgUrl = "osiemnascie_96.gif";
			} else {
				$imgUrl = "works/minis/supermini/$userIdFromUrl/".$userIdFromUrl."_".$work['Work']['file_name']."";
			}
			echo $this->Html->link($this->Html->image($imgUrl, array('alt' => $work['Work']['title'], 'style' => 'border: 0;')), "/works/view/".$work['Work']['id']."", array('escapeTitle' => false));
		echo "</div>";
		if($userIdFromUrl == AuthComponent::user('id') OR AuthComponent::user('level') > 2){
			echo "<div class=\"dContentOpisNWorks\">";
			
			//usuwanie
			echo("<div class=\"dContentOpisDelLink\">");
				echo $this->Form->postLink(($this->Html->image('spacer.gif')), array('controller' => 'works', 'action' => 'delete', $work['Work']['id']), array('escape' => false), ('Do you really want to remove this work?'));
			echo("</div>");
			
			//edytowanie
			echo("<div class=\"dContentOpisEditLink\">");
				echo $this->Html->link(($this->Html->image('spacer.gif')), array('controller' => 'works', 'action' => 'edit', $work['Work']['id']), array('escape' => false));
			echo("</div>");
			
			
		} else {
			echo "<div class=\"dContentOpis\">";
		}
			
			
			echo "<div class=\"titleObrazListaFont\"><strong>".$work['Work']['title']."</strong>";
				
			echo "</div>";
			
			echo $work['Work']['description'];
			
		echo "</div>";
		echo "<div class=\"cleaner\"></div><br />";
	}
	
	public function showComment($comment, $contentType){
		if($contentType == "user"){
			$modelName = "Comment";
			$controllerName = "Comments";
		} else if ($contentType == "work"){
			$modelName = "WorksComment";
			$controllerName = "WorksComments";
		} else if ($contentType == "news"){
			$modelName = "NewsComment";
			$controllerName = "NewsComments";
		}
		
		
		echo "<div class=\"media\">";
			echo "<div class=\"media-left\">";
				echo $this->showAvatarMediaObject($comment['Author']['id'], $comment['Author']['is_avatar']);
			echo "</div>";
			echo "<div class=\"media-body\">";
				echo "<small>";
					echo $this->Html->link(''.$this->formatLevel($comment['Author']['level'], $comment['Author']['master_level']).''.$comment['Author']['username'].'', array('controller' => 'users', 'action' => 'view', $comment['Author']['id']), array('escape' => false));
					
					echo " | ".$comment[$modelName]['date']."";
					
					if(AuthComponent::user('level') > 2){
						echo " | ";
						echo $this->Form->postLink('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', array('controller' => $controllerName, 'action' => 'delete', $comment[$modelName]['id']), array('escape' => false), ('Do you really want to remove this comment?'));
						
					}
					
				echo "</small>";
				echo "<br />";
				echo $comment[$modelName]['c_text'];
			echo "</div>";
		echo "</div>";
		
	}
}
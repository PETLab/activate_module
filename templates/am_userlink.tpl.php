<?php
if( user_is_logged_in() ){ 
/* User link template*/ 
	global $base_url, $user, $theme;
	$admin_theme = variable_get('admin_theme');
	$current_path = request_path();	
	$current_url = $base_url."/".$current_path;
	$games = false;
	/*If path is for current user listing, set game flag*/
	if($current_path == 'play-a-game/my-games'){
		$games = true;
		$user_game_link = $base_url.'/play-a-game/' . $user->name . '/list';
	}
	/*Lets not show this if it is the admin theme*/
	if($theme != $admin_theme){
		/*Toggling of userlinks for user profile*/
		?>
		<div class="user_links">
			<div class="user_link account-link">
				<?php 
				if($games){
					print l(t('My profile'),'user/' . $user->uid . '/edit');
			
				}else{ 
					print 'My profile';
				} ?>
			</div>
			<div class="seperator">&nbsp;&nbsp;|&nbsp;&nbsp;</div>
			<div class="user_link games-link">
				<?php 
				if($games){
					print 'My games';
				}else{
					print l(t('My games'),'play-a-game/my-games');
				}?>		
			</div>
			
		</div>
        <div class="user_link game-add">
				<?php if($games){
					print l(t('Add a game'), 'node/add/game', array('attributes' => array('class' => array('button'))));
				} ?>		
		</div>	
		<?php 
		/*Games specific markup for grabbing public url*/
		if($games){ ?>
			<div class="user_games">
				<div class="form-item form-type-textfield">
					<label for="edit-userlink">Weblink for your games: </label>
					<input class="form-text" type="text" id="edit-userlink" value="<?php echo($user_game_link)?>" readonly="TRUE" onfocus="select();"/>
					<!--<div class="description"><a href="<?php //echo($user_game_link)?>">Go to link</a> | <a id='user-link-copy' href="#">copy</a></div>-->
                    <span class="description">Copy this link by selecting the field’s content and pressing ctrl+c!</span>
				</div>
				<script type="text/javascript">
					/*Code snippet for copy link and browser compatibility of focus function when textfield is readonly*/
					jQuery(document).ready(function() {
						jQuery('#user-link-copy').click(function(){ jQuery("#edit-userlink").focus(); return false; });
						jQuery("#edit-userlink").mouseup(function(e){
							e.preventDefault();
							return false;
						});
					});
				</script>
			</div>
		<?php
		}/*Closes games markup conditional*/
	}/*Closes admin theme conditional*/
}else{
	/*Redirect users to login screen if not logged in*/
	drupal_goto('user/login');
}/*Closes user logged in condtional*/
?>
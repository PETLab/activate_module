<?php 
	/* Challegne software cookie widget template*/ 
	global $base_url;
	$current_url = $base_url."/".request_path();
	
	/*Make Sure jquery cookie is loaded*/
	drupal_add_library('system', 'jquery.cookie');
	
	/*Beauty Tips: Lets add the tip for instruction switch*/
	if( module_exists( 'beautytips' ) ) {
		$options['bt_drupal_view_activate_software_tip'] = array(
			'cssSelect' => '#block-activate-module-am-software-select-bk .link',
			'text' => t('View instructions for '.$pParamHash[$pParamHash['other_software']]->name.' from this point forward.'),
			'trigger' => array('mouseover', 'mouseout'),
			'width' => 200,
		);
		/*Add libs for beauty tip*/
		activate_module_add_html_head();
		beautytips_add_beautytips($options);
	}
?>
<div class="">
	<div class="title active">Showing instructions for <?php echo($pParamHash[$pParamHash['current_software']]->name );?> </div>
	<div class="link"><a href="javascript:void(0)" onclick="softwareSwitch(<?php echo($pParamHash[$pParamHash['other_software']]->tid);?> );">Change to <?php echo($pParamHash[$pParamHash['other_software']]->name );?></a></div>
</div>
<?php namespace kebabble\settings;

defined( 'ABSPATH' ) or die( 'Operation not permitted.' );

class settings {
	public function page() {
		add_options_page( 
			'Kebabble', 
			'Kebabble', 
			'manage_options', 
			'kebabble', 
			[&$this, 'optionsPage']
		);
	}

	public function optionsPage() { 
		?>
		<form action='options.php' method='post'>
	
			<h2>kebabble</h2>
	
			<?php
			settings_fields( 'pluginPage' );
			do_settings_sections( 'pluginPage' );
			submit_button();
			?>
	
		</form>
		<?php
	}

	public function settings() {
		register_setting( 'pluginPage', 'kbfos_settings' );
		
			add_settings_section(
				'kbfos_pluginPage_section', 
				__( 'Slack Configuration', 'text_domain' ), 
				function() {
					echo __( 'Configure Kebabble to use your Slack.', 'text_domain' );
				}, 
				'pluginPage'
			);
		
			add_settings_field( 
				'kbfos_botkey', 
				__( 'Slack Bot Auth key', 'text_domain' ), 
				function () {
					$options = get_option( 'kbfos_settings' );
					?>
					<input type='text' name='kbfos_settings[kbfos_botkey]' value='<?php echo $options['kbfos_botkey']; ?>'>
					<?php
				}, 
				'pluginPage', 
				'kbfos_pluginPage_section' 
			);
		
			add_settings_field( 
				'kbfos_botchannel', 
				__( 'Slack Channel', 'text_domain' ), 
				function() {
					$options = get_option( 'kbfos_settings' );
					?>
					<input type='text' name='kbfos_settings[kbfos_botchannel]' value='<?php echo $options['kbfos_botchannel']; ?>'>
					<?php
				}, 
				'pluginPage', 
				'kbfos_pluginPage_section' 
			);
	}
}
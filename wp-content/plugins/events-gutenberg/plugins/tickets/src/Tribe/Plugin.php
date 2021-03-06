<?php
/**
 * Simple file to correctly have the plugin assets be loaded
 *
 * @todo  Remove once merged into actual Plugin
 */
class Tribe__Gutenberg__Tickets__Plugin {
	/**
	 * The semantic version number of this extension; should always match the plugin header.
	 *
	 * @since TBD
	 */
	const VERSION = Tribe__Gutenberg__Plugin::VERSION;

	/**
	 * The constructor; delays initializing the extension until all other plugins are loaded.
	 *
	 * @since TBD
	 */
	public function __construct() {
		// Setup the Configuration file
		$this->plugin_file = str_replace( '/src/Tribe/', '/', __FILE__ );
		$this->plugin_path = trailingslashit( dirname( $this->plugin_file ) );
		$this->plugin_dir = trailingslashit( basename( $this->plugin_path ) );
		$this->plugin_url = plugins_url( $this->plugin_dir );
	}
}

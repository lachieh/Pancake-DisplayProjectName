<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Numbering System
 *
 * A simple numbering system for PancakeApp. Introducing the new plugin system.
 *
 * @author		Lachlan Heywood
 * @copyright	Copyright (c) 2015, Hellotimber
 * @link		http://www.github.com/lachieh/pancake_display_project_name
 * @since		Version 1.0
 */
class Plugin_Displayprojectname extends Plugin {
	/**
	 * Some configuration for the plugin
	 */
	public $alias = 'Display_project_name';
	
	public $name = array(
		'en'	=> 'Display Project Name',
	);
	
	public $description = array(
		'en'	=> 'A simple plugin to enable the display of the project name on invoices. Call by echoing Plugin_Displayprojectname::get_project_name_by_id($id) somewhere in your frontend theme.',
	);
	
	public $author = 'Hellotimber';
	
	public $url = 'http://www.hellotimber.com/';
	
	/**
	 * Configurables for the plugin and their default values
	 */
	 
	public $config = array(
		'fields' => array(),
	);
	
	
	/**
	 * Nothing interesting here...
	 */
	
	private $ci;
	
	private $installed = FALSE;
	
	protected static $project_details;
	
	public function __construct() {
		$this->ci =& get_instance();
		
		$this->ci->load->model('plugins_m');
		
		$this->installed = $this->get("installed");
		
		if ($this->installed) {
			// Only register events when the plugin is installed
			$this->register_events();
		}
	}
	
	public static function get_project_name_by_id($project_id) {
		$CI = get_instance()->load->model('project_m');
		self::$project_details = $CI->project_m->get_project_by_id($project_id)->row();
		$projectname = self::$project_details->name;
		return $projectname;
	}

}
/* End of file */
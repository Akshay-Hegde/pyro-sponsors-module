<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Create and manage the sponsors section.
 *
 * @author 		WARPAINT Media
 * @website		http://warpaintmedia.ca/
 * @package 	PyroCMS
 * @subpackage 	Sponsors
 * @copyright 	MIT
 */
class Module_Sponsors extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Sponsors'
				),
			'description' => array(
				'en' => 'Create and manage the sponsors section.'
				),
			'frontend' => false,
			'backend' => true,
			'menu' => 'content', // You can also place modules in their top level menu. For example try: 'menu' => 'Sponsors',
			'sections' => array(
				'items' => array(
					'name' 	=> 'sponsors:items', // These are translated from your language file
					'uri' 	=> 'admin/sponsors',
					'shortcuts' => array(
						'create' => array(
							'name' 	=> 'sponsors:create',
							'uri' 	=> 'admin/sponsors/create',
							'class' => 'add'
							)
						)
					)
				)
			);
	}

	public function install()
	{
		$this->dbforge->drop_table('sponsors');

		$this->load->library('files/files');
		Files::create_folder(0, 'sponsors');

		$sponsors = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '11',
				'auto_increment' => TRUE
				),
			'order' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => true
				),
			'featured' => array(
				'type' => 'TINYINT',
				'constraint' => '1',
				'default' => 0,
				),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				),
			'link' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => true
				),
			'image' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				),

			);

		$this->dbforge->add_field($sponsors);
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('sponsors') AND
			is_dir($this->upload_path.'sponsors') OR @mkdir($this->upload_path.'sponsors',0777,TRUE))
		{
			return TRUE;
		}
	}

	public function uninstall()
	{
		$this->load->library('files/files');
		$this->load->model('files/file_folders_m');
		$folder = $this->file_folders_m->get_by('name', 'sponsors');
		Files::delete_folder($folder->id);
		$this->dbforge->drop_table('sponsors');
		{
			return TRUE;
		}
	}


	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
	}
}
/* End of file details.php */

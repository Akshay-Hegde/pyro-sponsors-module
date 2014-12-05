<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Create and manage the friends and sponsors section.
 *
 * @author 		WARPAINT Media
 * @website		http://warpaintmedia.ca/
 * @package 	PyroCMS
 * @subpackage 	Sponsors
 * @copyright 	MIT
 */
class sponsors_m extends MY_Model {

	private $folder;

	public function __construct()
	{
		parent::__construct();
		$this->_table = 'sponsors';
		// $this->load->model('files/file_folders_m');
		// $this->load->library('files/files');
		// $this->folder = $this->file_folders_m->get_by('name', 'sponsors');
	}

	//create a new item
	public function create($input)
	{
		// $fileinput = Files::upload($this->folder->id, FALSE, 'fileinput');
		$to_insert = array(
			// 'fileinput' => json_encode($fileinput);
			'featured' => isset($input['featured']) ? 1: 0,
			'title' => $input['title'],
			'link' => $input['link'],
			'image' => $input['image']
			);

		return $this->db->insert('sponsors', $to_insert);
	}

	//edit a new item
	public function edit($id = 0, $input)
	{
		// $fileinput = Files::upload($this->folder->id, FALSE, 'fileinput');
		$to_insert = array(
			'featured' => isset($input['featured']) ? 1: 0,
			'title' => $input['title'],
			'link' => $input['link'],
			'image' => $input['image']
			);

		// if ($fileinput['status']) {
		// 	$to_insert['fileinput'] = json_encode($fileinput);
		// }

		return $this->db->where('id', $id)->update('sponsors', $to_insert);
	}
}

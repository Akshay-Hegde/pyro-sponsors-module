<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Create and manage the friends and sponsors section.
 *
 * @author 		James Doyle
 * @website		http://ohdoylerules.com/
 * @package 	WARPAINT Media
 * @subpackage 	Sponsors
 * @copyright 	MIT
 */
class sponsors_m extends MY_Model {

	private $folder;

	public function __construct()
	{
		parent::__construct();
		$this->_table = 'sponsors';
	}

	//create a new item
	public function create($input)
	{
		$to_insert = array(
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
		$to_insert = array(
			'featured' => isset($input['featured']) ? 1: 0,
			'title' => $input['title'],
			'link' => $input['link'],
			'image' => $input['image']
			);

		return $this->db->where('id', $id)->update('sponsors', $to_insert);
	}
}

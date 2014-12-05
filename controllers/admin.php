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
class Admin extends Admin_Controller
{
	protected $section = 'items';
	// the number of items that are alllowed to be featured
	public $max_featured = 1;

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('sponsors_m');
		$this->load->library('form_validation');
		$this->lang->load('sponsors');

		// Set the validation rules
		$this->item_validation_rules = array(
			array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'required|trim',
				),
			array(
				'field' => 'featured',
				'label' => 'Featured',
				'rules' => 'int',
				),
			array(
				'field' => 'link',
				'label' => 'Link',
				'rules' => 'trim|required',
				),
			array(
				'field' => 'image',
				'label' => 'Image',
				'rules' => 'required',
				),

			);

		// We'll set the partials and metadata here since they're used everywhere
		$this->template->append_js('module::admin.js')
		->append_css('module::admin.css');
	}

	/**
	 * List all items
	 */
	public function index()
	{
		$sponsors = $this->sponsors_m->order_by('order')->get_all();
		$this->template
		->title($this->module_details['name'])
		->set('sponsors', $sponsors)
		->build('admin/index');
	}

	public function create()
	{
		$sponsors = new StdClass();
		// Set the validation rules from the array above
		$this->form_validation->set_rules($this->item_validation_rules);

		// check if the form validation passed
		if($this->form_validation->run())
		{
			// See if the model can create the record
			if($this->sponsors_m->create($this->input->post()))
			{
				// All good...
				$this->session->set_flashdata('success', lang('sponsors.success'));
				redirect('admin/sponsors');
			}
			// Something went wrong. Show them an error
			else
			{
				$this->session->set_flashdata('error', lang('sponsors.error'));
				redirect('admin/sponsors/create');
			}
		}
		$sponsors->data = new StdClass();
		foreach ($this->item_validation_rules AS $rule)
		{
			$sponsors->data->{$rule['field']} = $this->input->post($rule['field']);
		}
		$this->_form_data();
		// Build the view using sponsors/views/admin/form.php
		$this->template->title($this->module_details['name'], lang('sponsors.new_item'))
		->build('admin/form', $sponsors->data);
	}

	public function edit($id = 0)
	{
		$this->data = $this->sponsors_m->get($id);

		// Set the validation rules from the array above
		$this->form_validation->set_rules($this->item_validation_rules);

		// check if the form validation passed
		if($this->form_validation->run())
		{
			// get rid of the btnAction item that tells us which button was clicked.
			// If we don't unset it MY_Model will try to insert it
			unset($_POST['btnAction']);

			// See if the model can create the record
			if($this->sponsors_m->edit($id, $this->input->post()))
			{
				// All good...
				$this->session->set_flashdata('success', lang('sponsors.success'));
				redirect('admin/sponsors');
			}
			// Something went wrong. Show them an error
			else
			{
				$this->session->set_flashdata('error', lang('sponsors.error'));
				redirect('admin/sponsors/create');
			}
		}

		$this->_form_data();
		// Build the view using sponsors/views/admin/form.php
		$this->template->title($this->module_details['name'], lang('sponsors.edit'))
		->build('admin/form', $this->data);
	}

	public function _form_data()
	{
		// grab all the images in the sponsors folder and list them
		$this->load->model('files/file_folders_m');
		$this->load->library('files/files');
		$folder = $this->file_folders_m->get_by('name', 'sponsors');
		$files = Files::folder_contents($folder->id);
		$this->template->image_choices = array_for_select($files['data']['file'], 'id', 'name');
		// make sure there is only 1 featured sponsor
		$featured = $this->sponsors_m->where('featured', '1')->get_all();
		$this->template->allow_featured = (count($featured) < $this->max_featured);
		$this->template->feature_count = count($featured);
		$this->template->max_featured = $this->max_featured;
	}

	public function delete($id = 0)
	{
		// make sure the button was clicked and that there is an array of ids
		if (isset($_POST['btnAction']) AND is_array($_POST['action_to']))
		{
			// pass the ids and let MY_Model delete the items
			$this->sponsors_m->delete_many($this->input->post('action_to'));
		}
		elseif (is_numeric($id))
		{
			// they just clicked the link so we'll delete that one
			$this->sponsors_m->delete($id);
		}
		redirect('admin/sponsors');
	}
	public function order() {
		$items = $this->input->post('items');
		$i = 0;
		foreach($items as $item) {
			$item = substr($item, 5);
			$this->sponsors_m->update($item, array('order' => $i));
			$i++;
		}
	}
}

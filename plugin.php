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
class Plugin_sponsors extends Plugin
{
	/**
	 * Item List
	 * Usage:
	 *
	 * {{ sponsors:items }}
	 *  {{ featured }}
	 *   {{ id }} {{ title }} {{ link }} {{ files:image_url id=image }}
	 *  {{ /featured }}
	 *  {{ sponsors }}
	 *   {{ id }} {{ title }} {{ link }} {{ files:image_url id=image }}
	 *  {{ /sponsors }}
	 * {{ /sponsors:items }}
	 *
	 * @return	array
	 */
	public function items()
	{
		$this->load->model('sponsors/sponsors_m');
		$results = $this->sponsors_m->order_by('order')->get_all();
		$real_results = array();
		foreach ($results as $item) {
			if ($item->featured) {
				$real_results['featured'][] = $item;
			} else {
				$real_results['sponsors'][] = $item;
			}
		}
		return array($real_results);
	}
}

/* End of file plugin.php */

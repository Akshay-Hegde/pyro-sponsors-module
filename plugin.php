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
		if (!$sponsors = $this->pyrocache->get('theme_m/sponsors-cache'))
		{
			$this->load->model('sponsors/sponsors_m');
			$query = $this->sponsors_m->order_by('order')->get_all();
			$real_results = array();
			foreach ($query as $item) {
				if ($item->featured) {
					$real_results['featured'][] = $item;
				} else {
					$real_results['sponsors'][] = $item;
				}
			}
			$sponsors = array($real_results);
			// 2 hour cache
			$this->pyrocache->write($sponsors, 'theme_m/sponsors-cache', 7200);
		}
		return $sponsors;
	}
}

/* End of file plugin.php */

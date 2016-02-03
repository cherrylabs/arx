<?php namespace Modules\Dashboard\Http\Controllers;

use Arx\classes\Dummy;
use Arxmin\ModuleController;

class DashboardController extends ModuleController {
	
	public function anyIndex()
	{
		/**
		 * Example of messages, notifications and tasks
		 */
		$messages = [
			[
				'link' => '#',
				'thumb' => Dummy::image(),
				'title' => Dummy::title(),
				'description' => Dummy::text()
			]
		];

		$notifications = [
			[
				'icon' => null,
				'link' => '#',
				'thumb' => Dummy::image(),
				'title' => Dummy::title(),
				'description' => Dummy::text()
			],

			[
				'icon' => null,
				'link' => '#',
				'thumb' => Dummy::image(),
				'title' => Dummy::title(),
				'description' => Dummy::text()
			]
		];

		$tasks = [
			[
				'link' => '#',
				'thumb' => Dummy::image(),
				'title' => Dummy::title(),
				'progress' => rand(0, 100),
				'description' => Dummy::text()
			]
		];

		$title = __("Dashboard example");

		$description = __("This dashboard can be customised in /modules/Dashboard");

		return $this->viewMake('dashboard::index', get_defined_vars());
	}
	
}
<?php
/**
 * ExampleController
 *
 * @project : arx-contrib
 * @author : Daniel Sum <daniel@cherrypulp.com>
 */

class ExampleController extends BaseController {

    public function anyIndex(){

        $project  = __('project');

        $nav = __('nav');

        $content = \Arx\classes\Dummy::text(256); // or here you can add your content

        return View::make('arx::layouts.starter', get_defined_vars());

    }

    /**
     * Starter template
     * @return \Illuminate\View\View
     */
    public function anyStarter(){

        $project  = __('project');

        $nav = __('nav');

        $content = \Arx\classes\Dummy::text(256); // or here you can add your content

        return View::make('arx::layouts.starter', get_defined_vars());
    }

    public function anyCarousel(){

        $project  = __('project');

        $nav = __('nav');

        $content = \Arx\classes\Dummy::text(256);

        return View::make('arx::layouts.carousel', get_defined_vars());
    }

    public function anyPage(){

        $project  = __('project');

        $nav = __('nav');

        $content = \Arx\classes\Dummy::text(256);

        return View::make('arx::layouts.page', get_defined_vars());
    }



    public function anyAngular(){

        $project  = __('project');

        $nav = __('nav');

        $content = \Arx\classes\Dummy::text(256);

        return View::make('examples.angular', get_defined_vars());
    }
}
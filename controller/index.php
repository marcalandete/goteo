<?php

namespace Goteo\Controller {

    use Goteo\Core\View,
        Goteo\Model\Home,
        Goteo\Model\Project,
        Goteo\Model\Banner,
        Goteo\Model\Call,
        Goteo\Model\Post,
        Goteo\Model\Promote,
        Goteo\Library\Text,
        Goteo\Library\Feed;

    class Index extends \Goteo\Core\Controller {
        
        public function index () {

            if (isset($_GET['error'])) {
                throw new \Goteo\Core\Error('418', Text::html('fatal-error-teapot'));
            }

            // hay que sacar los que van en portada de su blog (en cuanto aclaremos lo de los nodos)
            $posts     = Post::getList();
            $promotes  = Promote::getAll(true);
            $banners   = Banner::getAll();
            $calls     = Call::getActive(3); // convocatorias en modalidad 1; inscripcion de proyectos
            $campaigns = Call::getActive(4); // convocatorias en modalidad 2; repartiendo capital riego

            $drops = (!empty($calls) || !empty($campaigns)) ? true : false;

            foreach ($posts as $id=>$title) {
                $posts[$id] = Post::get($id);
            }

            foreach ($promotes as $key => &$promo) {
                try {
                    $promo->projectData = Project::get($promo->project, LANG);
                } catch (\Goteo\Core\Error $e) {
                    unset($promotes[$key]);
                }
            }

            foreach ($banners as $id => &$banner) {
                try {
                    $banner->project = Project::get($banner->project, LANG);
                } catch (\Goteo\Core\Error $e) {
                    unset($banners[$id]);
                }
            }

            $feed = array();

            $feed['goteo']     = Feed::getAll('goteo', 'public', 15);
            $feed['projects']  = Feed::getAll('projects', 'public', 15);
            $feed['community'] = Feed::getAll('community', 'public', 15);

            // orden de los elementos, si hay
            $order = Home::getAll();

            return new View('view/index.html.php',
                array(
                    'banners'   => $banners,
                    'posts'     => $posts,
                    'promotes'  => $promotes,
                    'calls'     => $calls,
                    'campaigns' => $campaigns,
                    'feed'      => $feed,
                    'drops'     => $drops,
                    'order'     => $order
                )
            );
            
        }
        
    }
    
}
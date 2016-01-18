<?php

namespace Blog\CoreBundle\Controller;

use Blog\CoreBundle\Services\CategoryManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CategoryController
 * @package Blog\CoreBundle\Controller
 *
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     * Show posts by category
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Route("/{slug}")
     * @Template()
     */
    public function showAction($slug)
    {
        $category = $this->getCategoryManager()->findBySlug($slug);
        $posts = $this->getCategoryManager()->findPosts($category);

        return array(
            'category' => $category,
            'posts'  => $posts,
        );
    }


    /**
     * @Route("/get/all/cat",name="get_categories")
     * @Template("CoreBundle:Category:getCategories.html.twig")
     */
    public function getCategoriesAction(Request $request)
    {
        $categories = $this->getCategoryManager()->findAll();
        return array('categories'=>$categories);
    }

    /**
     * @Route("filter/post", name="filter_posts")
     * @Template("CoreBundle:Category:show.html.twig")
     */
    public function filterPostsAction(Request $request){

        $cat = $request->request->get('cat');
        if ($cat != 'all'){
        $category = $this->getCategoryManager()->findBySlug($cat);
        $posts = $this->getCategoryManager()->findPosts($category);
        }else{
            $posts = $this->getDoctrine()->getManager()->getRepository('ModelBundle:Post')->findBy( array('isPublished' => 1) );
        }
        return array(
            'posts'  => $posts,
        );
    }

    /**
     * Get Category manager
     *
     * @return CategoryManager
     */
    private function getCategoryManager()
    {
        return $this->get('categoryManager');
    }

}

<?php

namespace ArticleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ArticleBundle\Entity\Article;
use ArticleBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article entities.
     *
     * @Route("/", name="article_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('ArticleBundle:Article')->findAll();

        return $this->render('article/index.html.twig', array(
            'articles' => $articles,
        ));
    }

    /**
     * Creates a new Article entity.
     *
     * @Route("/new", name="article_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('ArticleBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }

        return $this->render('article/new.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{id}", name="article_show")
     * @Method("GET")
     */
    public function showAction(Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);

        return $this->render('article/show.html.twig', array(
            'article' => $article,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Route("/{id}/edit", name="article_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);
        $editForm = $this->createForm('ArticleBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_edit', array('id' => $article->getId()));
        }

        return $this->render('article/edit.html.twig', array(
            'article' => $article,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Article entity.
     *
     * @Route("/{id}", name="article_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Article $article)
    {
        $form = $this->createDeleteForm($article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('article_index');
    }

    /**
     * Creates a form to delete a Article entity.
     *
     * @param Article $article The Article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article $article)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Get dropzone file then move it into img and persist path in db.
     *
     * @Route("/dropzone", name="article_dropzone")
     * @Method("POST")
     */
    public function dropzoneAction()
    {

        //do some doctrine magic
        //get last inserted id to create the folder according to the article
        //$em->persist($article);
        //$em->flush();
        //$newFolder = 'Article '+$article->getId();
        //mkdir($this->get('kernel')->getRootDir() . '/../web/public/img/'.$newFolder);

        $response = new Response();

        $ds          = DIRECTORY_SEPARATOR;  //1

        $storeFolder = $this->get('kernel')->getRootDir() . '/../web/public/img/';   //2

        if (!empty($_FILES)) {

            $response->setStatusCode(Response::HTTP_OK);

            $tempFile = $_FILES['file']['tmp_name'];          //3

            //$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

            $targetFile =  $storeFolder. $_FILES['file']['name'];  //5

//            $tempFile = $_FILES['file']['tmp_name'];          //3
//
//            $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
//
//            $targetFile =  $targetPath. $_FILES['file']['name'];  //5

            move_uploaded_file($tempFile,$targetFile); //


        }
        return $response  ;
    }
}

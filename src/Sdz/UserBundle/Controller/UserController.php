<?php
 
namespace Sdz\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sdz\UserBundle\Entity\User;
use Sdz\UserBundle\Form\UserType;
use Sdz\UserBundle\Form\UserRoleType;
use Sdz\UserBundle\Form\UserRoleAdminType;
use Sdz\UserBundle\Form\UserRoleOwnerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * User controller.
 *
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager('user');
        $entities = $em->getRepository('SdzUserBundle:User')
                            ->getUserIndex(15, $page);
        $user=$this->getUser();

        if(!(in_array('ROLE_SUPER_ADMIN', $user->getRoles()))){
            $i=0;
            $entities2=null;
            $entities = $em->getRepository('SdzUserBundle:User')
                                            ->findAll();
            foreach ($entities as $entity) {
                if(!(in_array('ROLE_SUPER_ADMIN', $entity->getRoles()) || in_array('ROLE_ADMIN', $entity->getRoles())) ){
                    $entities2[$i]=$entity;
                    $i++;
                }
            }
            if(!(in_array('ROLE_ADMIN', $user->getRoles()))){
                $entities2 = $em->getRepository('SdzUserBundle:User')
                                    ->findByOperateur($user->getName());
            }
            $entities=$entities2;
        }
        
        return $this->render('SdzUserBundle:User:index.html.twig', array(
            'entities' => $entities,
            'page' => $page,
            'nombrePage' => ceil(count($entities)/15)
        ));
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction(Request $request)
    {
        // mettre les instuctions relatives au user en commentaire lors du déploiement
        // aucuns utilisateur n'existe dans la base de données
        $entity = new User();
        $form = $this->createForm('Sdz\UserBundle\Form\UserType', $entity);
        $form
            ->add('submit', SubmitType::class, array('label' => 'Create'));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager('user');
            $user=$this->getUser();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Utilisateur
                                                    enregistré');

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
        }
        return $this->render('SdzUserBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction(User $entity)
    {
        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render('SdzUserBundle:User:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function accessAction(Request $request, User $user)
    {
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles'
            ));
        $em = $this->getDoctrine()->getManager('user');
        $form = $this->createForm('Sdz\UserBundle\Form\UserAccessType', $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('session')->getFlashBag()->add('info', 'Accès mis à jour');
            $this->get('sdz_user.subscription')->renew($user);

            return $this->redirect($this->generateUrl('user_show', array('id' => $user->getId())));
        }
        return $this->render('SdzUserBundle:User:access.html.twig', array(
            'user'      => $user,
            'form'      => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction(Request $request, User $entity)
    {
        $em = $this->getDoctrine()->getManager('user');

        $user=$this->getUser();
        $editForm = $this->createForm('Sdz\UserBundle\Form\UserType', $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        $editForm
            ->add('submit', SubmitType::class, array('label' => 'Update'));
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 
                                                    'Utilisateur mis à jour');

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
        }
        return $this->render('SdzUserBundle:User:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, User $entity)
    {
        $this->denyAccessUnlessGranted(new Expression(
            '"ROLE_ADMIN" in roles'
            ));
        $form = $this->createDeleteForm($entity->getId());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager('user');
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', SubmitType::class, array('label' => 'Delete'))
            ->getForm()
        ;
    }
    /*
     * Affectation des rôles
     */
    public function edit_roleAction(Request $request, User $entity)
    {
        $em = $this->getDoctrine()->getManager('user');

        $user=$this->getUser();
        if(in_array('ROLE_SUPER_ADMIN', $user->getRoles())){
            $editRoleForm = $this->createForm('Sdz\UserBundle\Form\UserRoleType', $entity);
        }elseif(in_array('ROLE_ADMIN', $user->getRoles())){
            $editRoleForm = $this->createForm('Sdz\UserBundle\Form\UserRoleAdminType', $entity);
        }
        $editRoleForm->handleRequest($request);
        if ($editRoleForm->isSubmitted() && $editRoleForm->isValid()) {

            $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Utilisateur mis à jour');
            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
        }
        return $this->render('SdzUserBundle:User:editrole.html.twig', array(
            'entity'      => $entity,
            'edit_role_form'   => $editRoleForm->createView(),
        ));
    }

    // Generate and send token

    public function tokenAction(){
        $em = $this->getDoctrine()->getManager('user');
        $user = $em->getRepository('SdzUserBundle:User')
                            ->find($this->getUser()->getId());
        $user->setLogapikey(uniqid().$user->getId());
        // $em->flush();
        return new JsonResponse(array("token"=>$user->getLogapikey()));
    }

}

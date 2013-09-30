<?php


namespace Dacorp\CoreBundle\Controller;

use Dacorp\CoreBundle\Entity\User as DacorpUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Dacorp\CoreBundle\Form\Type\UserFormType;

/**
 * Controller managing the user edit process
 */
class UserController extends Controller
{

    /**
     * Simple action to get a csrf Token
     * @return Response
     */
    public function getCsrfTokenAction()
    {
        return new Response($this->container->get('form.csrf_provider')
            ->generateCsrfToken('authenticate'));
    }

    /*
     * show own user profile
     */
    public function showOwnProfileAction()
    {
        $user =$this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($user instanceof DacorpUser)
        $chosenAvatarFilename = ($user->getCurrentAvatar()) ? $em->getRepository('DacorpCoreBundle:DacorpMedia')->find($user->getCurrentAvatar())->getFilename() : null;

        return $this->render('DacorpCoreBundle:User:showOwnProfile.html.twig', array(
                'user' => $user,
                'avatar' => $chosenAvatarFilename
            ));
    }

    /*
     * show a specific user profile
     */
    public function showProfileAction(DacorpUser $user)
    {
        $em = $this->getDoctrine()->getManager();

        if ($user instanceof DacorpUser)
        $chosenAvatarFilename = ($user->getCurrentAvatar()) ? $em->getRepository('DacorpCoreBundle:DacorpMedia')->find($user->getCurrentAvatar())->getFilename() : null;

        return $this->render('DacorpCoreBundle:User:showUserProfile.html.twig', array(
                'user' => $user,
                'avatar' => $chosenAvatarFilename
            ));
    }

    /*
     * edit own user profile
     */
    public function editOwnProfileAction()
    {
        $user = $this->getUser();
        $smDatas = $this->get('dacorp.manager.dacorp_media')->setupDacorpMediaManager($user->getId(),'avatar');
        
        $form = $this->createForm(new UserFormType(), $user, array('editId' => $smDatas['editId'], 'existingFiles' => $smDatas['existingFiles']));

        $request = $this->getRequest();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                //Sync back files
                $att = ($request->request->has('attachments')) ? $request->request->get('attachments') : array();
                $this->get('dacorp.manager.dacorp_media')->manageSimpleDacorpMediaForUser($this->getUser(), $smDatas['editId'], $user->getId(),($att != null) ? $att : array());

                //deal with avatar

                $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('flash.message.profile-updated-successfully'));
                return $this->redirect($this->generateUrl('show_own_profile'));
            } else {
                $this->get('session')->getFlashBag()->add('warning', $this->get('translator')->trans('flash.message.form-invalid'));
            }
        } else {
            $this->get('dacorp.manager.dacorp_media')->feedFiles($smDatas['editId']);
        }


        return $this->render('DacorpCoreBundle:User:edit-user.html.twig', array(
                'form' => $form->createView(),
                'avatar' => "nothing",
                'editId' => $smDatas['editId'],
                'existingFiles' => $smDatas['existingFiles'],
                'selectable' => true,
                'isNew' => false,
                'chosenAvatar' => $user->getCurrentAvatar()
            ));
    }

    public function registerOpenIdAction()
    {
        /* Important, may be the main redirection */
        $securityContext = $this->get('security.context');

        // redirect to home if user is already logged in
        if ($securityContext->isGranted('ROLE_AUTHENTICATED')) {
            return $this->render('DacorpCoreBundle::home.html.twig');
        }

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        return $this->render('DacorpCoreBundle:User:register.html.twig', array(
                'csrf_token' => $csrfToken
                    )
        );
    }



    
}

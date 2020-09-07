<?php

namespace App\Controller;

use App\Entity\RegisteredUser;
use App\Entity\User;
use App\Form\RegisteredUserFormType;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/register", name="app_register.create",methods={"GET"})
     */
    public function createRegistration(): Response
    {
        if ($this->getUser()) return $this->redirectToRoute('home') ;
        return $this->render('registration/register.html.twig');
    }


    /**
     * @Route("/register", name="app_register.post",methods={"POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $authenticator
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse|Response|null
     * TODO finish getting fields with axios and find out how to submit the form
     */
    public function storeRegistration(Request $request,UserPasswordEncoderInterface $passwordEncoder,GuardAuthenticatorHandler $guardHandler,
                                      LoginFormAuthenticator $authenticator,EntityManagerInterface $entityManager){


        if ($this->getUser()) return $this->json(["success"=>false,"message"=>"User already signed in"],400) ;

        $user = new RegisteredUser() ;
        $data = json_decode($request->getContent(),true) ;
        $form =$this->createForm(RegisteredUserFormType::class, $user);
        $form->submit($data) ;
        if ($form->isValid())
        {
            $basicUser=  $user->getUser() ;
            $basicUser->setRoles(["ROLE_REG_USER"]);
            // encode the plain password
            $password= $form->get('user')->get('plainPassword')->getData() ;
            $user->getUser()->setPassword(
                $passwordEncoder->encodePassword(
                    $user->getUser(),$password
                //$form->get('plainPassword')->getData() doesn't work since it's embedded
                )
            );
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user->getUser(),
                (new TemplatedEmail())
                    ->from(new Address('zanetisaief.noreply@gmail.com', 'Where Is My Movie?'))
                    ->to($user->getUser()->getUsername())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // create an authenticated token for the User
            $token = $authenticator->createAuthenticatedToken($user->getUser(), 'main');
            // authenticate this in the system
            $guardHandler->authenticateWithToken($token, $request, 'main');
/*
        WE WANT TO RETURN A JSON INSTEAD OF THE NORMAL RESPONSE ON SUCCESS ,
        SO WE OVERRIDE THE METHOD BELOW

                return $guardHandler->authenticateUserAndHandleSuccess(
                $user->getUser(),
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );*/
        return $this->json(["success"=>true]) ;
        }
        else {
            $errors=[] ;
            foreach ($form->getErrors(true,true) as $error)
            {
                $propertyName = $error->getOrigin()->getName() ;
                $errors[$propertyName]=$error->getMessage();
            }
            return $this->json(["success"=>false,"errors"=>implode("\n", $errors)]) ;
        }
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash(/*verify_email_error*/'error', $exception->getReason());

            return $this->redirectToRoute('app_register.create');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');
        return $this->redirectToRoute('home');
    }
}








/*
 * @Route("/registeror", name="app_registeror")
 * @param Request $request
 * @param UserPasswordEncoderInterface $passwordEncoder
 * @param GuardAuthenticatorHandler $guardHandler
 * @param LoginFormAuthenticator $authenticator
 * @return JsonResponse|Response|null
 *
 public function important(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response
{
    $user = new RegisteredUser() ;
    $form =  $form = $this->get('form.factory')->createNamed("", RegisteredUserFormType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        dd($request) ;
        $basicUser=  $user->getUser() ;
        $basicUser->setRoles(["ROLE_REG_USER"]);
        // encode the plain password
        $password= $form->get('user')->get('plainPassword')->getData() ;
        $user->getUser()->setPassword(
            $passwordEncoder->encodePassword(
                $user->getUser(),$password
            //$form->get('plainPassword')->getData() doesn't work since it's embedded
            )
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // generate a signed url and email it to the user
        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user->getUser(),
            (new TemplatedEmail())
                ->from(new Address('zanetisaief.noreply@gmail.com', 'Where Is My Movie?'))
                ->to($user->getUser()->getUsername())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
        );
        // do anything else you need here, like send an email

        return $guardHandler->authenticateUserAndHandleSuccess(
            $user->getUser(),
            $request,
            $authenticator,
            'main' // firewall name in security.yaml
        );
    }

    return $this->render('registration/register-or.html.twig', [
        'registrationForm' => $form->createView(),
    ]);
}*/

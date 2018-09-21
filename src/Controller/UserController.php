<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\User;
use App\Form\User\LoginForm;
use App\Form\User\RegisterForm;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/")
 */
class UserController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $user = new User();
        $form = $this->createForm(LoginForm::class, $user);


        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', [
            'error' => $error,
            'form' => $form->createView(),
            'last_username' => $lastUsername
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): Response
    {
        return $this->render('user/logout.html.twig', [
            'controller_name' => 'LogoutController'
        ]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(UserInterface $user): Response
    {
        return $this->render('user/profile.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/register", name="register", methods="GET|POST")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

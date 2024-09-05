<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\PropositionQuestions;
use App\Entity\Questions;
use App\Form\PropositionQuestionsType;
use App\Form\QuestionsType;
use App\Form\PropositionQuestionsVFType;
use App\Form\QuestionsVFType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Console\Question\Question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use App\Form\ProfileType;
use App\Form\ResetPasswordType;
use App\Form\plainPassword;

/**
 * Class ProfilController
 * @package App\Controller
 * @Route("/", name="")
 */
class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        /** @var User $user */
           $user = $this->getUser();
        
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $question = $this->getDoctrine()->getRepository(Questions::class);
        $question = $question->findAll();
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $propositionquestion = $this->getDoctrine()->getRepository(PropositionQuestions::class);
        $propositionquestion = $propositionquestion->findAll();

        return $this->render('profil/index.html.twig', [
            'questions' => $question,
            'propositionquestions' => $propositionquestion,
            'user' => $user

        ]);

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilsController',
        ]);
    }

    /**
     * @Route("profil/listequestions", name="profil_listequestions")
     */
    public function listequestions()
    {
        /** @var User $user */
           $user = $this->getUser();
        $question = $this->getDoctrine()->getRepository(Questions::class);
        $question = $question->findAll();
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $propositionquestion = $this->getDoctrine()->getRepository(PropositionQuestions::class);
        $propositionquestion = $propositionquestion->findAll();
        return $this->render('profil/listequestions/index.html.twig', [
            'questions' => $question,
            'propositionquestions' => $propositionquestion,
            'user' => $user,
        ]);

        return $this->render('profil/listequestions/index.html.twig', [
            'controller_name' => 'ListequestionsController',
        ]);
    }

    /**
     * @Route("profil/profil_edit", name="profil_edit")
     * @param Request $request
     * @return Response
     */
    public function profil_edit(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('profil');
        }
        return $this->render("profil/edit.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/profil/{id}/proposer-une-question", name="profil_newpropositionquestions")
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function newPropositionQuestions(User $user, Request $request, int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($id);   
        $propositionQuestions = new PropositionQuestions();
        $propositionQuestions->setIdUser($user->getId());
        $form = $this->createForm(PropositionQuestionsType::class, $propositionQuestions);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $propositionQuestions->setType(0);
            $em = $this->getDoctrine()->getManager();

            $em->persist($propositionQuestions);
            $em->flush();

            return $this->redirectToRoute('profil');

        }
        return $this->render('profil/proposer-une-question/index.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/profil/{id}/proposer-une-question-VF", name="profil_newpropositionquestionsVF")
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function newPropositionQuestionsVF(User $user, Request $request, int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($id);   
        $propositionQuestions = new PropositionQuestions();
        $propositionQuestions->setIdUser($user->getId());
        $form = $this->createForm(PropositionQuestionsVFType::class, $propositionQuestions);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $propositionQuestions->setType(1);
        if($propositionQuestions->getCorrectAnswer()=='Vrai'){
            $propositionQuestions->setCorrectAnswer('Vrai');
            $propositionQuestions->setIncorrect0('Faux');
        } else {
            $propositionQuestions->setCorrectAnswer('Faux');
            $propositionQuestions->setIncorrect0('Vrai');
        }
            $em = $this->getDoctrine()->getManager();

            $em->persist($propositionQuestions);
            $em->flush();

            return $this->redirectToRoute('profil');

        }
        return $this->render('profil/proposer-une-question-VF/index.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/profil/{id}/ajouter-une-question", name="profil_newquestions")
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function newQuestions(User $user, Request $request, int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($id);   
        $Questions = new Questions();
        $Questions->setIdUser($user->getId());
        $form = $this->createForm(QuestionsType::class, $Questions);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
                $Questions->setType(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($Questions);
            $em->flush();
            return $this->redirectToRoute('profil');
        }
        return $this->render('profil/ajouter-une-question/index.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/profil/{id}/ajouter-une-question-VF", name="profil_newquestionsVF")
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function newQuestionsVF(User $user, Request $request, int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($id);   
        $Questions = new Questions();
        $Questions->setIdUser($user->getId());
        $form = $this->createForm(QuestionsVFType::class, $Questions);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
                $Questions->setType(1);
            if($Questions->getCorrectAnswer()=='Vrai'){
                $Questions->setCorrectAnswer('Vrai');
                $Questions->setIncorrect0('Faux');
            } else {
                $Questions->setCorrectAnswer('Faux');
                $Questions->setIncorrect0('Vrai');
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($Questions);
            $em->flush();
            return $this->redirectToRoute('profil');
        }
        return $this->render('profil/ajouter-une-question-VF/index.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("profil/listequestions/{id}/editpropositionquestion", name="profil_editpropositionquestion")
     * @param PropositionQuestions $propositionquestion
     * @param Request $request
     * @return Response
     */
    public function editpropositionquestion(PropositionQuestions $propositionquestion, Request $request): Response
    {
        $form = $this->createForm(PropositionQuestionsType::class, $propositionquestion);
        $form->handleRequest($request);
        $propositionquestion = $this->getDoctrine()->getRepository(PropositionQuestions::class);
        $propositionquestion = $propositionquestion->findAll();
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('profil');
        }
        return $this->render("profil/listequestions/editpropositionquestions.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("profil/listequestions/{id}/editpropositionquestionVF", name="profil_editpropositionquestionVF")
     * @param PropositionQuestions $propositionquestion
     * @param Request $request
     * @return Response
     */
    public function editpropositionquestionVF(PropositionQuestions $propositionquestion, Request $request, int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(PropositionQuestions::class);
        $propositionQuestions = $repository->find($id);   
        $propositionQuestions->setIdUser($propositionQuestions->getId());
        $form = $this->createForm(PropositionQuestionsVFType::class, $propositionQuestions);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if($propositionquestion->getCorrectAnswer()=='Vrai'){
                $propositionquestion->setIncorrect0('Faux');
            } else {
                $propositionquestion->setIncorrect0('Vrai');
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('profil');
        }
        return $this->render("profil/listequestions/editpropositionquestionsVF.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("profil/listequestions/{id}/editquestion", name="profil_editquestion")
     * @param Questions $Question
     * @param Request $request
     * @return Response
     */
    public function editquestion(Questions $Questions, Request $request): Response
    {
        $form = $this->createForm(QuestionsType::class, $Questions);
        $form->handleRequest($request);
        $Questions = $this->getDoctrine()->getRepository(Questions::class);
        $Questions = $Questions->findAll();
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('profil_listequestions');
        }
        return $this->render("profil/listequestions/editquestions.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("profil/listequestions/{id}/editquestionVF", name="profil_editquestionVF")
     * @param Questions $Question
     * @param Request $request
     * @return Response
     */
    public function editquestionVF(Questions $question, Request $request, int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Questions::class);
        $question = $repository->find($id);   
        $question->setIdUser($question->getId());
        $form = $this->createForm(QuestionsVFType::class, $question);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if($question->getCorrectAnswer()=='Vrai'){
                $question->setIncorrect0('Faux');
            } else {
                $question->setIncorrect0('Vrai');
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('profil_listequestions');
        }
        return $this->render("profil/listequestions/editquestionsVF.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("profil/listequestions/{id}/addquestion", name="profil_addquestion")
     * @param PropositionQuestions $propositionquestion
     * @param Request $request
     * @return Response
     */
    public function addQuestion(Request $request, PropositionQuestions $propositionquestion, int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(PropositionQuestions::class);
        $propositionquestion = $repository->find($id);
        $Questions = new Questions();
        $Questions->setCategory($propositionquestion->getCategory());
        $Questions->setType($propositionquestion->getType());
        $Questions->setDifficulty($propositionquestion->getDifficulty());
        $Questions->setQuestion($propositionquestion->getQuestion());
        $Questions->setCorrectAnswer($propositionquestion->getCorrectAnswer());
        $Questions->setIncorrect0($propositionquestion->getIncorrect0());
        $Questions->setIncorrect1($propositionquestion->getIncorrect1());
        $Questions->setIncorrect2($propositionquestion->getIncorrect2());
        $Questions->setIdUser($propositionquestion->getIdUser());
        $em = $this->getDoctrine()->getManager();
        $em->persist($Questions);
        $em->remove($propositionquestion);
        $em->flush();
        return $this->redirectToRoute('profil_listequestions');
    }

    /**
     * @Route("profil/listequestions/{id}/deletepropositionquestion", name="profil_deletepropositionquestion")
     * @param PropositionQuestions $propositionquestion
     * @return RedirectResponse
     */
    public function deletepropositionquestion(PropositionQuestions $propositionquestion): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($propositionquestion);
        $em->flush();

        return $this->redirectToRoute('profil');
    }

    /**
     * @Route("profil/listequestions/{id}/deletequestion", name="profil_deletequestion")
     * @param Questions $Question
     * @return RedirectResponse
     */
    public function deletequestion(Questions $Questions): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($Questions);
        $em->flush();

        return $this->redirectToRoute('profil_listequestions');
    }     
    
    /**
    * @Route("profil/resetPassword", name="resetPassword")
    * @param Request $request
    * @return Response
    */
   public function resetPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
   {
       $em = $this->getDoctrine()->getManager();
       $user = $this->getUser();
       $form = $this->createForm(ResetPasswordType::class, $user);
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
           $plainPass = $request->request->get('reset_password')['plainPassword']['first'];
           $oldPassword = $request->request->get('reset_password')['oldPassword'];
           // dump($request->request);die();
           $encoded = $passwordEncoder->encodePassword($user, $oldPassword);
           // Si l'ancien mot de passe est bon
           if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {
               $newEncodedPassword = $passwordEncoder->encodePassword($user, $plainPass);
               $user->setPassword($newEncodedPassword);
               
               $em->persist($user);
               $em->flush();
               $this->addFlash('notice', 'Votre mot de passe à bien été changé !');
               return $this->redirectToRoute('profil');
           } else {
               $form->addError(new FormError('Ancien mot de passe incorrect'));
           }
       }
       
       return $this->render('profil/resetPassword.html.twig', array(
           'form' => $form->createView(),
       ));
   }
}

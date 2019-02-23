<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 17/02/19
 * Time: 16:15
 */

namespace App\Controller;


use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {
        /*        $property = new \App\Entity\Property();
                $property->setTitle('Mon Premier bien')
                    ->setPrice(200000)
                    ->setRooms(4)
                    ->setBedroom(3)
                    ->setDescription('Juste une petite description')
                    ->setSurface(60)
                    ->setFloor(4)
                    ->setHeat(1)
                    ->setCity('MontPellier')
                    ->setAddress('15 Boulevard Gambetta')
                    ->setPostalCode(34000);

                $em = $this->getDoctrine()->getManager();
                $em->persist($property);
                $em->flush();*/

        /*
        $repository = $this->getDoctrine()->getRepository(\App\Entity\Property::class);
        dump($repository);
        */


        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param \App\Entity\Property $property
     * @return Response
     */
        public function show(\App\Entity\Property $property, string $slug) : Response
        {

            if ($property->getslug() !== $slug){
                return $this->redirectToRoute('property.show', [
                    'id' => $property->getId(),
                    'slug' => $property->getslug()
                ], 301);
            }
            return $this->render('property/show.html.twig', [
                'property' => $property,
                'current_menu' => 'properties'
        ]);

        }



}
<?php

namespace EventsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ArticleBundle\Entity\Tags;

/**
 * Events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="EventsBundle\Repository\EventsRepository")
 * @Vich\Uploadable
 */
class Events
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime")
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */  
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="places", type="integer")
     */
    private $places;

    /**
     * @ORM\OneToMany(targetEntity="Registration", mappedBy="events",cascade={"persist","remove"})
     */
    private $registrations;

    /**
     * @ORM\ManyToMany(targetEntity="ArticleBundle\Entity\Tags", inversedBy="events",cascade={"persist"})
     * @ORM\JoinTable(name="tags_events")
     */
    private $tag;

    // Permet l'affichage par défaut de la date actuelle dans le formulaire de création
    public function __construct()
    {
        $this->start = new \DateTime();
        $this->end = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Events
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Events
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return Events
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Events
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Events
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set places
     *
     * @param integer $places
     * @return Events
     */
    public function setPlaces($places)
    {
        $this->places = $places;

        return $this;
    }

    /**
     * Get places
     *
     * @return integer 
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Set registrations
     *
     * @param integer $registrations
     * @return Events
     */
    public function setRegistrations($registrations)
    {
        $this->registrations = $registrations;

        return $this;
    }

    /**
     * Get registrations
     *
     * @return integer 
     */
    public function getRegistrations()
    {
        return $this->registrations;
    }

    /**
     * Add tag
     *
     * @param \ArticleBundle\Entity\Tags $tag
     * @return Events
     */
    public function addTag(\ArticleBundle\Entity\Tags $tag)
    {
        $this->tag[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \ArticleBundle\Entity\Tags $tag
     */
    public function removeTag(\ArticleBundle\Entity\Tags $tag)
    {
        $this->tag->removeElement($tag);
    }

    /**
     * Get tag
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTag()
    {
        return $this->tag;
    }
}

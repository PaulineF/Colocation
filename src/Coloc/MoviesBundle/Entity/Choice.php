<?php

namespace Coloc\MoviesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Unirest\Request;

/**
 * Choices
 *
 * @ORM\Table(name="choice")
 * @ORM\Entity(repositoryClass="Coloc\MoviesBundle\Repository\ChoicesRepository")
 */
class Choice
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
     * @var \DateTime
     *
     * @ORM\Column(name="target_date", type="date")
     */
    private $targetDate;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="film_id", type="string", length=255)
     */
    private $filmId;


   

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
     * Set targetDate
     *
     * @param \DateTime $targetDate
     *
     * @return Choice
     */
    public function setTargetDate($targetDate)
    {
        $this->targetDate = $targetDate;

        return $this;
    }

    /**
     * Get targetDate
     *
     * @return \DateTime
     */
    public function getTargetDate()
    {
        return $this->targetDate;
    }

    /**
     * Set filmId
     *
     * @param string $filmId
     *
     * @return Choice
     */
    public function setFilmId($filmId)
    {
        $this->filmId = $filmId;

        return $this;
    }

    /**
     * Get filmId
     *
     * @return string
     */
    public function getFilmId()
    {
        return $this->filmId;
    }

    public function getFilm()
    {
        $response = Request::get('http://www.omdbapi.com/?apikey=8bb45b28&i='.$this->filmId)->body;
        return $response;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Choice
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}

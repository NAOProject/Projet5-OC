<?php

namespace OC\NAOBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="OC\NAOBundle\Repository\PictureRepository")
 */
class Picture
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
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     *
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     *
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var UploadedFile
     *
     * @Assert\File(
     * maxSize= "2024k",
     * maxSizeMessage = "La photo doit peser moins de 2Mo",
     * mimeTypes={ "image/jpeg", "image/jpg", "image/png" },
     * mimeTypesMessage = "La photo doit etre au format JPEG, JPG ou PNG",
     * )
     */
    private $image;

    /**
    * @return UploadedFile
    */
    public function getImage()
    {
        return $this->image;
    }

   /**
   * @param UploadedFile $file
   */
    public function setImage(UploadedFile $image)
    {
        $this->image = $image;

        return $this;
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
     * Set alt
     *
     * @param string $alt
     *
     * @return Picture
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Picture
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}

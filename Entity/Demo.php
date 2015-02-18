<?php

namespace Lcn\WYSIHTML5Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demo
 *
 * @ORM\Table(name="lcn_wysihtml5_demo")
 * @ORM\Entity(repositoryClass="Lcn\WYSIHTML5Bundle\Entity\DemoRepository")
 */
class Demo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="html", type="string", length=65000)
     */
    private $html;


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
     * Set html
     *
     * @param string $html
     * @return Demo
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string 
     */
    public function getHtml()
    {
        return $this->html;
    }
}

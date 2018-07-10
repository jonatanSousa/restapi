<?php
/**
 * Created by PhpStorm.
 * User: Nearshore Portugal
 * Date: 5/8/2018
 * Time: 12:09 PM
 */

namespace Entity;

use Doctrine\ORM\Mapping as ORM;


class PostCodeMorada
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $post_code;

    /**
     * @var text
     */
    private $city;

    /**
     * @var text
     */
    private $street;

    /**
     * @var date
     */
    private $reg_date;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPostCode()
    {
        return $this->post_code;
    }

    /**
     * @param int $post_code
     */
    public function setPostCode($post_code)
    {
        $this->post_code = $post_code;
    }

    /**
     * @return text
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param text $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return text
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param text $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return date
     */
    public function getRegDate()
    {
        return $this->reg_date;
    }

    /**
     * @param date $reg_date
     */
    public function setRegDate($reg_date)
    {
        $this->reg_date = $reg_date;
    }


}
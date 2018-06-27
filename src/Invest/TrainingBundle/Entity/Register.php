<?php

namespace Invest\TrainingBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="registrations")
 */
class Register
{
    /**
     * @ORM\Column{type="integer"}
     * @ORM\Id
     * @ORM\GeneratedValue{strategy="AUTO"}
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     *
     * @Assert\Regex(
     *     pattern = "/^[a-zA-Z]+ [a-zA-Z]+$/",
     *     message = "Musisz podać imię i nazwisko"
     * )
     *
     * @Assert\Length(
     *      max = 255
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     *
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $sex;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @Assert\Date
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=2)
     *
     * @Assert\NotBlank
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     */
    private $course;

    /**
     * @ORM\Column(type="array")
     *
     * @Assert\NotBlank
     *
     * @Assert\Count(
     *      min = 2
     * )
     */
    private $invest;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comments;

    /**
     * @Assert\NotBlank
     *
     * @Assert\File(
     *      maxSize = "2M",
     *      mimeTypes = {"application/pdf", "application/x-pdf"},
     *      mimeTypesMessage = "Potwierdzenie przelewu musi być w formacie PDF"
     * )
     */
    private $paymentFile;

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Register
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Register
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return Register
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Register
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Register
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set course
     *
     * @param string $course
     *
     * @return Register
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return string
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set invest
     *
     * @param array $invest
     *
     * @return Register
     */
    public function setInvest($invest)
    {
        $this->invest = $invest;

        return $this;
    }

    /**
     * Get invest
     *
     * @return array
     */
    public function getInvest()
    {
        return $this->invest;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Register
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return mixed
     */
    public function getPaymentFile()
    {
        return $this->paymentFile;
    }

    /**
     * @param mixed $paymentFile
     * @return Register
     */
    public function setPaymentFile($paymentFile)
    {
        $this->paymentFile = $paymentFile;
        return $this;
    }

    public function save($savePath) {

        $paramsNames = array ('name', 'email', 'sex', 'birthdate', 'country', 'invest', 'comments');
        $formData = array();
        foreach ($paramsNames as $name) {
            $formData[$name] = $this->{$name};
        }

        $randVal = rand(1000, 9999);
        $dataFileName = sprintf('data_%d.txt', $randVal);

        file_put_contents($savePath.$dataFileName, print_r($formData, TRUE));

        $file = $this->getPaymentFile();
        if(NULL !== $file){
            $newName = sprintf('file_%d.%s', $randVal, $file->guessExtension());
            $file->move($savePath, $newName);
        }
    }
}

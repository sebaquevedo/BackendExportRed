<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Autenticacion
 *
 * @ORM\Table(name="autenticacion")
 * @ORM\Entity
 */
class Autenticacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=false)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="correo", type="integer", nullable=false)
     */
    private $correo;


}

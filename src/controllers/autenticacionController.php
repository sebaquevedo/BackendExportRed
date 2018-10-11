<?php

require_once "bootstrap.php";
use Doctrine\ORM\EntityManager;

class autenticacionController {
	 protected $em;

	 public function __construct(EntityManager $entityManager)
    	{
        	$this->em = $entityManager;
        	
    	}

    public function findUsersByRole($role) {
        $qb = $this->em->createQueryBuilder();
        
         $qb->select('u')
            ->from('mybundleBundle:User', 'u')
            ->where('u.roles LIKE :roles')
            ->setParameter('roles', '%"' . $role . '"%');
        
        return $qb->getQuery()->getResult();
    }
    
   
   
    public function traerTablas(EntityManager $entityManager) {
      

		$sql = "SELECT TABLE_SCHEMA,TABLE_NAME,COLUMN_NAME".
		"FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='Export_Full_OSS13'".
		"# and COLUMN_NAME='Qrxlevmin' and TABLE_NAME='EUtranCellFDD'";
		$query = $db->query($sql);

		$tablas = array();
		while ($tabla = $query->fetch_assoc()) {
			$tablas[] = $tabla;
		}

		$result = array(
				'status' => 'success',
				'code'	 => 200,
				'data' => $tablas
			);

			echo json_encode($result);
    }
} 


?>
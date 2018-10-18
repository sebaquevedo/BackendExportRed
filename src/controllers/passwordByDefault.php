<?php 

	class passwordByDefault{

	protected $pass;
	private static $instancia;

	 private function __construct()
    	{
        	$this->pass = "666666";
        	
    	}

    	
    	public static function singleton()
    	{
	        if (!isset(self::$instancia)) {
	            $miclase = __CLASS__;
	            self::$instancia = new $miclase;
	        } 
	        return self::$instancia;
    	}

	    	// Evita que el objeto se pueda clonar
	    public function __clone()
	    {
	        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
	    }
		
		public function getPasswordByDefault(){
			return $this->pass; 
		}
	}

?>
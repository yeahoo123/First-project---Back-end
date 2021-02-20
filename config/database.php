<?php 
 
 class Database{	
	
    private $connection = null;

    public function __construct($dbhost = "localhost", $dbname = "myDataBaseName", $username = "root", $password = ""){

        try{
	 
            $this->connection = new mysqli($dbhost, $username, $password, $dbname);
		
            if( mysqli_connect_errno() ){
                throw new Exception("Could not connect to database.");   
            }
		
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }			
	
    }

    // Insert a row/s in a Database Table
    public function Insert( $query = "" , $params = [] ){
	
        try{
		
        $stmt = $this->executeStatement( $query , $params );
            $stmt->close();
            $result = $this->connection->insert_id;
            return $result;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
	
        return true;
	
    }

    // Select a row/s in a Database Table
    public function Select( $query = "" , $params = [] ){
	
        try{
		
            $stmt = $this->executeStatement( $query , $params );
		
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
            $stmt->close();
		
            return $result;
		
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
	
        return false;
    }

    // Update a row/s in a Database Table
    public function Update( $query = "" , $params = [] ){
        try{
		
            $newResult = $this->executeStatement( $query , $params )->close();
            return 1;
		
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
	
        return false;
    }		

    // Remove a row/s in a Database Table
    public function Remove( $query = "" , $params = [] ){
        try{
		
            $this->executeStatement( $query , $params )->close();
		
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
	
        return false;
    }		

    // execute statement
    private function executeStatement( $query = "" , $params = [] ){
	
        try{
		
            $stmt = $this->connection->prepare( $query );
		
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
		
            if( $params ){
                call_user_func_array(array($stmt, 'bind_param'), $params );				
            }
		
            $stmt->execute();
		
            return $stmt;
		
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
	
    }
		
} function getMenu($db, $parentid = 0,$p_status=1, $space = "", $trees = array())
    {
		if($p_status>0)
		{
			$where=' AND category_status=1';
		}else
		{
			$where='1=1';
		}
        if(!$trees)
        {
            $trees = array();
        }
		
        //$db = new Database(db_host, db_name, db_username, db_password);
        $sql="SELECT * FROM category WHERE 1=1 ".$where." AND parent_id=".$parentid;
        //echo $sql;exit;
        $result = $db->Select($sql);
		
		foreach($result as $value)
        {
            $trees[$value['category_id']] = array( 'category_id' => $value['category_id'],
                                'category_name'=>$space.$value['category_name'],
                                );
            $trees = getMenu($db,$value['category_id'],$p_status, $space.'&nbsp;--&nbsp;', $trees);
        }
        return $trees;
    }
?>
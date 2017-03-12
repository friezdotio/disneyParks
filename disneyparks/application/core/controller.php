<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{
    public $db = null;

    public $model = null;


    function __construct()
    {
        if(ENABLE_CORS == true){
            $this->cors();
        }
        if(DB_ENABLE == true){
            $this->openDatabaseConnection();
        }
        $this->loadModel();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
    }

    /**
     * Loads the "model".
     * @return object model
     */
    public function loadModel()
    {   
        // load the global model
        require APP . 'public/model/base.php';
        $this->base = new Base($this->db);
        
        $modelPath = 'resources/model/';
        
        $files = scandir($modelPath); 
        foreach($files as $file){
            if(is_file($modelPath.$file) && $file != '.DS_Store'){
                $fileName = $file;
                $modelName = str_replace(".php","",$fileName);
                
                require $modelPath . $fileName;
                // create new "model" (and pass the database connection)
                $this->$modelName = new $modelName($this->db);
            }
        }
        
    }
    
    public function cors() {

        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // you want to allow, and if so:
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }
       
    }
    
    function query2json($query) {
        $data_sql = mysql_query($query) or die("'';//" . mysql_error());// If an error has occurred, 
                //    make the error a js comment so that a javascript error will NOT be invoked
        $json_str = ""; //Init the JSON string.

        if($total = mysql_num_rows($data_sql)) { //See if there is anything in the query
            $json_str .= "[\n";

            $row_count = 0;    
            while($data = mysql_fetch_assoc($data_sql)) {
                if(count($data) > 1) $json_str .= "{\n";

                $count = 0;
                foreach($data as $key => $value) {
                    //If it is an associative array we want it in the format of "key":"value"
                    if(count($data) > 1) $json_str .= "\"$key\":\"$value\"";
                    else $json_str .= "\"$value\"";

                    //Make sure that the last item don't have a ',' (comma)
                    $count++;
                    if($count < count($data)) $json_str .= ",\n";
                }
                $row_count++;
                if(count($data) > 1) $json_str .= "}\n";

                //Make sure that the last item don't have a ',' (comma)
                if($row_count < $total) $json_str .= ",\n";
            }

            $json_str .= "]\n";
        }

        //Replace the '\n's - make it faster - but at the price of bad redability.
        $json_str = str_replace("\n","",$json_str); //Comment this out when you are debugging the script

        //Finally, output the data
        return $json_str;
    }
    
    // this should be the dashboard info
    public function index()
    {
        // This should eventually be moved to some sort of service.
        if(ENABLE_DASHBOARD == true){
            $url = $_SERVER['REQUEST_URI'];
            $classArray = $this->base->getClass($url);
            
            require APP . 'public/views/_templates/header.php';
            require APP . 'public/views/dashboard/index.php';
            require APP . 'public/views/_templates/footer.php';
        }
    }
}
<?php

class Base
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all songs from database
     */
    public function getClass($url)
    {
        $removeIndex = str_replace("index.php","",$url);
        if(null !== URL_SUB_FOLDER){
            $removeIndex = str_replace(URL_SUB_FOLDER,"",$removeIndex);
        }
        $controller = str_replace("/","",$removeIndex);
        $filepath = 'resources/' . $controller . '.php';

        $php_code = file_get_contents($filepath);

        $classes = array();
        $tokens = token_get_all($php_code);
        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if (   $tokens[$i - 2][0] == T_CLASS
                && $tokens[$i - 1][0] == T_WHITESPACE
                && $tokens[$i][0] == T_STRING) {

                $class_name = $tokens[$i][1];
                $classes[] = $class_name;
            }
        }

        foreach($classes as $class){
            $methods = get_class_methods($class);
            foreach($methods as $method){
                // no other methods really matter
                if($method == 'get' || $method == 'insert' || $method == 'update' || $method == 'delete') {
                    $ref = new ReflectionMethod($class, $method);
                    if(count($ref->getParameters()) == 0){
                        $array[$class][$method][] = 'No Parameters';
                    }
                    else{
                        foreach($ref->getParameters() as $param) {  
                            $name = $param->name;
                            $array[$class][$method][$name] = $param->isOptional();
                        }
                    }
                }
            }
        }
        return $array;
    }


}
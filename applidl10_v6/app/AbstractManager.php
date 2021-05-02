<?php

    abstract class AbstractManager
    {
        protected static $bdd;

        protected function connect(){
            //se connecter à MySQL
            self::$bdd = new \PDO(
                "mysql:host=localhost:3306;dbname=store",
                "root",
                "",
                [
                    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ]
            );
        }

        /**
         * Permet d'effectuer une requète à la base de données et d'en obtenir son résultat 
         * 
         * @param string $query - la requète SQL à exécuter
         * @param array|null $params - les paramètres de la requète si besoin
         * 
         * @return \PDOStatement l'objet PDOStatement relatif à l'execution de la requète
         */
        protected static function makeQuery($query, $params = null){
            if($params){
                $statement = self::$bdd->prepare($query);
                $statement->execute($params);
            }
            else{
                $statement = self::$bdd->query($query);
            }

            return $statement;
        }


        protected function getResults($classname, $query, $params = null){
            $stmt = self::makeQuery($query, $params);
            $results = [];
            foreach($stmt->fetchAll() as $data){
                $results[] = new $classname($data);
            }

            return $results;
        }

        /**
         * Récupère un objet de la classe spécifiée ou null 
         * 
         * @param string $classname - la classe de l'objet voulu
         * @param string $query - la requète SQL à exécuter
         * @param array|null $params - les paramètres de la requète si besoin
         * 
         * @return Object|null l'objet de la classe attendue ou null
         */
        protected function getOneOrNullResult($classname, $query, $params = null){
            $stmt = self::makeQuery($query, $params);
            if($data = $stmt->fetch()){
                return new $classname($data);
            }
            return null;
            
        }

        /**
         * exécute une requète SQL du type INSERT, UPDATE ou DELETE
         * 
         * @param string $query - la requète SQL à exécuter
         * @param array|null $params - les paramètres de la requète si besoin
         * 
         * @return bool TRUE si la requète a réussi, FALSE sinon
         */
        protected function executeQuery($query, $params = null){
            return self::makeQuery($query, $params);
        }

        protected function getOneValue($query, $params = null){
            $stmt = self::makeQuery($query, $params);
            return $stmt->fetchColumn();
        }
    }
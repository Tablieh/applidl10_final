<?php
    namespace App\Core;

    abstract class AbstractManager
    {
        protected static $bdd;

        protected function connect(){
            //se connecter à MySQL
            self::$bdd = new \PDO(
                DB_HOST,
                DB_USER,
                DB_PASS,
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
        private static function makeQuery($query, $params = null){
            if($params){
                $statement = self::$bdd->prepare($query);
                $statement->execute($params);
            }
            else{
                $statement = self::$bdd->query($query);
            }

            return $statement;
        }

        /**
         * récupère un tableau d'objets de l'entité voulue (1er paramètre) correspondant à la requête passée à la fonction (et éventuellement les paramètres nécessaires).
         * 
         * @param string $classname le nom de la classe des entités résultat
         * @param string $query la requête SQL à executer
         * @param array|null $params les paramètres optionnels de la requète 
         * 
         * @return array le tableau d'entités résultant de la requête (vide si la requête n'a rien renvoyée)
         */
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

        /**
         * Récupère une seule valeur résultant de la requète SQL désirée
         * 
         * @param string $query - la requète SQL à exécuter
         * @param array|null $params - les paramètres de la requète si besoin
         * 
         * @return mixed la valeur résultant de la requête
         */
        protected function getOneValue($query, $params = null){
            $stmt = self::makeQuery($query, $params);
            return $stmt->fetchColumn();
        }

        protected function getLastInsertId(){
            return self::$bdd->lastInsertId();
        }
    }
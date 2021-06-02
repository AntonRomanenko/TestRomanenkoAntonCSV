<?php
    class Database {
        private $host = "localhost";
        private $username = "username";
        private $password = "password";
        private $dbname = "myDB";

        private $connection;

        function __construct($host, $username, $password, $dbname) {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->dbname = $dbname;
            $this->connection();
        }

        public function __destruct()
        {
            $this->connection->close();
        }

        private function connection() {
            $conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $this->connection = $conn;
        }

        public function select($query) {
            $response = [];
            $result = $this->connection->query($query);
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($response, $row);
                }
            }

            return $response;
        }

        public function query($query) {
            return $this->connection->query($query);
        }
    }
?>
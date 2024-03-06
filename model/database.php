<?php
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'teelab';

    // private $host = 'sql204.infinityfree.com';
    // private $user = 'if0_35667095';
    // private $password = 'DiHKBpvtLox';
    // private $database = 'if0_35667095_the_last_dtb';

    private $conn;
    

    // Phương thức khởi tạo, thực hiện kết nối đến cơ sở dữ liệu
    public function __construct() {
        $this->connect();
    }

    // Phương thức kết nối đến cơ sở dữ liệu
    private function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $this->connection->connect_error);
        }
    }

    // Phương thức để thực hiện các truy vấn SQL
    public function exec($sql) {
        $result = $this->conn->query($sql);
    
        // Kiểm tra xem có lỗi xảy ra không
        if (!$result) {
            // Trả về thông báo lỗi
            return "Lỗi SQL: " . $this->conn->error;
        }
    
        // Trả về kết quả của truy vấn
        return $result;
    }

    // Phương thức để đóng kết nối cơ sở dữ liệu
    public function close() {
        $this->conn->close();
    }

    public function getRow($sql) {
        $result = $this->exec($sql);
        return $result->fetch_assoc();
    }

    public function getRows($sql) {
        $result = $this->exec($sql);
        $rows = array();
        
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    
        return $rows;
    }
}

?>
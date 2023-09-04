<?php

namespace Ratingthomas\SQLManager;

class SQL
{
    public $db_host;
    public $db_username;
    public $db_password;
    public $db_name;

    function connect(string $db_host, string $db_username, string $db_password, string $db_name)
    {
        $this->db_host = $db_host;
        $this->db_username = $db_username;
        $this->db_password = $db_password;
        $this->db_name = $db_name;
    }

    function displayconnection()
    {
        return array($this->db_host, $this->db_username, $this->db_password, $this->db_name);
    }

    function query(string $query, array $options, $array_push = false, $no_result = false)
    {
        // Connect to the db.
        $conn = new \mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare the statement
        $stmt = $conn->prepare($query);

        $types = "";

        // Get the amount of options
        $optionsamount = count($options);

        // Check if options is greater than 0, if true we use the bind_param function
        if ($optionsamount > 0) {
            $count = 0;

            while ($count < $optionsamount) {
                $types = $types . "s"; // 's' specifies the variable type => 'string'
                $count++;
            }

            $stmt->bind_param($types, ...$options);
        }

        // Execute the SQL query.
        $stmt->execute();

        $data = [];

        // Get the result + rowcount
        $result = $stmt->get_result();

        if ($no_result == false) {
            $rowcount = mysqli_num_rows($result);

            // Display the data in a nice way.
            if ($rowcount > 1 || $array_push > 0 || $array_push == true) {
                while ($row = $result->fetch_assoc()) {
                    array_push($data, $row);
                }
            } else {
                while ($row = $result->fetch_assoc()) {
                    $data = $row;
                }
            }

            return $data;

            // Close mysql connection
            mysqli_close($conn);
        }
    }
}

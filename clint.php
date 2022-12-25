<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['Prefix']) && isset($_POST['firstname']) &&
        isset($_POST['lastname']) && isset($_POST['email']) &&
        isset($_POST['companyname']) &&
        isset($_POST['website']) && isset($_POST['country']) && isset($_POST['city']) && isset($_POST['mobilenumber']) && isset($_POST['i_m_looking_for']) && isset($_POST['project_description']) && isset($_POST['Industry_Sector']) && isset($_POST['Budget']) && isset($_POST['Where_to'])) {
        
        $Prefix = $_POST['Prefix'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $companyname = $_POST['companyname'];
        $website = $_POST['website'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $mobilenumber = $_POST['mobilenumber'];
        $i_m_looking_for = $_POST['i_m_looking_for'];
        $project_description = $_POST['project_description'];
        $Industry_Sector = $_POST['Industry_Sector'];
        $Budget = $_POST['Budget'];
        $Where_to = $_POST['Where_to'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "data";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email  FROM clientregistration WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO clientregistration(Prefix, firstname, lastname, email, companyname, website, country, city, mobilenumber, i_m_looking_for,project_description, Industry_Sector, Budget, Where_to) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssssssssisssss",$Prefix, $firstname, $lastname, $email, $companyname, $website, $country, $city, $mobilenumber, $i_m_looking_for, $project_description, $Industry_Sector, $Budget,$Where_to);
                if ($stmt->execute()) {
                    // echo "New record inserted sucessfully.";
                    header("Location: thnkyouclint.html");
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo '<script>alert("some one already registered with same email")</script>';
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>
<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['Prefix']) && isset($_POST['firstname']) &&
        isset($_POST['lastname']) && isset($_POST['email']) &&
        isset($_POST['phonenumber']) &&
        isset($_POST['sector']) && isset($_POST['subsector'])
        && isset($_POST['country']) && isset($_POST['city'])
        && isset($_POST['employment_status']) 
        && isset($_POST['expertise']) && isset($_POST['bio']) && isset($_POST['nationality']) && isset($_POST['education'])
        && isset($_POST['recognition'])  && isset($_POST['experience'])  && isset($_POST['hourly_rate'])  && isset($_POST['daily_rate'])  && isset($_POST['organization1'])  && isset($_POST['position1'])  && isset($_POST['start_date1'])  && isset($_POST['end_date1'])  && isset($_POST['organization2'])  && isset($_POST['position2'])  && isset($_POST['start_date2'])  && isset($_POST['end_date2']) && isset($_POST['check'])) {
        
        $Prefix = $_POST['Prefix'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $sector = $_POST['sector'];
        $subsector = $_POST['subsector'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $employment_status = $_POST['employment_status'];
        $bio = $_POST['expertise'];
        $bio = $_POST['bio'];
        $nationality = $_POST['nationality'];
        $education = $_POST['education'];
        $recognition = $_POST['recognition'];
        $experience = $_POST['experience'];
        $hourly_rate = $_POST['hourly_rate'];
        $daily_rate = $_POST['daily_rate'];
        $organization1 = $_POST['organization1'];
        $position1 = $_POST['position1'];
        $start_date1 = $_POST['start_date1'];
        $end_date1 = $_POST['end_date1'];
        $organization2 = $_POST['organization2'];
        $position2 = $_POST['position2'];
        $start_date2 = $_POST['start_date2'];
        $end_date2 = $_POST['end_date2'];
        $term_agree = $_POST['term_agree'];
        
        

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
            $Insert = "INSERT INTO clientregistration(Prefix, firstname, lastname, email, phonenumber, sector, subsector, country, city, employment_status,expertise, bio, nationality, education,recognition,experience,hourly_rate,daily_rate,organization1,position1,start_date1,end_date1,organization2,position2,start_date2,end_date2,term_agree) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
                $stmt->bind_param("ssssssssisssss",$Prefix, $firstname, $lastname, $email, $phonenumber, $sector, $subsector, $country, $city, $employment_status,$expertise, $bio, $nationality, $education,$recognition,$experience,$hourly_rate,$daily_rate,$organization1,$position1,$start_date1,$end_date1,$organization2,$position2,$start_date2,$end_date2,$term_agree);
                if ($stmt->execute()) {
                    
                    header("Location: thankyouexpert.html");
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
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
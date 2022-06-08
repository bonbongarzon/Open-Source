<?php
session_start();

$username = "";
$email = "";
$errors = array();


$db = mysqli_connect('localhost', 'root', "", 'petagoniadb');

// when register BUTTON is CLICKED
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // IF INPUT IS EMPTY
    if (empty($username)) {
        echo "<script>alert('There are no fields to generate a report');document.location='register.php'</script>";
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Confirmation Password is required");
    }


    // NO ERRORS HAPPEN


    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    $insertdata = "SELECT * FROM customers WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $insertdata);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password_2); //ENCRYPTION
        $sql = "INSERT INTO customers (username, passcode, email)
                     VALUES ('$username', '$password','$email' )";
        mysqli_query($db, $sql);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = " You are now logged in";
        header('location: index.php'); //CONTROL or PROCEED THE USER TO LOCATION 

    }
}

// when login BUTTON is CLICKED
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = stripcslashes($username);
    $password = stripcslashes($password);

    //to prevent from mysqli injection  
    $username = mysqli_real_escape_string($db, $username);
    $password = mysqli_real_escape_string($db, $password);
    $hashed = md5($password);
    $sql = "select *from Customers where username = '$username' AND passcode = '$hashed' ";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = " You are now logged in";
        header('location: index.php');
    } else {
        array_push($errors, "Username and Password don't match");
    }
}








if (isset($_POST['pageA'])) {
    $petname = $_POST['petname'];
    $petbreed = $_POST['petbreed'];
    $petGender = $_POST['petGender'];
    $petbdate = $_POST['petbdate'];
    $concern = $_POST['concerns'];

    if (empty($petname)) {
        echo '<script>alert("No Name for Pet")</script>';
    }
    if (empty($petbreed)) {
        array_push($errors, "Pet Breed is required");
    }
    if (empty($petGender)) {
        array_push($errors, "Email is required");
    }
    if (empty($petbdate)) {
        array_push($errors, "Password is required");
    }

    if ($petGender == "Boy") {
        $_SESSION['petPronounsA'] = "his";
        $_SESSION['petPronounsB'] = "him";
    }
    if ($petGender == "Girl") {
        $_SESSION['petPronounsA'] = "her";
        $_SESSION['petPronounsB'] = "she";
    }
    $_SESSION['petname'] = $petname;
    $_SESSION['petbreed'] = $petbreed;
    $_SESSION['petGender'] = $petGender;
    $_SESSION['petbdate'] = $petbdate;
    $_SESSION['concern'] = $concern;
    header("location: petHealth.php");
}


if (isset($_POST['pageB'])) {

    $DistemperMonth = $_POST['DistemperMonth'];
    $DistemperYear = $_POST['DistemperYear'];
    $RabiesMonth = $_POST['RabiesMonth'];
    $RabiesYear = $_POST['RabiesYear'];
    $BordatellaMonth = $_POST['BordatellaMonth'];
    $BordatellaYear = $_POST['BordatellaYear'];
    $vetname = $_POST['vetname'];
    $vetAreaCode = $_POST['vetAreaCode'];
    $vetcontact = $_POST['vetcontact'];


    $vetcontact = $vetAreaCode . '' . $vetcontact;
    $Distemper = $DistemperMonth . '/' . $DistemperYear;
    $Rabies = $RabiesMonth . '/' . $RabiesYear;
    $Bordatella = $BordatellaMonth . '/' . $BordatellaYear;



    $_SESSION['Distemper'] = $Distemper;
    $_SESSION['Rabies'] = $Rabies;
    $_SESSION['Bordatella'] = $Bordatella;
    $_SESSION['vetname'] = $vetname;
    $_SESSION['vetcontact'] = $vetcontact;

    header("location:personaldetails.php");
}

if (isset($_POST['pageC'])) {

    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $ownercode = $_POST['ownercode'];
    $ownercontact = $_POST['ownercontact'];


    $ownercontact = $ownercode . $ownercontact;


    $Street = $_POST['Street'];
    $City = $_POST['City'];
    $State = $_POST['State'];
    $Zip = $_POST['Zip'];
    $Country = $_POST['Country'];

    $ownderAddress = $Street . ', ' . $City . ', ' . $State . ', ' . $Country . '.' . $Zip;

    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['ownercontact'] = $ownercontact;
    $_SESSION['ownderAddress'] = $ownderAddress;


    // if(isset ($_SESSION['username'], $_SESSION['petGender'],$_SESSION['petname'],$_SESSION['petbreed'],$_SESSION['petbdate'],$_SESSION['Distemper'] 
    // ,$_SESSION['Rabies'] 
    // ,$_SESSION['Bordatella'] 
    // ,$_SESSION['vetname'] 
    // ,$_SESSION['vetcontact']
    // ,$_SESSION['firstname']
    // ,$_SESSION['lastname']
    // ,$_SESSION['ownercontact']
    // ,$_SESSION['ownderAddress']) ){





    $final_username = $_SESSION['username'];

    //Pet's Basic Information PAGE A
    $final_petGender =  $_SESSION['petGender'];
    $final_petname =  $_SESSION['petname'];
    $final_petbreed =  $_SESSION['petbreed'];
    $final_petbdate =  $_SESSION['petbdate'];
    $final_concern =  $_SESSION['concern'];

    //Veneterinary Records PAGE B
    $final_Distemper =  $_SESSION['Distemper'];
    $final_Rabies =  $_SESSION['Rabies'];
    $final_Bordatella =  $_SESSION['Bordatella'];
    $final_vetname =   $_SESSION['vetname'];
    $final_vetcontact =   $_SESSION['vetcontact'];

    //Owners Information PAGE C
    $final_firstname = $_SESSION['firstname'];
    $final_lastname = $_SESSION['lastname'];
    $final_ownercontact =   $_SESSION['ownercontact'];
    $final_ownderAddress =   $_SESSION['ownderAddress'];




    $sql = "UPDATE Customers set First_Name = '$final_firstname', Last_Name='$final_lastname', M_Number='$final_ownercontact',Address = '$final_ownderAddress'  WHERE username = '$final_username ';";
    mysqli_query($db, $sql);

    $petsql = "INSERT INTO pets (CustomerID,PetName,PetBreed,PetGender,PetBirthdate,PetConcern,DistemperDate,RabiesDate,BordatellaDate,VetName,VetContact) 
VALUES ('$final_username','$final_petname','$final_petbreed','$final_petGender','$final_petbdate ','$final_concern','$final_Distemper','$final_Rabies','$final_Bordatella','$final_vetname','$final_vetcontact')";
    mysqli_query($db, $petsql);


    header("location:dashboard.php");
}


// echo print_r($_SESSION, TRUE);
// echo $_SESSION['username'];
// echo $_SESSION['petGender'];
// echo $_SESSION['petname'];
// echo $_SESSION['petbreed'];
//  echo $_SESSION['petbdate'];
//  echo $_SESSION['concern'];
//     echo $_SESSION['Distemper'] ;
//     echo $_SESSION['Rabies'] ;
//     echo $_SESSION['Bordatella'] ;
//     echo $_SESSION['vetname'] ;
//     echo $_SESSION['vetcontact'];
//     echo $_SESSION['firstname'];
// echo $_SESSION['lastname'];
// echo $_SESSION['ownercontact'];
// echo $_SESSION['ownderAddress'];









// when rlogout BUTTON is CLICKED
if (isset($_GET['logout'])) {
    session_destroy();
    header('location: login.php');
}


if (isset($_GET['generate'])) {
    $generate = rand(10000, 99999);

    echo $generate;
}


// $booklookup = "SELECT * FROM Pets WHERE CustomerID = $final_username";
// mysqli_query($db,$booklookup);

// if (!$booklookup) {
//     echo "Walang booking";
// }
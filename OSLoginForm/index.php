<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>


<body>

    <section class="pre-sec">
        <div class="header">
            <h1>01</h1>
            <a href="#">about</a>
            <span><a href="#">form</a> x post, 2022</span>
            <!-- <h1>about</h1>
                <h1>form x post,2022</h1> -->
        </div>
    </section>
    <section class="first-sec">

        <div class="main">
            <div class="left-cont">
                <h1>no talk, <br>
                    lets just build</h1>
                <br>
                <p>For Educational Purposes Only.
                    As a fulfillment on Open Source Technology
                </p>
            </div>
            <div class="right-cont">
                <h1>Welcome, please log-in</h1>
                <form name="form1" action="authentication.php" onsubmit = "return validation()" method="POST" >
                    <input type="text" placeholder="Username" id="uname" name="uname" >
                    <input type="password" placeholder="Password" id="pwd"  name="pwd" >
                    <button type="submit" name="login-submit">Log In</button>
                </form>

            </div>
        </div>
    </section>

    <script>  
    function validation()  
    {  
        var id=document.form1.uname.value;  
        var ps=document.form1.pwd.value;  
        if(id.length=="" && ps.length=="") {  
            alert("Username and Password fields are empty");  
            return false;  
        }  
        else  
        {  
            if(id.length=="") {  
                alert("Username is empty");  
                return false;  
            }   
            if (ps.length=="") {  
            alert("Password field is empty");  
            return false;  
            }  
        }                             
    }  
</script>  














</body>

</html>
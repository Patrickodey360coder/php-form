<?php
    //message classes
    $msg      = "";
    $msgClass = "";

    //Check for submit
    if(filter_has_var(INPUT_POST, 'submit')){
        //Get form data
        $name    = $_POST['name'];
        $email   = $_POST['email'];
        $message = $_POST['message'];

        //Check required fields
        if(!empty($name) && !empty($email) && !empty($message)){

            //if validation passed
            //check email validation
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                $msg      = "Please fill in a valid email";
                $msgClass = "alert-danger";
            }

            else {
                $toEmail = "patrickodey984@gmail.com";
                $subject = "contact request from ".'$name';
                $body = "<h1>Contact Request</h1>
                         <h4>Name: </h4><p>.'$name'.</p>
                         <h4>Email: </h4><p>.'$email'.</p>
                         <h4>Message: <h4><p>.'$message'</p>
                         ";
                        
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-Type:text/html;charset=UTF-8". "\r\n";  
                $headers .= "From: ". " $name "."<" . $email . ">";
                
                if(mail($toEmail, $subject, $body, $headers)){
                    $msg = "Your email has been sent";
                    $msgClass = "alert-success";
                }
                else {
                    $msg = "Email failed to send";
                    $msgClass = "alert-danger";
                }

            }
        }
        else {
            //if validation failed
            $msg      = "Please fill the required fields";
            $msgClass = "alert-danger";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

  <div class="container m-5 mx-auto">
    <?php if($msg != ""): ?>
        <div class="alert <?php echo $msgClass?>"><?php echo $msg?></div>
    <?php endif; ?> 

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Full name</label>
        <input type="text" class="form-control"  name="name" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Email address</label>
        <input type="text" class="form-control"  name="email" value="<?php echo isset($_POST['email'])? $email : ''; ?>">
      </div>
      <div class="mb-3">
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="message"  style="height: 100px">
                <?php echo isset($_POST['message'])? $message : '';?>
            </textarea>
            <label for="floatingTextarea2">Message</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>

    <!-- <a href="users.php">see all users</a> -->
  </div>
    
</body>
</html>
<?php

//CHAECK USER REQUEST METHOD
if($_SERVER['REQUEST_METHOD'] == 'POST'){

//ASSIGN VARIABLES
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $userphone =filter_var($_POST['usernumber'], FILTER_SANITIZE_NUMBER_INT);
    $usermail =  filter_var($_POST['usermail'], FILTER_SANITIZE_EMAIL);
    $usermessage = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    $nameError = '- Your Name Must Be from 4 to 11 Cheracters your name has' . strlen($username) . ' characters';
    $numberError = '- Your phone number must start with the key of your country to know your country key go to ' . '<a target="_blank" href="https://en.wikipedia.org/wiki/List_of_country_calling_codes">country key</a>';


    //CREAT FORM ERRORS ARRAY
    $formErrors = array();
    if(strlen($username) >= 30 ||strlen($username)  <= 3){
        $formErrors[] = $nameError;
    }

    if(isset($userphone)){
        $check= str_split($userphone, 1);
        if($check[0] != '+'){
            $formErrors[] = $numberError;
        }
    }

   $headers =    'From: ' . $username . '\r\n' . 'Phone Number: ' . $userphone . '\r\n' . 'Email: ' . $usermail;
   $subject =   'Contact Form From ' . $username;
   if(empty($formErrors)){

    #mail(To, Subject, Usermessage, $headers, Parameters)
        mail('kingyousef1426@gmail.com', $subject, $usermessage , $headers);

    $username = "";
    $userphone = "";
    $usermail = "";
    $usermessage = "";


    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Contact Form</title>
</head>
<body>
    <div class="form-container">
        <h1>GET IN TOUCH</h1>

        <form
        action="<?php echo $_SERVER['PHP_SELF']?>"
        method="post" 
        class="contact-form">
         
        <?php if(! empty($formErrors)):?>
       <div class="errors capita show-error">
       <?php 
            foreach($formErrors as $er):
                echo '<span class="error-span">' . $er . '</span>';
            endforeach;
        ?>
        </div>
        
    <?php elseif(isset($usermessage)): ?>
        <div class="valid capita" >
        <span> Message sent secsessfully </span>
        </div>
    <?php endif; ?>

            <input 
            type="text" 
            name="username"
            id="contact-input-name"
            class="contact-input name capita" 
            placeholder="type your name" 
            value="<?php if(isset($username)){echo $username;} ?>"/>

            <div class="errors capita"  id="name-error">
            <span class="error-span"> 
                <?php echo '- Your Name Must Be from 4 to 11 Cheracters your name has ' . /*strlen($username).*/ ' characters'; ?> 
            </span>
            </div>

            <input 
            type="text"
            name="usernumber"
            id="contact-input-number" 
            class="contact-input number" 
            placeholder="type your cell phone number" 
            value="<?php if(isset($userphone)){echo $userphone;} ?>" />
            
            <div class="errors capita"  id="num-error">
                <span class="error-span">
                     <?php echo '- Your phone number must start with the key of your country to know your country key go to ' . '<a target="_blank" href="https://en.wikipedia.org/wiki/List_of_country_calling_codes">country key</a>'; ?> 
                    </span>
                </div>

            <input
             type="email" 
             name="usermail" 
             id="contact-input-email" 
             class="contact-input email" 
             placeholder="type your email" 
             value="<?php if(isset($usermail)){echo $usermail;} ?>"/>
           
             <textarea 
             name="message"
             id="contact-textarea" 
             class="contact-textarea capita" 
             cols="50" 
             rows="10" 
             placeholder="type your butiful message">
             <?php if(isset($usermessage)){echo $usermessage;} ?>
            </textarea>

            <input
             type="submit"
             value="send message" 
             class="capita"/>

        </form>
    </div>
    <script src="./JS/main.js"></script>
</body>
</html>

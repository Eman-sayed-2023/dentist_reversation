<?php

$conn = mysqli_connect('localhost','root','','contactt_db') or die('connection failed');

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $date = $_POST['date'];
   $selected_doctor = $_POST['selected_doctor'];
   $sentmessage = $_POST['sentmessage'];
   $insert = mysqli_query($conn, "INSERT INTO `contactt_form`(name, email, number, date ,selected_doctor,sentmessage) VALUES('$name','$email','$number','$date' ,'$selected_doctor','$sentmessage')") or die('query failed');
   if($insert){
      $message[] = 'appointment made successfully!';
   }else{
      $message[] = 'appointment failed';
   }
   $to_email = "emansayed6361@gmail.com";
      
      // Set the subject of the email
      $subject = "New appointment request";
      
      // Get the form data from the POST request
   
      
      // Compose the email message for the admin
      $admin_html_message = "<html><body>";
      $admin_html_message .= "<p>Dear admin,</p>";
      $admin_html_message .= "<p>A new appointment request has been submitted with the following details:</p>";
      $admin_html_message .= "<ul>";
      $admin_html_message .= "<li>Name: " . $name . "</li>";
      $admin_html_message .= "<li>Email: " . $email . "</li>";
      $admin_html_message .= "<li>Number: " . $number . "</li>";
      $admin_html_message .= "<li>Date: " . $date . "</li>";
      $admin_html_message .= "</ul>";
      $admin_html_message .= "</body></html>";
      
      // Compose the email message for the client
      $client_html_message = "<html><body>";
      $client_html_message .= "<p>Dear " . $name . ",</p>";
      $client_html_message .= "<p>Thank you for submitting your appointment request. We have received the following details:</p>";
      $client_html_message .= "<ul>";
      $client_html_message .= "<li>Name: " . $name . "</li>";
      $client_html_message .= "<li>Email: " . $email . "</li>";
      $client_html_message .= "<li>Number: " . $number . "</li>";
      $client_html_message .= "<li>Date: " . $date . "</li>";
      $client_html_message .= "</ul>";
      $client_html_message .= "<p>We will get back to you as soon as possible to confirm your appointment.</p>";
      $client_html_message .= "<p>Best regards,</p>";
      $client_html_message .= "<p>Your Name</p>";
      $client_html_message .= "</body></html>";
      
      // Set the headers for the email messages
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= "From: Your Name <emansayed6361@gmail.com>" . "\r\n";
      $headers .= "Cc: " . $email . "\r\n";
      // Set the headers for the email messages
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= "From: Your Name <emansayed6361@gmail.com>" . "\r\n";
      $headers .= "Cc: " . $email . "\r\n";
      $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
      $headers .= "X-Sender: " . $_SERVER["SERVER_NAME"] . "\r\n";
      $headers .= "Return-Path: emansayed6361@gmail.com\r\n";
      $headers .= "Sender: emansayed6361@gmail.com\r\n";
      $headers .= "X-Hog-Footer: https://github.com/mailhog/MailHog\r\n";
      ini_set('SMTP', 'localhost');
   ini_set('smtp_port', 1025);
      
      
      
      // Send the email to the admin using the mail() function and MailHog as the email server
      $mail_sent = mail($to_email, $subject, $admin_html_message, $headers, "-f emansayed6361@gmail.com");
      
      // Send the confirmation email to the client
      $client_mail_sent = mail($email, "Appointment request confirmation", $client_html_message, $headers, "-f emansayed6361@gmail.com");
      
      // Check if the emails were sent successfully
      if ($mail_sent && $client_mail_sent) {
         echo '<div id="confirmation-message" style="background-color: #00b8b8; border-radius: 5px; padding: 10px; position: fixed; bottom: 0; left: 0; right: 0; opacity: 1; transition: opacity 0.5s ease-out;">
        <p style="color: white; font-size: 16px; font-weight: bold; margin: 0;">A confirmation email has been sent to ' . $email . '.</p>
      </div>';

echo '<script>
        setTimeout(function() {
          var confirmationMessage = document.getElementById("confirmation-message");
          if (confirmationMessage) {
            confirmationMessage.style.opacity = "0";
            setTimeout(function() {
              confirmationMessage.parentNode.removeChild(confirmationMessage);
            }, 500);
          }
        }, 2500);
      </script>';

 



      } else {
         echo "Sorry, the email could not be sent. Please try again later.";
      }
      
   






   

};

?>






<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> Dentist Website Design </title>

   <!-- <link rel="shortcut icon" type="icon-3.svg" href="favicon.png" /> -->
   <!-- Place favicon.ico in the root directory -->

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">
<!-- AOS -->
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


</head>
<body>
   
<!-- header section starts  -->

<header class="header fixed-top">

   <div class="container">

      <div class="row align-items-center justify-content-between">

         <a href="#home" class="logo">Dental<span> Implant.</span></a>

         <nav class="nav">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#services">services</a>
            <a href="#reviews">reviews</a>
            <a href="#contact">contact</a>
         </nav>

         <a href="#contact" class="link-btn">make appointment</a>

         <div id="menu-btn" class="fas fa-bars"></div>

      </div>

   </div>

</header>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

   <div class="container">

      <div class="row min-vh-100 align-items-center">
         <div class="content text-center text-md-left">
            <h3 data-aos="zoom-in-right">let us brighten your smile</h3>
            <p data-aos="zoom-in-left">Brightening your smile can have a significant impact on your overall appearance and self-confidence. There are several ways to achieve a brighter smile, ranging from simple daily habits to professional dental treatments..</p>
            <a data-aos="zoom-out-right" href="#contact" class="link-btn">make appointment</a>
         </div>
      </div>

   </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

   <div class="container">

      <div class="row align-items-center">

         <div class="col-md-6 image" data-aos="fade-up-right">
            <img src="images/img.jpg" class="w-100 mb-5 mb-md-0" alt="">
         </div>

         <div class="col-md-6 content"data-aos="fade-up-left">
            <span>about us</span>
            <h3>True Healthcare For Your Family</h3>
            <p>True healthcare for your family also means having access to a range of healthcare professionals, including doctors, nurses, and specialists, who can collaborate and work together to provide the best possible care. It also involves leveraging the latest medical technologies and treatments to ensure that patients receive the most advanced care available.!</p>
            <a href="#contact" class="link-btn">make appointment</a>
         </div>

      </div>

   </div>

</section>

<!-- about section ends -->

<!-- services section starts  -->

<section class="services" id="services">

   <h1 class="heading">our services</h1>

   <div class="box-container container">

      <div class="box" data-aos="flip-left">
         <img src="images/icon-1.svg" alt="">
         <h3>Alignment specialist</h3>
         <p>Providing guidance and advice to clients on how to maintain proper alignment of their equipment.</p>
      </div>

      <div class="box" data-aos="flip-right">
         <img src="images/icon-2.svg" alt="">
         <h3>Cosmetic dentistry</h3>
         <p>Dental implants: These are artificial tooth roots that are surgically implanted into the jawbone to support adental crown.</p>
      </div>

      <div class="box" data-aos="flip-left">
         <img src="images/icon-3.svg" alt="">
         <h3>Oral hygiene experts</h3>
         <p>Overall, oral hygiene experts work to promote and maintain optimal oral health and prevent oral diseases and conditions. </p>
      </div>

      <div class="box" data-aos="flip-right">
         <img src="images/icon-4.svg" alt="">
         <h3>Root canal specialist</h3>
         <p>A root canal specialist, also known as an endodontist, is a dentist who specializes in diagnosing and treating problems related to the inside of the tooth</p>
      </div>

      <div class="box" data-aos="flip-left">
         <img src="images/icon-5.svg" alt="">
         <h3>Live dental advisory</h3>
         <p>Live dental advisory is a service that allows individuals to consult with a dental professional in real-time to receive advice or guidance on dental issues. </p>
      </div>

      <div class="box" data-aos="flip-right">
         <img src="images/icon-6.svg" alt="">
         <h3>Cavity inspection</h3>
         <p>A cavity inspection is a dental procedure performed by a dentist to check for signs of tooth decay.the dentist will visually examine your teeth for any signs of decay or damage</p>
      </div>

   </div>

</section>

<!-- services section ends -->

<!-- process section starts  -->

<section class="process">

   <h1 class="heading">work process</h1>

   <div class="box-container container">

      <div class="box" data-aos="fade-down-right">
         <img src="images/process-1.png" alt="">
         <h3>Cosmetic Dentistry</h3>
         <p>Cosmetic dentistry is a specialized field of dentistry that focuses on improving the appearance of a person's teeth, gums, and overall smile. While traditional dentistry focuses on preventing and treating dental diseases, cosmetic dentistry procedures are performed solely to enhance the aesthetics of the teeth and smile.</p>
      </div>

      <div class="box" data-aos="fade-down-left">
         <img src="images/process-2.png" alt="">
         <h3>Pediatric Dentistry</h3>
         <p>Pediatric dentists provide a range of services, including preventive care, such as regular dental cleanings and fluoride treatments, and restorative care, such as fillings, crowns, and extractions. They also provide education and counseling to parents and children on proper oral hygiene, diet, and the prevention of dental problems</p>
      </div>

      <div class="box" data-aos="fade-down-right">
         <img src="images/process-3.png" alt="">
         <h3>Dental Implants</h3>
         <p>Dental implants are a popular choice for people who have lost one or more teeth, as they provide a permanent and natural-looking solution that can last for many years with proper care. They are also more comfortable and functional than other types of dental restorations, such as dentures or bridges, as they do not rely on adjacent teeth for support.</p>
      </div>

   </div>

</section>

<!-- process section ends -->

<!-- reviews section starts  -->

<section class="reviews" id="reviews">

   <h1 class="heading"> satisfied clients </h1>

   <div class="box-container container">

      <div class="box" data-aos="flip-down">
         <img src="images/pic-1.png" alt="">
         <p>I had a great experience at this dentist center. The staff were all friendly and helpful, and the dentist was very skilled and knowledgeable. They were able to fit me in for a cleaning and check-up at short notice, and I left feeling confident that my teeth were in good shape. Will definitely be back!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Will Smith</h3>
         <span>satisfied client</span>
      </div>

      <div class="box" data-aos="flip-down">
         <img src="images/pic-2.png" alt="">
         <p>I was nervous about going to the dentist, but the team at this center put me at ease right away. They were patient and kind, and really listened to my concerns. The procedure went smoothly and I felt comfortable throughout. Would definitely recommend to anyone who's anxious about dental work!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Sara Adam</h3>
         <span>satisfied client</span>
      </div>

      <div class="box" data-aos="flip-down">
         <img src="images/pic-3.png" alt="">
         <p>I had a fantastic experience at this dentist center. The staff were friendly and professional, and the dentist was very knowledgeable.I was really impressed with the level of care and attention I received, even on short notice I felt like I was in good hands throughout my appointment. Highly recommend!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>John wick</h3>
         <span>satisfied client</span>
      </div>

   </div>

</section>

<!-- reviews section ends -->

<!--  -->
<h1 class="heading"> Doctors</h1>

<div class="container">
   
<div class="row row-cols-1 row-cols-md-3 g-4">
   <div class="col" data-aos="zoom-in-right">
      <div class="card h-100">
      <img src="images/im3.jpg" class="card-img-top" alt="...">
      <div class="card-body">
         <h5 class="card-title"> Dr.Kaja Kallas </h5>
         <p class="card-text">Dentist specialized in pediatric dentistry, adult dentistry, dental implants, filling and root canal treatment, cosmetic dentistry and prosthodontics.</p>
      </div>
      <div class="card-footer">
         <small class="text-muted">100$-150$ </small>
      </div>
      </div>
   </div>
   <div class="col" data-aos="zoom-in-right">
      <div class="card h-100">
      <img src="images/im2.jpg" class="card-img-top" alt="...">
      <div class="card-body">
         <h5 class="card-title">Dr.James Liam</h5>
         <p class="card-text">Oral surgery specialist, cosmetic dentistry, prosthodontics, and nerve fillings -harfrd University.</p>
      </div>
      <div class="card-footer">
         <small class="text-muted">40$-60$</small>
      </div>
      </div>
   </div>
   <div class="col" data-aos="zoom-out-left">
      <div class="card h-100">
      <img src="images/im9.jpg" class="card-img-top" alt="...">
      <div class="card-body">
         <h5 class="card-title">Dr.William oliver </h5>
         <p class="card-text"> Dental implant and cosmetic consultants - Oxford University Member of the American Dental Association - New Jersey.</p>
      </div>
      <div class="card-footer">
         <small class="text-muted">80$-120$</small>
      </div>
      </div>
   </div>
</div>
<br> <br> 
<div class="row row-cols-1 row-cols-md-3 g-4">
   <div class="col" data-aos="zoom-out-right">
      <div class="card h-100">
      <img src="images/im5.jpg" class="card-img-top" alt="...">
      <div class="card-body">
         <h5 class="card-title">Dr.Emma Benjamin</h5>
         <p class="card-text"> Oral and dental surgery specialist and a master’s degree in the Department of Cosmetic Fillings and Conservative Treatment at American University.</p>
      </div>
      <div class="card-footer">
         <small class="text-muted">70$-100$</small>
      </div>
      </div>
   </div>
   <div class="col" data-aos="zoom-in-right">
      <div class="card h-100">
      <img src="images/im11.jpg" class="card-img-top" alt="...">
      <div class="card-body">
         <h5 class="card-title">Dr.Oliver james</h5>
         <p class="card-text">Oral and cosmetic dentistry specialist - britian University. Fellow of the Royal Dental University in Britain.</p>
      </div>
      <div class="card-footer">
         <small class="text-muted">30$-80$</small>
      </div>
      </div>
   </div>
   <div class="col">
   <div class="card h-100"  data-aos="zoom-out-left">
      <img src="images/im7.jpg" class="card-img-top" alt="...">
      <div class="card-body">
      <h5 class="card-title"> Dr.Henry noah </h5>
      <p class="card-text"> Consultant Oral and Dental Medicine - Bachelor of Oral and Dental Medicine, britian University Diploma in Hospital Management and Infection Control - American University.</p>
      </div>
      <div class="card-footer">
      <small class="text-muted">50$-70$</small>
      </div>
   </div>
   </div>
</div>
</div>
<!-- end  -->
<!-- contact section starts  -->

<section class="contact" id="contact" data-aos="flip-down">

   <h1 class="heading">make appointment</h1>

   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
   <?php 
   $message = array();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      // Your form handling code here
   }

   // Display messages
   if(!empty($message)){
      foreach($message as $msg){
         echo '<p class="message">'.$msg.'</p>';
      }
   }


?>


      <br/> <br/>


      <span>your name :</span>
      <input type="text" name="name" placeholder="enter your name" class="box" required>
      <span>your email :</span>
      <input  type="email" name="email" placeholder="enter your email" class="box" required>
      <span>your number :</span>
      <input  type="number" name="number" placeholder="enter your number" class="box" required>
      <span>appointment date :</span>
      <input  type="datetime-local" name="date" class="box" required>
      <span>choice your doctor :</span>
      <select class="box" name="selected_doctor">
      <option value="">Select a Doctor</option>
      <option value="Dr.John Doe">Dr.John Doe</option>
      <option value="Dr.Jane Smith">Dr.Jane Smith</option>
      <option value="Dr.Michael Brown">Dr.Michael Brown</option>
      <option value="Dr.Sarah Lee">Dr.Sarah Lee</option>
      <option value="Dr.Robert Johnson">Dr.Robert Johnson</option>
      <option value="Dr.David Kim">Dr.David Kim</option>
      </select>
      <span>Leave Your Message :</span>
      <textarea class="box"type="sentmessage"  name="sentmessage" placeholder="Type your Message Details Here..." tabindex="5" required></textarea>
      
      <input type="submit" value="make appointment" name="submit" class="link-btn">
      


   </form> 
</section>

<!-- contact section ends -->

<!-- footer section starts  -->

<section class="footer">

   <div class="box-container container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>phone number</h3>
         <p>01030282620</p>
         <p>01001179227</p>
      </div>
      
      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>our address</h3>
         <p>Eldoqy, egypt </p>
      </div>

      <div class="box">
         <i class="fas fa-clock"></i>
         <h3>opening hours</h3>
         <p>00:07am to 10:00pm</p>
      </div>

      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>email address</h3>
         <p>Emansayed6361@gmail.com</p>
         <p>ahmedshabasy27@gmail.com</p>
      </div>

   </div>

   <div class="credit"> &copy; copyright @ <?php echo date('Y'); ?> by <span>AHMED & EMAN</span>  </div>

</section>

<!-- footer section ends -->







<!-- custom js file link  -->
<script src="script.js"></script>
<!-- AOS -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>


<script>
   AOS.init();
</script>

</body>
</html>
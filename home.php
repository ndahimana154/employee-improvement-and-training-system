<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Training System</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link Font-awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Header -->
    <?php
        include("php/out-header.php");
    ?>
    
    <!-- Hero Section -->
    <section id="hero" class="row bg-white">
        <div class="col-md-2"></div>
        <div id="welcome" class="col-md-8 p-3" style="margin-top: 80px;
            ">
            <h2 class="text-primary h4 p-3" style="">
            <span class="te">
                <!-- WELCOME TO -->
            </span> <br>
            Employee Trainings and Imporvement System
            </h2>
            <p class="p-3">
            Discover the Employee Training System, a dynamic platform offering a diverse array 
            of expert-curated training courses. Unleash your potential with flexible learning, 
            interactive assessments, and progress tracking. From programming languages to management 
            strategies, our user-friendly interface empowers both beginners and seasoned professionals 
            to learn at their own pace. Engage in collaborative discussions, earn certifications, and 
            stay aligned with industry trends. Elevate your skills, advance your career, and thrive in 
            an ever-evolving landscape of knowledge and expertise.
            </p>
        </div>
    </section>
    
    <!-- Other Information Section -->
    <section class="py-5">
        <div class="container">
            <h3>
                OUR PURPOSES
            </h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/pexels-fauxels-3184423.jpg" class="card-img-top" alt="Image 1">
                        <div class="card-body">
                            <h5 class="card-title">Efficient Training Management</h5>
                            <p class="card-text">
                                Streamline training creation, scheduling, and monitoring for employees. Administrators can easily organize sessions and track progress.
                            </p>
                            <!-- <a href="#" class="btn btn-primary">Learn More</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/pexels-ivan-samkov-4240497.jpg" class="card-img-top" alt="Image 2">
                        <div class="card-body">
                            <h5 class="card-title">Enhanced Communication</h5>
                            <p class="card-text">
                            Foster interaction between employees and trainers. Integrated messaging allows quick questions and collaboration.
                            </p>
                            <!-- <a href="#" class="btn btn-primary">Learn More</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="images/pexels-rdne-stock-project-7948054.jpg" class="card-img-top" alt="Image 3">
                        <div class="card-body">
                            <h5 class="card-title">Data-Driven Insights</h5>
                            <p class="card-text">
                            Access performance analytics and reports. Evaluate training impact and make informed decisions for improvement.
                            </p>
                            <!-- <a href="#" class="btn btn-primary">Learn More</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <?php include("php/footer.php") ?>
    
    <!-- Link Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Custom CSS for hero section */
        #hero {
            position: relative;
            overflow: hidden;
        }
    </style>
</body>
</html>

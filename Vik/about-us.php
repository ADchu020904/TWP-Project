<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <?php include 'partials/user/userstyle.html'; ?>
    <style>
        .team_section {
            padding: 50px 0;
        }
        .team_member {
            text-align: center;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 30px;
            margin: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .team_image {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .team_member h3 {
            color: #343a40;
            margin-bottom: 10px;
        }
        .team_member p {
            color: #495057;
            margin-bottom: 5px;
        }
        .team_member .bio {
            margin-top: 10px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <?php include 'partials/user/userheader.html'; ?>
    <!-- End Header Section -->

    <!-- about us section start -->
    <div class="about_us_section layout_padding">
        <div class="container">
            <h1 class="about_us_title">About Us</h1>
            <p class="about_us_text">Welcome to our company. We are dedicated to providing the best products and services to our customers. Our team works hard to ensure customer satisfaction and we are always here to help you with any questions or concerns you may have.</p>
            <p class="about_us_text">Our mission is to deliver high-quality products that meet the needs and expectations of our customers. We believe in innovation, quality, and customer service. Thank you for choosing us!</p>
            <h2 class="team_title">Meet Our Team</h2>
            <div class="row team_section">
                <div class="col-md-6 col-lg-3">
                    <div class="team_member">
                        <img src="images/jeremy.jpg" alt="Jeremy" class="team_image">
                        <h3>Jeremy</h3>
                        <p>Role: Developer</p>
                        <p class="bio">Jeremy is a skilled developer with over 5 years of experience in web development. He specializes in front-end technologies and is passionate about creating interactive user experiences.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="team_member">
                        <img src="images/eddie.jpg" alt="Eddie" class="team_image">
                        <h3>Eddie</h3>
                        <p>Role: Designer</p>
                        <p class="bio">Eddie is a creative designer with a keen eye for detail. He has a background in graphic design and is responsible for the visual aesthetics of our products.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="team_member">
                        <img src="images/JiaHe.jpg" alt="Goh" class="team_image">
                        <h3>Goh</h3>
                        <p>Role: Project Manager</p>
                        <p class="bio">Goh is an experienced project manager who ensures that all projects are completed on time and within budget. He has a strong background in project management and team leadership.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="team_member">
                        <img src="images/Tong.jpg" alt="Tong" class="team_image">
                        <h3>Tong</h3>
                        <p>Role: QA Engineer</p>
                        <p class="bio">Tong is a dedicated QA engineer who is responsible for ensuring the quality of our products. She has a meticulous approach to testing and is committed to delivering bug-free software.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about us section end -->

    <!-- footer section -->
    <?php include 'partials/user/userfooter.html'; ?>
    <!-- footer section end -->
</body>
</html>
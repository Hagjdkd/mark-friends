<?php
include 'plugin/heads.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Mark's & Friend's Bookstore</title>
    <link rel="icon" href="uploads/bg.jpg" type="image/jpg">
    <style>
        /* Basic page styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Contact Section */
        .contact-section {
            padding: 50px 20px;
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
        }

        .contact-title {
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
        }

        .contact-description {
            font-size: 18px;
            color: #555;
            margin: 0 auto 30px;
        }

        /* Developer cards styling */
        .developer-cards {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .developer-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 280px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .developer-card:hover {
            transform: scale(1.05);
        }

        .developer-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .developer-photo:hover {
            transform: scale(1.1);
        }

        .developer-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-icons a {
            font-size: 20px;
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #3498db;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: auto;
            padding-top: 60px;
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 10%;  /* Adjust width to make the image smaller */
            max-width: 400px;  /* Max width to prevent it from being too large */
            height: auto;
            border-radius: 10px;  /* Optional: round the corners of the image */
        }

        .modal-info {
            text-align: center;
            color: white;
            margin-top: 15px;
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* Footer styling */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            margin-top: auto;
            width: 100%;
        }
        /* Logo Styling */
/* Logo Styling */
/* Modify the logo container */
.c_log {
    display: flex;
    flex-direction: row; /* Align logos in a row */
    gap: 10px; /* Add space between logos */
    justify-content: center; /* Center the logos horizontally */
}

/* Modify individual logos styling if needed */
.logo {
    width: 40px; /* Set the width to 40px */
    height: 40px; /* Set the height to 40px */
    border-radius: 50%; /* Keep logos circular */
    object-fit: cover; /* Ensure the image covers the area without distortion */
}


/* Ensure the logo is responsive */
@media screen and (max-width: 768px) {
    .logo {
        width: 30px; /* Make it slightly smaller on smaller screens */
        height: 30px;
    }
}


    </style>
</head>
<body>

    <!-- Contact Section -->
    <section class="contact-section">
        <h2 class="contact-title">Contact Us</h2>
        <p class="contact-description">
            If you have any questions or need assistance, feel free to get in touch with us. Below are the developers of the bookstore.
        </p>

        <!-- Developer Info Cards -->
        <div class="developer-cards">
            <!-- Developer 1 -->
            <div class="developer-card">
                <img src="uploads/masarap.jpg" alt="Developer 1" class="developer-photo" id="img1" onclick="openModal('img1', 'Mark Anton Gerundio', 'Lead Developer', 'https://www.facebook.com/developer1', 'https://www.instagram.com/developer1', 'https://t.me/developer1', 'Male', '19', 'Message for future developers')">
                <div class="developer-name">Mark Anton Gerundio</div>
                <p>Lead Developer</p>
                <div class = "c_logo">
                  <a href="https://www.facebook.com/Markantonsuyom" target="_blank">
                      <img src="uploads/facebook.png" alt="Description of image" class="logo" />
                  </a>
                  <a href="https://www.facebook.com/Markantonsuyom" target="_blank">
                      <img src="uploads/tele.jpg" alt="Description of image" class="logo" />
                  </a>
                  <a href="https://www.facebook.com/Markantonsuyom" target="_blank">
                      <img src="uploads/instagram.png" alt="Description of image" class="logo" />
                  </a>
                </div>
            </div>

            <!-- Developer 2 -->
            <div class="developer-card">
                <img src="uploads/shan.png" alt="Developer 2" class="developer-photo" id="img2" onclick="openModal('img2', 'Shaine Michael Garcia', 'Frontend Developer', 'https://www.facebook.com/developer2', 'https://www.instagram.com/developer2', 'https://t.me/developer2', 'Male', '18', 'Always learning and improving.')">
                <div class="developer-name">Shaine Michael Garcia</div>
                <p>Frontend Developer</p>
                  <div class = "c_logo">
                  <a href="https://www.facebook.com/Markantonsuyom" target="_blank">
                      <img src="uploads/facebook.png" alt="Description of image" class="logo" />
                  </a>
                  <a href="https://www.facebook.com/Markantonsuyom" target="_blank">
                      <img src="uploads/tele.jpg" alt="Description of image" class="logo" />
                  </a>
                  <a href="https://www.facebook.com/Markantonsuyom" target="_blank">
                      <img src="uploads/instagram.png" alt="Description of image" class="logo" />
                  </a>
                  </div>
            </div>

            <!-- Developer 3 -->
            <div class="developer-card">
                <img src="uploads/myth.jpg" alt="Developer 3" class="developer-photo" id="img3" onclick="openModal('img3', 'John Myth Caribo', 'Backend Developer', 'https://www.facebook.com/developer3', 'https://www.instagram.com/developer3', 'https://t.me/developer3', 'Male', '18', 'Creating code that lasts and inspires.')">
                <div class="developer-name">John Myth Caribo</div>
                <p>Backend Developer</p>
                  <div class = "c_logo">
                    <a href="https://www.facebook.com/Markantonsuyom" target="_blank">
                        <img src="uploads/facebook.png" alt="Description of image" class="logo" />
                    </a>
                    <a href="https://www.facebook.com/Markantonsuyom" target="_blank">
                        <img src="uploads/tele.jpg" alt="Description of image"  class="logo"/>
                    </a>
                    <a href="https://www.facebook.com/Markantonsuyom" target="_blank">
                        <img src="uploads/instagram.png" alt="Description of image" class="logo"/>
                    </a>
                  </div>
            </div>
        </div>
    </section>

    <!-- Modal for Image Zoom and Developer Info -->
    <div id="myModal" class="modal">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImg">
        <div class="modal-info">
            <h3 id="modalName"></h3>
            <p id="modalRole"></p>
            <p><strong>Gender:</strong> <span id="modalGender"></span></p>
            <p><strong>Age:</strong> <span id="modalAge"></span></p>
            <p><strong>Additional Info:</strong> <span id="modalInfo"></span></p>
            <div class="social-icons">
                <a id="facebook" target="_blank" title="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
                <a id="instagram" target="_blank" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a id="telegram" target="_blank" title="Telegram">
                    <i class="fab fa-telegram"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Mark's & Friend's Bookstore | All Rights Reserved</p>
    </footer>

    <script>
        function openModal(imgId, name, role, fbLink, instaLink, telegramLink, gender, age, additionalInfo) {
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("modalImg");
            var modalName = document.getElementById("modalName");
            var modalRole = document.getElementById("modalRole");
            var modalGender = document.getElementById("modalGender");
            var modalAge = document.getElementById("modalAge");
            var modalInfo = document.getElementById("modalInfo");
            var facebook = document.getElementById("facebook");
            var instagram = document.getElementById("instagram");
            var telegram = document.getElementById("telegram");

            // Set the image source
            var img = document.getElementById(imgId);
            modalImg.src = img.src;

            // Set the developer's name and role
            modalName.innerHTML = name;
            modalRole.innerHTML = role;

            // Set the developer's gender, age, and additional info
            modalGender.innerHTML = gender;
            modalAge.innerHTML = age;
            modalInfo.innerHTML = additionalInfo;

            // Set the social media links
            facebook.href = fbLink;
            instagram.href = instaLink;
            telegram.href = telegramLink;

            // Display the modal
            modal.style.display = "block";
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    </script>

</body>
</html>

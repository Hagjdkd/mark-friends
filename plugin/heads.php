  <header>
      <div class="header-container">
          <div class="logo">
              Mark's & Friend's Bookstore
          </div>
          <nav>
              <ul class="nav">
                  <li><a href="promotional.php">Home</a></li>
                  <li><a href="about.php">About</a></li>
                  <li><a href="contact.php">Contact</a></li>
              </ul>
          </nav>
          <!-- Add the Sign In and Sign Up buttons -->
          <div class="auth-buttons">
              <a href="./Login.php" class="auth-btn sign-in-btn">Sign In</a>
              <a href="./register.php" class="auth-btn sign-up-btn">Sign Up</a>
          </div>
      </div>
  </header>
<style>
  /* Style the header container */
.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #f1f1f1;
}

/* Style the logo */
.logo {
    font-size: 25px;
    font-weight: bold;
}

/* Style the navigation links */
.nav {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0;
}

.nav li {
    display: inline;
}

.nav a {
    text-decoration: none;
    color: black;
    padding: 12px 16px;
    border-radius: 4px;
    font-size: 18px;
    transition: background-color 0.3s ease;
}

.nav a:hover {
    background-color: #ddd;
    color: black;
}

.nav .active {
    background-color: dodgerblue;
    color: white;
}

/* Style for the auth buttons */
.auth-buttons {
    display: flex;
    gap: 15px;
    align-items: center;
}

.auth-btn {
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
    transition: background-color 0.3s ease;
}

.sign-in-btn {
    background-color: #3498db;
    color: white;
}

.sign-in-btn:hover {
    background-color: #2980b9;
}

.sign-up-btn {
    background-color: #2ecc71;
    color: white;
}

.sign-up-btn:hover {
    background-color: #27ae60;
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
    .header-container {
        flex-direction: column;
        align-items: center;
    }

    .nav {
        flex-direction: column;
        gap: 10px;
    }

    .auth-buttons {
        margin-top: 10px;
        flex-direction: column;
        gap: 10px;
    }
}

/* Additional responsiveness for smaller screens */
@media (max-width: 500px) {
    .nav a {
        display: block;
        text-align: left;
        padding: 10px;
    }

    .auth-buttons {
        margin-top: 20px;
        align-items: center;
    }
}

</style>
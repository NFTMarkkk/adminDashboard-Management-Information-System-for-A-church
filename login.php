<?php
// login.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="css/style.css"> <!-- Your main CSS file -->
</head>
<body>

<form id="loginForm">
    <center><h3>Login</h3></center>

    <label for="email">Email</label>
    <input type="email" id="email" placeholder="Email or Phone" required>
    <small class="error" id="emailError"></small>

    <label for="password">Password</label>
    <div class="password-container">
        <input type="password" id="password" placeholder="Password" required>
        <span id="togglePassword" class="eye">‿</span>
    </div>
    <small class="error" id="passwordError"></small>

    <button type="submit">Login</button>

    <center><p>Don't have an account?</p></center>
    <center><a href="register.php">Register Here</a></center>
</form>

<!-- ✅ Success Modal -->
<div class="modal-container" id="successModal">
    <div class="modal">
        <p>Login Successful!</p>
        <button id="closeSuccess">Go</button>
    </div>
</div>

<!-- ❌ Error Modal -->
<div class="modal-container" id="errorModal">
    <div class="modal">
        <p id="errorMessage">❌ Something went wrong!</p>
        <button id="closeError">Close</button>
    </div>
</div>

<script type="module">
// Import Firebase
import { initializeApp } from "https://www.gstatic.com/firebasejs/12.1.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/12.1.0/firebase-analytics.js";
import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/12.1.0/firebase-auth.js";

// Firebase Config
const firebaseConfig = {
    apiKey: "AIzaSyDzIhr1bClNOz3RdT74m79cyxrTqhND8xs",
    authDomain: "admindashboard-e0aac.firebaseapp.com",
    projectId: "admindashboard-e0aac",
    storageBucket: "admindashboard-e0aac.firebasestorage.app",
    messagingSenderId: "707100823853",
    appId: "1:707100823853:web:6e60d4290f11ad681643a4",
    measurementId: "G-VB3TZHZ89E"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const auth = getAuth();

// Grab DOM elements
const form = document.getElementById("loginForm");
const email = document.getElementById("email");
const password = document.getElementById("password");
const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordError");

const successModal = document.getElementById("successModal");
const closeSuccess = document.getElementById("closeSuccess");
const errorModal = document.getElementById("errorModal");
const errorMessage = document.getElementById("errorMessage");
const closeError = document.getElementById("closeError");

// Submit event
form.addEventListener("submit", function(e) {
    e.preventDefault();
    let valid = true;

    // Reset errors
    emailError.textContent = "";
    passwordError.textContent = "";

    // Validate email
    if (!email.value.includes("@")) {
        emailError.textContent = "Please enter a valid email.";
        valid = false;
    }
    // Validate password
    if (password.value.length < 6) {
        passwordError.textContent = "Password must be at least 6 characters.";
        valid = false;
    }

    if (!valid) {
        errorMessage.textContent = "Please fix the errors and try again.";
        errorModal.style.display = "flex";
        return;
    }

    // Firebase sign-in
    signInWithEmailAndPassword(auth, email.value, password.value)
        .then(() => {
            successModal.style.display = "flex";
        })
        .catch((error) => {
            errorMessage.textContent = error.message;
            errorModal.style.display = "flex";
        });
});

// Close success modal → redirect to index.php
closeSuccess.addEventListener("click", () => {
    window.location.href = "index.php";
});

// Close error modal → just hide modal
closeError.addEventListener("click", () => {
    errorModal.style.display = "none";
});

// Allow closing modal by clicking outside
window.addEventListener("click", (e) => {
    if (e.target === successModal) {
        window.location.href = "index.php";
    }
    if (e.target === errorModal) {
        errorModal.style.display = "none";
    }
});

const togglePassword = document.getElementById("togglePassword");

togglePassword.addEventListener("click", () => {
    const type = password.type === "password" ? "text" : "password";
    password.type = type;
    
    // Optional: change icon style when toggled
    togglePassword.textContent = type === "password" ? "‿" : "👁";
});
</script>

</body>
</html>

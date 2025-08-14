// 1️⃣ Grab DOM elements
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

// 2️⃣ Firebase setup
import { initializeApp } from "https://www.gstatic.com/firebasejs/12.1.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/12.1.0/firebase-analytics.js";
import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/12.1.0/firebase-auth.js";

const firebaseConfig = { /* your config */ };
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const auth = getAuth();

// 3️⃣ Form submit listener
form.addEventListener("submit", function(e) {
    e.preventDefault();
    let valid = true;

    // Reset errors
    emailError.textContent = "";
    passwordError.textContent = "";

    // Validation
    if (!email.value.includes("@")) {
        emailError.textContent = "Please enter a valid email.";
        valid = false;
    }
    if (password.value.length < 6) {
        passwordError.textContent = "Password must be at least 6 characters.";
        valid = false;
    }

    if (!valid) {
        errorMessage.textContent = "Please fix the errors and try again.";
        errorModal.style.display = "flex";
        return;
    }

    // 4️⃣ Firebase login
    signInWithEmailAndPassword(auth, email.value, password.value)
        .then(() => {
            successModal.style.display = "flex";
        })
        .catch((error) => {
            errorMessage.textContent = error.message;
            errorModal.style.display = "flex";
        });
});

// 5️⃣ Close modals & redirect
const redirectToIndex = () => {
    window.location.href = "index.php";
};

closeSuccess.addEventListener("click", redirectToIndex);
closeError.addEventListener("click", redirectToIndex);

// Also close modal when clicking outside
window.addEventListener("click", (e) => {
    if (e.target === successModal || e.target === errorModal) {
        redirectToIndex();
    }
});

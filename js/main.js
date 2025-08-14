// 1️⃣ Grab DOM elements first
const form = document.getElementById("registerForm");
const email = document.getElementById("email");
const password = document.getElementById("password");
const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordError");

const successModal = document.getElementById("successModal");
const closeSuccess = document.getElementById("closeSuccess");
const errorModal = document.getElementById("errorModal");
const errorMessage = document.getElementById("errorMessage");
const closeError = document.getElementById("closeError");

// 2️⃣ Firebase setup (unchanged)
import { initializeApp } from "https://www.gstatic.com/firebasejs/12.1.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/12.1.0/firebase-analytics.js";
import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/12.1.0/firebase-auth.js";

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

    // 4️⃣ Firebase sign-up
    createUserWithEmailAndPassword(auth, email.value, password.value)
        .then((userCredential) => {
            successModal.style.display = "flex";
        })
        .catch((error) => {
            errorMessage.textContent = error.message;
            errorModal.style.display = "flex";
        });
});

// 5️⃣ Close modals
closeSuccess.addEventListener("click", () => {
    successModal.style.display = "none";
});
closeError.addEventListener("click", () => {
    errorModal.style.display = "none";
});
window.addEventListener("click", (e) => {
    if (e.target === successModal) successModal.style.display = "none";
    if (e.target === errorModal) errorModal.style.display = "none";
});






const db = getDatabase();

// DOM elements
const eventTableBody = document.getElementById("eventTableBody");
const logoutBtn = document.getElementById("logoutBtn");



// Fetch events from Firebase Realtime Database
function loadEvents() {
    const eventsRef = ref(db, "bookings");
    onValue(eventsRef, (snapshot) => {
        eventTableBody.innerHTML = "";
        if (!snapshot.exists()) {
            eventTableBody.innerHTML = `<tr><td colspan="6" style="text-align:center;">No events found.</td></tr>`;
            return;
        }
        snapshot.forEach((child) => {
            const event = child.val();
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${event.type}</td>
                <td>${event.date}</td>
                <td>${event.name}</td>
                <td>${event.contact}</td>
                <td>${event.status || "Pending"}</td>
                <td>
                    <button class="action-btn approve">Approve</button>
                    <button class="action-btn reject">Reject</button>
                    <button class="action-btn delete">Delete</button>
                </td>
            `;

            // Approve
            row.querySelector(".approve").addEventListener("click", () => {
                update(ref(db, "bookings/" + child.key), { status: "Approved" })
                    .then(() => showSuccess("Event approved successfully."))
                    .catch((err) => showError(err.message));
            });

            // Reject
            row.querySelector(".reject").addEventListener("click", () => {
                update(ref(db, "bookings/" + child.key), { status: "Rejected" })
                    .then(() => showSuccess("Event rejected successfully."))
                    .catch((err) => showError(err.message));
            });

            // Delete
            row.querySelector(".delete").addEventListener("click", () => {
                remove(ref(db, "bookings/" + child.key))
                    .then(() => showSuccess("Event deleted successfully."))
                    .catch((err) => showError(err.message));
            });

            eventTableBody.appendChild(row);
        });
    });
}

// Show modals
function showSuccess(msg) {
    successMessage.textContent = msg;
    successModal.style.display = "flex";
}
function showError(msg) {
    errorMessage.textContent = msg;
    errorModal.style.display = "flex";
}

// Close modals
closeSuccess.addEventListener("click", () => {
    successModal.style.display = "none";
});
closeError.addEventListener("click", () => {
    errorModal.style.display = "none";
});

// Logout
logoutBtn.addEventListener("click", () => {
    signOut(auth).then(() => {
        window.location.href = "login.php";
    }).catch((err) => {
        showError(err.message);
    });
});

// Init
loadEvents();



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Church Event Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .logo i {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 10px;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #555;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .nav-link:hover, .nav-link.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            transform: translateX(5px);
        }

        .nav-link i {
            margin-right: 12px;
            width: 20px;
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            padding: 12px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
        }

        /* Content Sections */
        .content-section {
            display: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .content-section.active {
            display: block;
        }

        /* Events Section */
        .events-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: transform 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .event-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #667eea;
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
        }

        .event-type {
            font-weight: bold;
            color: #667eea;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .event-details {
            color: #666;
            margin-bottom: 15px;
        }

        .event-details div {
            margin-bottom: 5px;
        }

        .event-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-pending {
            background: #f39c12;
            color: white;
        }

        .status-approved {
            background: #27ae60;
            color: white;
        }

        .status-rejected {
            background: #e74c3c;
            color: white;
        }

        .event-actions {
            margin-top: 15px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-small {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            transition: opacity 0.3s ease;
        }

        .btn-small:hover {
            opacity: 0.8;
        }

        .btn-approve {
            background: #27ae60;
            color: white;
        }

        .btn-reject {
            background: #e74c3c;
            color: white;
        }

        .btn-assign {
            background: #3498db;
            color: white;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        /* Calendar */
        .calendar-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .calendar-nav button {
            background: #667eea;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .calendar-day {
            background: white;
            padding: 12px 8px;
            min-height: 100px;
            position: relative;
        }

        .calendar-day.other-month {
            background: #f8f9fa;
            color: #ccc;
        }

        .calendar-day.today {
            background: #e8f4fd;
        }

        .calendar-day-number {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .calendar-event {
            background: #667eea;
            color: white;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            margin-bottom: 2px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Staff Section */
        .staff-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .staff-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .staff-card:hover {
            transform: translateY(-5px);
        }

        .staff-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #667eea;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 24px;
        }

        .staff-name {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .staff-role {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .staff-actions {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { 
                opacity: 0;
                transform: translateY(-50px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.3s ease;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .close {
            background: #f8f9fa;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close:hover {
            background: #e9ecef;
            color: #333;
            transform: rotate(90deg);
        }

        /* Confirmation Modal Styles */
        .confirmation-modal .modal-content {
            max-width: 400px;
            text-align: center;
        }

        .confirmation-icon {
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .confirmation-icon.delete {
            color: #e74c3c;
        }

        .confirmation-icon.success {
            color: #27ae60;
        }

        .confirmation-title {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        .confirmation-message {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .confirmation-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn-confirm {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn-confirm:hover {
            background: #c0392b;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn-cancel:hover {
            background: #5a6268;
        }

        /* Form Enhancement */
        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .required::after {
            content: " *";
            color: #e74c3c;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .checkbox-group {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .checkbox-item input {
            width: auto;
            margin-right: 8px;
        }

        /* Loading and Error States */
        .loading {
            text-align: center;
            color: #666;
            padding: 40px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <i class="fas fa-church"></i>
                <h3 id="userName">Church Admin</h3>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a class="nav-link active" data-section="dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-section="events">
                        <i class="fas fa-calendar-alt"></i>
                        Events
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-section="calendar">
                        <i class="fas fa-calendar"></i>
                        Calendar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-section="staff">
                        <i class="fas fa-users"></i>
                        Staff
                    </a>
                </li>
            </ul>
            <button class="logout-btn" id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1 id="pageTitle">Dashboard</h1>
                <p id="pageDescription">Welcome to Sta Ursula Management System</p>
            </div>

            <!-- Dashboard Section -->
            <div class="content-section active" id="dashboard">
                <div class="events-grid">
                    <div class="event-card">
                        <div class="event-type">
                            <i class="fas fa-chart-bar"></i> Total Events
                        </div>
                        <div style="font-size: 2rem; font-weight: bold; color: #667eea; margin: 10px 0;">
                            <span id="totalEvents">0</span>
                        </div>
                        <div class="event-details">This month</div>
                    </div>
                    <div class="event-card">
                        <div class="event-type">
                            <i class="fas fa-clock"></i> Pending Approval
                        </div>
                        <div style="font-size: 2rem; font-weight: bold; color: #f39c12; margin: 10px 0;">
                            <span id="pendingEvents">0</span>
                        </div>
                        <div class="event-details">Awaiting your review</div>
                    </div>
                    <div class="event-card">
                        <div class="event-type">
                            <i class="fas fa-users"></i> Active Staff
                        </div>
                        <div style="font-size: 2rem; font-weight: bold; color: #27ae60; margin: 10px 0;">
                            <span id="activeStaff">0</span>
                        </div>
                        <div class="event-details">Available today</div>
                    </div>
                </div>

                <h3 style="margin-bottom: 15px;">Recent Events</h3>
                <div id="recentEventsContainer">
                    <div class="loading">Loading recent events...</div>
                </div>
            </div>

            <!-- Events Section -->
            <div class="content-section" id="events">
                <div class="events-header">
                    <h3>Event Management</h3>
                    <button class="btn-primary" onclick="openAddEventModal()">
                        <i class="fas fa-plus"></i> Add Event
                    </button>
                </div>
                <div id="eventsContainer">
                    <div class="loading">Loading events...</div>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="content-section" id="calendar">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <h3>Event Calendar</h3>
                        <div class="calendar-nav">
                            <button onclick="previousMonth()">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <span id="currentMonth">January 2025</span>
                            <button onclick="nextMonth()">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="calendar-grid" id="calendarGrid">
                        <!-- Calendar will be generated here -->
                    </div>
                </div>
            </div>

            <!-- Staff Section -->
            <div class="content-section" id="staff">
                <div class="events-header">
                    <h3>Staff Management</h3>
                    <button class="btn-primary" onclick="openAddStaffModal()">
                        <i class="fas fa-user-plus"></i> Add Staff
                    </button>
                </div>
                <div class="staff-grid" id="staffContainer">
                    <div class="loading">Loading staff...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Event Modal -->
    <div id="addEventModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New Event</h3>
                <button class="close" onclick="closeAddEventModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="addEventForm">
                <div class="form-group">
                    <label class="required">Event Type:</label>
                    <select id="eventType" required>
                        <option value="">Select Event Type</option>
                        <option value="Wedding">Wedding</option>
                        <option value="Baptism">Baptism</option>
                        <option value="Funeral">Funeral</option>
                        <option value="House Blessing">House Blessing</option>
                        <option value="Ordination">Ordination</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="required">Date:</label>
                        <input type="date" id="eventDate" required>
                    </div>
                    <div class="form-group">
                        <label class="required">Time:</label>
                        <input type="time" id="eventTime" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Duration (hours):</label>
                    <select id="eventDuration">
                        <option value="0.5">30 minutes</option>
                        <option value="1">1 hour</option>
                        <option value="1.5">1.5 hours</option>
                        <option value="2" selected>2 hours</option>
                        <option value="2.5">2.5 hours</option>
                        <option value="3">3 hours</option>
                        <option value="4">4 hours</option>
                        <option value="6">6 hours</option>
                        <option value="8">8 hours</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="required">Requested By:</label>
                    <input type="text" id="requestedBy" placeholder="Enter full name" required>
                </div>
                <div class="form-group">
                    <label>Contact Information:</label>
                    <input type="text" id="contactInfo" placeholder="Phone number or email">
                </div>
                <div class="form-group">
                    <label>Description/Notes:</label>
                    <textarea id="eventDescription" rows="3" placeholder="Additional details about the event..."></textarea>
                </div>
                <div style="text-align: right; margin-top: 25px;">
                    <button type="button" class="btn-cancel" onclick="closeAddEventModal()" style="margin-right: 10px;">Cancel</button>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-plus"></i> Add Event
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Staff Assignment Modal -->
    <div id="staffAssignmentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Assign Staff to Event</h3>
                <button class="close" onclick="closeStaffAssignmentModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="eventInfoForAssignment"></div>
            <div class="form-group">
                <label>Select Staff Members:</label>
                <div class="checkbox-group" id="staffCheckboxes">
                    <!-- Staff checkboxes will be generated here -->
                </div>
            </div>
            <div style="text-align: right; margin-top: 25px;">
                <button type="button" class="btn-cancel" onclick="closeStaffAssignmentModal()" style="margin-right: 10px;">Cancel</button>
                <button class="btn-primary" onclick="assignStaff()">
                    <i class="fas fa-user-check"></i> Assign Selected Staff
                </button>
            </div>
        </div>
    </div>

    <!-- Add Staff Modal -->
    <div id="addStaffModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New Staff Member</h3>
                <button class="close" onclick="closeAddStaffModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="addStaffForm">
                <div class="form-group">
                    <label class="required">Full Name:</label>
                    <input type="text" id="staffName" placeholder="Enter full name" required>
                </div>
                <div class="form-group">
                    <label class="required">Role/Position:</label>
                    <select id="staffRole" required>
                        <option value="">Select Role</option>
                        <option value="Parish Priest">Parish Priest</option>
                        <option value="Associate Priest">Associate Priest</option>
                        <option value="Deacon">Deacon</option>
                        <option value="Sacristan">Sacristan</option>
                        <option value="Lector">Lector</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="required">Email:</label>
                        <input type="email" id="staffEmail" placeholder="email@example.com" required>
                    </div>
                    <div class="form-group">
                        <label>Phone:</label>
                        <input type="tel" id="staffPhone" placeholder="+63 XXX XXX XXXX">
                    </div>
                </div>
                <div class="form-group">
                    <label>Notes:</label>
                    <textarea id="staffNotes" rows="2" placeholder="Additional information about the staff member..."></textarea>
                </div>
                <div style="text-align: right; margin-top: 25px;">
                    <button type="button" class="btn-cancel" onclick="closeAddStaffModal()" style="margin-right: 10px;">Cancel</button>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-user-plus"></i> Add Staff Member
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="modal">
        <div class="modal-content confirmation-modal">
            <div class="confirmation-icon delete">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="confirmation-title">Confirm Deletion</h3>
            <p class="confirmation-message" id="deleteConfirmMessage">
                Are you sure you want to delete this item? This action cannot be undone.
            </p>
            <div class="confirmation-actions">
                <button class="btn-cancel" onclick="closeDeleteConfirmModal()">Cancel</button>
                <button class="btn-confirm" id="confirmDeleteBtn">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content confirmation-modal">
            <div class="confirmation-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 class="confirmation-title">Success!</h3>
            <p class="confirmation-message" id="successMessage">
                Operation completed successfully.
            </p>
            <div class="confirmation-actions">
                <button class="btn-primary" onclick="closeSuccessModal()">OK</button>
            </div>
        </div>
    </div>

    <script type="module">
        // Import Firebase
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getAuth, signOut, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";
        import { getFirestore, collection, getDocs, addDoc, updateDoc, doc, deleteDoc, query, orderBy } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

        // Firebase Config - Using your existing config
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
        const auth = getAuth();
        const db = getFirestore(app);

        // Global variables
        let events = [];
        let staff = [];
        let currentEventForAssignment = null;
        let currentDate = new Date();
        let isInitialized = false;

        // Enhanced Auth Guard with better error handling
        onAuthStateChanged(auth, (user) => {
            console.log('Auth state changed:', user?.email || 'No user');
            if (!user) {
                // Redirect to login if no user is authenticated
                console.log('No authenticated user, redirecting...');
                window.location.href = "login.php";
            } else {
                console.log('User authenticated:', user.email);
                updateUserName(user);
                if (!isInitialized) {
                    initializeDashboard();
                    isInitialized = true;
                }
            }
        });

        // Update user name display
        function updateUserName(user) {
            const userNameElement = document.getElementById('userName');
            if (user.displayName) {
                userNameElement.textContent = user.displayName;
            } else if (user.email) {
                const emailName = user.email.split('@')[0];
                const formattedName = emailName
                    .replace(/[._]/g, ' ')
                    .split(' ')
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                    .join(' ');
                userNameElement.textContent = formattedName;
            } else {
                userNameElement.textContent = 'Admin User';
            }
        }

        // Initialize Dashboard with better error handling
        async function initializeDashboard() {
            console.log('Initializing dashboard...');
            try {
                // Show loading states
                showLoading();
                
                // Load data
                await Promise.all([loadEvents(), loadStaff()]);
                
                // Update UI
                updateDashboardStats();
                generateCalendar();
                
                // Set up event listeners
                setupEventListeners();
                
                console.log('Dashboard initialized successfully');
            } catch (error) {
                console.error('Error initializing dashboard:', error);
                showError('Failed to load dashboard data. Please try refreshing the page.');
            }
        }

        function showLoading() {
            document.getElementById('recentEventsContainer').innerHTML = '<div class="loading">Loading recent events...</div>';
            document.getElementById('eventsContainer').innerHTML = '<div class="loading">Loading events...</div>';
            document.getElementById('staffContainer').innerHTML = '<div class="loading">Loading staff...</div>';
        }

        function showError(message) {
            const errorDiv = `<div class="error">${message}</div>`;
            document.getElementById('recentEventsContainer').innerHTML = errorDiv;
            document.getElementById('eventsContainer').innerHTML = errorDiv;
            document.getElementById('staffContainer').innerHTML = errorDiv;
        }

        function setupEventListeners() {
            // Navigation
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const section = link.getAttribute('data-section');
                    switchSection(section);
                });
            });

            // Logout functionality
            document.getElementById('logoutBtn').addEventListener('click', async () => {
                try {
                    await signOut(auth);
                    window.location.href = "login.php";
                } catch (error) {
                    console.error('Logout error:', error);
                    alert('Error logging out. Please try again.');
                }
            });

            // Form submissions
            document.getElementById('addEventForm').addEventListener('submit', handleAddEvent);
            document.getElementById('addStaffForm').addEventListener('submit', handleAddStaff);

            // Close modals when clicking outside
            window.addEventListener('click', (e) => {
                if (e.target.classList.contains('modal')) {
                    e.target.style.display = 'none';
                }
            });
        }

        // Navigation
        function switchSection(sectionName) {
            // Update active nav link
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            document.querySelector(`[data-section="${sectionName}"]`).classList.add('active');

            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });

            // Show selected section
            document.getElementById(sectionName).classList.add('active');

            // Update header
            const titles = {
                dashboard: 'Dashboard',
                events: 'Event Management',
                calendar: 'Event Calendar',
                staff: 'Staff Management'
            };
            
            const descriptions = {
                dashboard: 'Overview of your church events and activities',
                events: 'Manage and organize church events',
                calendar: 'View events in calendar format',
                staff: 'Manage staff assignments and availability'
            };

            document.getElementById('pageTitle').textContent = titles[sectionName];
            document.getElementById('pageDescription').textContent = descriptions[sectionName];
        }

        // Load Events with better error handling
        async function loadEvents() {
            try {
                console.log('Loading events...');
                const q = query(collection(db, "events"), orderBy("date", "desc"));
                const querySnapshot = await getDocs(q);
                events = [];
                querySnapshot.forEach((doc) => {
                    events.push({ id: doc.id, ...doc.data() });
                });
                console.log(`Loaded ${events.length} events`);
                renderEvents();
                renderRecentEvents();
            } catch (error) {
                console.error("Error loading events:", error);
                document.getElementById('eventsContainer').innerHTML = '<div class="error">Error loading events. Please try again.</div>';
                document.getElementById('recentEventsContainer').innerHTML = '<div class="error">Error loading recent events.</div>';
            }
        }

        // Load Staff with better error handling
        async function loadStaff() {
            try {
                console.log('Loading staff...');
                const querySnapshot = await getDocs(collection(db, "staff"));
                staff = [];
                querySnapshot.forEach((doc) => {
                    staff.push({ id: doc.id, ...doc.data() });
                });
                console.log(`Loaded ${staff.length} staff members`);
                renderStaff();
            } catch (error) {
                console.error("Error loading staff:", error);
                document.getElementById('staffContainer').innerHTML = '<div class="error">Error loading staff. Please try again.</div>';
            }
        }

        // Render Events
        function renderEvents() {
            const container = document.getElementById('eventsContainer');
            if (events.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666; padding: 40px;">No events found</p>';
                return;
            }

            container.innerHTML = '<div class="events-grid">' + events.map(event => `
                <div class="event-card">
                    <div class="event-type">${event.type || 'N/A'}</div>
                    <div class="event-details">
                        <div><i class="fas fa-calendar"></i> ${event.date || 'N/A'}</div>
                        <div><i class="fas fa-clock"></i> ${event.time || 'N/A'}</div>
                        <div><i class="fas fa-user"></i> ${event.requestedBy || 'N/A'}</div>
                        ${event.description ? `<div><i class="fas fa-info-circle"></i> ${event.description}</div>` : ''}
                        ${event.assignedStaff && event.assignedStaff.length > 0 ? 
                            `<div><i class="fas fa-users"></i> Staff: ${event.assignedStaff.map(s => s.name).join(', ')}</div>` : ''}
                    </div>
                    <span class="event-status status-${(event.status || 'pending').toLowerCase()}">${event.status || 'Pending'}</span>
                    <div class="event-actions">
                        ${event.status !== 'approved' ? `<button class="btn-small btn-approve" onclick="updateEventStatus('${event.id}', 'approved')">Approve</button>` : ''}
                        ${event.status !== 'rejected' ? `<button class="btn-small btn-reject" onclick="updateEventStatus('${event.id}', 'rejected')">Reject</button>` : ''}
                        <button class="btn-small btn-assign" onclick="openStaffAssignmentModal('${event.id}')">Assign Staff</button>
                        <button class="btn-small btn-delete" onclick="deleteEvent('${event.id}')">Delete</button>
                    </div>
                </div>
            `).join('') + '</div>';
        }

        // Render Recent Events for Dashboard
        function renderRecentEvents() {
            const container = document.getElementById('recentEventsContainer');
            const recentEvents = events.slice(0, 3);
            
            if (recentEvents.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666; padding: 40px;">No recent events</p>';
                return;
            }

            container.innerHTML = '<div class="events-grid">' + recentEvents.map(event => `
                <div class="event-card">
                    <div class="event-type">${event.type || 'N/A'}</div>
                    <div class="event-details">
                        <div><i class="fas fa-calendar"></i> ${event.date || 'N/A'}</div>
                        <div><i class="fas fa-clock"></i> ${event.time || 'N/A'}</div>
                        <div><i class="fas fa-user"></i> ${event.requestedBy || 'N/A'}</div>
                    </div>
                    <span class="event-status status-${(event.status || 'pending').toLowerCase()}">${event.status || 'Pending'}</span>
                </div>
            `).join('') + '</div>';
        }

        // Render Staff
        function renderStaff() {
            const container = document.getElementById('staffContainer');
            if (staff.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #666; padding: 40px;">No staff members found</p>';
                return;
            }

            container.innerHTML = staff.map(member => `
                <div class="staff-card">
                    <div class="staff-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="staff-name">${member.name || 'N/A'}</div>
                    <div class="staff-role">${member.role || 'N/A'}</div>
                    <div class="staff-actions">
                        <button class="btn-small btn-delete" onclick="deleteStaff('${member.id}')">Delete</button>
                    </div>
                </div>
            `).join('');
        }

        // Update Dashboard Stats
        function updateDashboardStats() {
            const totalEvents = events.length;
            const pendingEvents = events.filter(e => e.status === 'pending' || !e.status).length;
            const activeStaff = staff.length;

            document.getElementById('totalEvents').textContent = totalEvents;
            document.getElementById('pendingEvents').textContent = pendingEvents;
            document.getElementById('activeStaff').textContent = activeStaff;
        }

        // Calendar Functions
        function generateCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            
            document.getElementById('currentMonth').textContent = 
                new Date(year, month).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });

            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const daysInMonth = lastDay.getDate();
            const startingDayOfWeek = firstDay.getDay();

            const calendarGrid = document.getElementById('calendarGrid');
            
            // Clear existing content
            calendarGrid.innerHTML = '';

            // Add day headers
            const dayHeaders = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            dayHeaders.forEach(day => {
                const dayHeader = document.createElement('div');
                dayHeader.className = 'calendar-day';
                dayHeader.style.background = '#667eea';
                dayHeader.style.color = 'white';
                dayHeader.style.fontWeight = 'bold';
                dayHeader.style.textAlign = 'center';
                dayHeader.style.minHeight = '40px';
                dayHeader.style.display = 'flex';
                dayHeader.style.alignItems = 'center';
                dayHeader.style.justifyContent = 'center';
                dayHeader.textContent = day;
                calendarGrid.appendChild(dayHeader);
            });

            // Add empty cells for days before the first day of the month
            for (let i = 0; i < startingDayOfWeek; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'calendar-day other-month';
                calendarGrid.appendChild(emptyDay);
            }

            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
                
                const today = new Date();
                if (year === today.getFullYear() && month === today.getMonth() && day === today.getDate()) {
                    dayElement.classList.add('today');
                }

                const dayNumber = document.createElement('div');
                dayNumber.className = 'calendar-day-number';
                dayNumber.textContent = day;
                dayElement.appendChild(dayNumber);

                // Add events for this day
                const dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const dayEvents = events.filter(event => event.date === dateString);
                
                dayEvents.forEach(event => {
                    const eventElement = document.createElement('div');
                    eventElement.className = 'calendar-event';
                    eventElement.textContent = event.type || 'Event';
                    eventElement.title = `${event.type} - ${event.time} - ${event.requestedBy}`;
                    dayElement.appendChild(eventElement);
                });

                calendarGrid.appendChild(dayElement);
            }
        }

        window.previousMonth = function() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            generateCalendar();
        };

        window.nextMonth = function() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            generateCalendar();
        };

        // Event Management Functions
        window.updateEventStatus = async function(eventId, status) {
            try {
                await updateDoc(doc(db, "events", eventId), { status });
                await loadEvents();
                updateDashboardStats();
                generateCalendar();
                console.log(`Event ${eventId} status updated to ${status}`);
            } catch (error) {
                console.error("Error updating event status:", error);
                alert("Error updating event status. Please try again.");
            }
        };

        // Delete Event Function with Modal
        window.deleteEvent = function(eventId) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;

            showDeleteConfirmModal(
                `Delete Event: ${event.type}`,
                `Are you sure you want to delete "${event.type}" scheduled for ${event.date}? This action cannot be undone.`,
                async () => {
                    try {
                        await deleteDoc(doc(db, "events", eventId));
                        await loadEvents();
                        updateDashboardStats();
                        generateCalendar();
                        console.log(`Event ${eventId} deleted successfully`);
                        showSuccessModal('Event deleted successfully!');
                    } catch (error) {
                        console.error("Error deleting event:", error);
                        alert("Error deleting event. Please try again.");
                    }
                }
            );
        };

        // Delete Staff Function with Modal
        window.deleteStaff = function(staffId) {
            const staffMember = staff.find(s => s.id === staffId);
            if (!staffMember) return;

            showDeleteConfirmModal(
                `Remove Staff Member: ${staffMember.name}`,
                `Are you sure you want to remove "${staffMember.name}" (${staffMember.role}) from the staff list? This action cannot be undone.`,
                async () => {
                    try {
                        await deleteDoc(doc(db, "staff", staffId));
                        await loadStaff();
                        updateDashboardStats();
                        console.log(`Staff member ${staffId} deleted successfully`);
                        showSuccessModal('Staff member removed successfully!');
                    } catch (error) {
                        console.error("Error deleting staff member:", error);
                        alert("Error removing staff member. Please try again.");
                    }
                }
            );
        };

        // Show Delete Confirmation Modal
        function showDeleteConfirmModal(title, message, onConfirm) {
            document.getElementById('deleteConfirmMessage').innerHTML = message;
            document.getElementById('confirmDeleteBtn').onclick = () => {
                closeDeleteConfirmModal();
                onConfirm();
            };
            document.getElementById('deleteConfirmModal').style.display = 'block';
        }

        window.closeDeleteConfirmModal = function() {
            document.getElementById('deleteConfirmModal').style.display = 'none';
        };

        // Show Success Modal
        function showSuccessModal(message) {
            document.getElementById('successMessage').textContent = message;
            document.getElementById('successModal').style.display = 'block';
            
            // Auto close after 2 seconds
            setTimeout(() => {
                closeSuccessModal();
            }, 2000);
        }

        window.closeSuccessModal = function() {
            document.getElementById('successModal').style.display = 'none';
        };

        // Modal Functions
        window.openAddEventModal = function() {
            document.getElementById('addEventModal').style.display = 'block';
        };

        window.closeAddEventModal = function() {
            document.getElementById('addEventModal').style.display = 'none';
            document.getElementById('addEventForm').reset();
        };

        window.openStaffAssignmentModal = function(eventId) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;

            currentEventForAssignment = eventId;
            
            // Show event info
            document.getElementById('eventInfoForAssignment').innerHTML = `
                <div class="event-card" style="margin-bottom: 20px;">
                    <div class="event-type">${event.type}</div>
                    <div class="event-details">
                        <div><i class="fas fa-calendar"></i> ${event.date}</div>
                        <div><i class="fas fa-clock"></i> ${event.time}</div>
                    </div>
                </div>
            `;

            // Generate staff checkboxes
            const staffCheckboxes = document.getElementById('staffCheckboxes');
            if (staff.length === 0) {
                staffCheckboxes.innerHTML = '<p>No staff members available. Please add staff members first.</p>';
            } else {
                staffCheckboxes.innerHTML = staff.map(member => `
                    <div class="checkbox-item">
                        <input type="checkbox" id="staff_${member.id}" value="${member.id}" 
                               ${event.assignedStaff && event.assignedStaff.some(s => s.id === member.id) ? 'checked' : ''}>
                        <label for="staff_${member.id}">${member.name} - ${member.role}</label>
                    </div>
                `).join('');
            }

            document.getElementById('staffAssignmentModal').style.display = 'block';
        };

        window.closeStaffAssignmentModal = function() {
            document.getElementById('staffAssignmentModal').style.display = 'none';
            currentEventForAssignment = null;
        };

        window.assignStaff = async function() {
            if (!currentEventForAssignment) return;

            const selectedStaff = [];
            document.querySelectorAll('#staffCheckboxes input:checked').forEach(checkbox => {
                const staffId = checkbox.value;
                const staffMember = staff.find(s => s.id === staffId);
                if (staffMember) {
                    selectedStaff.push({
                        id: staffId,
                        name: staffMember.name,
                        role: staffMember.role
                    });
                }
            });

            try {
                await updateDoc(doc(db, "events", currentEventForAssignment), {
                    assignedStaff: selectedStaff
                });
                alert(`Successfully assigned ${selectedStaff.length} staff members to the event`);
                closeStaffAssignmentModal();
                await loadEvents();
            } catch (error) {
                console.error("Error assigning staff:", error);
                alert("Error assigning staff to event. Please try again.");
            }
        };

        window.openAddStaffModal = function() {
            document.getElementById('addStaffModal').style.display = 'block';
        };

        window.closeAddStaffModal = function() {
            document.getElementById('addStaffModal').style.display = 'none';
            document.getElementById('addStaffForm').reset();
        };

        // Form Handlers with Enhanced Data
        async function handleAddEvent(e) {
            e.preventDefault();
            
            const eventData = {
                type: document.getElementById('eventType').value,
                date: document.getElementById('eventDate').value,
                time: document.getElementById('eventTime').value,
                duration: parseFloat(document.getElementById('eventDuration').value),
                requestedBy: document.getElementById('requestedBy').value,
                contactInfo: document.getElementById('contactInfo').value,
                description: document.getElementById('eventDescription').value,
                status: 'pending',
                createdAt: new Date().toISOString(),
                assignedStaff: []
            };

            try {
                console.log('Adding event:', eventData);
                await addDoc(collection(db, "events"), eventData);
                closeAddEventModal();
                await loadEvents();
                updateDashboardStats();
                generateCalendar();
                console.log('Event added and UI updated');
                showSuccessModal('Event added successfully!');
            } catch (error) {
                console.error("Error adding event:", error);
                alert("Error adding event. Please check your connection and try again.");
            }
        }

        async function handleAddStaff(e) {
            e.preventDefault();
            
            const staffData = {
                name: document.getElementById('staffName').value,
                role: document.getElementById('staffRole').value,
                email: document.getElementById('staffEmail').value,
                phone: document.getElementById('staffPhone').value,
                notes: document.getElementById('staffNotes').value,
                createdAt: new Date().toISOString()
            };

            try {
                console.log('Adding staff:', staffData);
                await addDoc(collection(db, "staff"), staffData);
                closeAddStaffModal();
                await loadStaff();
                updateDashboardStats();
                console.log('Staff member added and UI updated');
                showSuccessModal('Staff member added successfully!');
            } catch (error) {
                console.error("Error adding staff:", error);
                alert("Error adding staff member. Please check your connection and try again.");
            }
        }

        // Error handling for Firebase initialization
        window.addEventListener('load', () => {
            console.log('Page loaded, waiting for auth state...');
        });

        // Handle offline/online status
        window.addEventListener('online', () => {
            console.log('Back online');
            if (isInitialized) {
                initializeDashboard();
            }
        });

        window.addEventListener('offline', () => {
            console.log('Gone offline');
            showError('You are currently offline. Some features may not work properly.');
        });
    </script>
</body>
</html>
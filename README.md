# Flesh & Vine

## Project Overview
The Flesh & Vine website is a platform designed to connect clients with a world-renowned chef, providing a unique at home culinary experience. 

## Features

### Multi-Role System
#### Clients (Users):
- Discover exclusive menus crafted by the chef.
- Register and log in to the platform.
- Book a culinary experience at home (selecting date, time, and number of guests).
- Manage reservations:
  - View upcoming bookings.
  - Cancel existing reservations.
  - Review booking history.

#### Chef:
- Log in to access the admin dashboard.
- Manage reservations:
  - Approve or decline reservation requests.
  - View statistics:
    - Pending requests.
    - Approved reservations for today and tomorrow.
    - Details of the next client and their booking.
    - Total registered clients.
- Add and manage menus and plates.
<!-- - View detailed reports and generate printable PDFs. -->

### Key Functionalities
1. **Registration and Login**
   - Role-based redirection after authentication (client or chef).
2. **Client Dashboard**
   - Interactive menu exploration and reservation creation.
   - Seamless booking management (modify, cancel, or view bookings).
3. **Chef Dashboard**
   - Reservation management and approval process.
   - Dynamic form for adding multiple dishes to menus.

### Design
<!-- - **Responsive Design**: Optimized for mobile, tablet, and desktop. -->
- **Modern Aesthetic**: A sleek and elegant design to reflect luxury.
- **User-Centric UX/UI**: Intuitive navigation and interaction for both clients and chefs.

### JavaScript Features
1. **Form Validation**
   - Regex-based validation for fields like email, phone number, and password.
2. **Dynamic Modals**
   - Real-time updates and confirmations without page reload.
3. **SweetAlerts**
   - Enhanced visual feedback for actions such as booking confirmations and errors.

### Data Security
- **Password Hashing**: Secure storage of user credentials.
- **XSS Protection**: Input sanitization to prevent malicious scripts.
- **SQL Injection Prevention**: Use of prepared statements for database queries.
- **CSRF Protection**: Tokens to secure sensitive actions like bookings and profile changes.

<!--### Bonus Features
1. **Printable Reports**: Generate PDFs for reservations and statistics.-->
<!--2. **Email Notifications**: Automatic emails for password resets, booking confirmations, and urgent alerts. -->
<!--3. **Dish Archiving**: Mark dishes as unavailable when out of stock and reactivate them later.-->
<!--4. **Custom 404 Page**: An elegant error page with navigation options.-->

## Getting Started
### Prerequisites
- PHP and a web server (e.g., Apache or Nginx).
- MySQL database.

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/A-007481D/Flesh-Vine.git
   ```
2. Set up the database using the provided SQL scripts.
3. Start the server and access the website at `http://localhost`.

## Technology Stack
- **Frontend**: HTML, CSS, JavaScript.
- **Backend**: PHP.
- **Database**: MySQL.
- **Security**: Password hashing, prepared statements, and CSRF protection.

<!-- ## Contributing
1. Fork the repository.
2. Create a new branch for your feature: `git checkout -b feature-name`.
3. Commit your changes: `git commit -m 'Add feature-name'`.
4. Push to the branch: `git push origin feature-name`.
5. Create a pull request.

## License
This project is licensed under the MIT License - see the LICENSE file for details.

---

For any queries or support, please contact [support@example.com](mailto:support@example.com). -->


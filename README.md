# GovDrive: Modern Document Request Portal

### Project Description
GovDrive is a high-fidelity government service application built with Laravel 11. It allows citizens to securely request official documents (Birth Certificates, Permits, etc.) and provides government officials with a streamlined dashboard to audit, approve, or reject submissions in real-time.

### Implemented Features (Teacher Guidelines)
1. **CRUD Operations:** Full lifecycle for service requests (Create, Read, Update, Delete).
2. **Authentication:** Secure Login/Register system using Laravel Breeze.
3. **Middleware:** Route protection ensures only logged-in users access the portal.
4. **Authorization:** 
   - **Policies:** Restricts citizens to only view/edit their own data.
   - **Gates:** Defines "admin-only" access for government officials.
5. **Eloquent Relationships:** One-to-Many relationship between `User` and `ServiceRequest`.
6. **2026 UI/UX:** Modern SaaS-style interface with Dark Mode support and Alpine.js feedback.

### Credentials for Testing (Database Seeded)
- **Admin:** admin@gov.ph | password123
- **Citizen:** juan@citizen.com | password123
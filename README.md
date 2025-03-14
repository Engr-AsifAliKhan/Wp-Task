# WordPress Task Plugin

## Overview
This WordPress plugin demonstrates the implementation of various functionalities, including:
- Registering a custom post type **"Projects"** and taxonomy **"Project Type"**.
- Redirecting users whose IP starts with `77.29`.
- Creating an AJAX endpoint to fetch the latest projects.
- Fetching and displaying a random coffee image using an external API.
- Displaying Kanye West quotes fetched from an API.

## Installation

### 1. Clone the Repository
Using HTTPS:
```bash
git clone https://github.com/Engr-AsifAliKhan/Wp-Task.git
```
Or using SSH:
```bash
git clone git@github.com:Engr-AsifAliKhan/Wp-Task.git
```

### 2. Upload to WordPress
- Copy the `wp-task` folder into the `wp-content/plugins/` directory of your WordPress installation.

### 3. Activate the Plugin
- Go to **WordPress Admin Panel** > **Plugins**.
- Find **WP Task Plugin** and click **Activate**.

## Features & Usage

### 1. Redirect Users Based on IP
- Users whose IP starts with `77.29` will be redirected to another page in this code it will redirect to Google.

### 2. Custom Post Type: "Projects"
- The plugin registers a **"Projects"** post type with a **"Project Type"** taxonomy.
- You can add projects from **Admin Panel > Projects**.

### 3. AJAX Fetch for Architecture Projects
- On the **Projects** tab, click **"Fetch Architecture Projects"** to fetch projects using AJAX.
- Open the browser console (`F12` > Console) to debug AJAX requests.

### 4. Fetch Random Coffee Image
- Displays a random coffee image using the API.

### 5. Kanye West Quotes
- Displays five quotes fetched from the Kanye REST API.

## AJAX Fetch Testing
To manually test the AJAX fetch function, open the console and run:
```javascript
fetch('https://yourwebsite.com/wp-admin/admin-ajax.php?action=fetch_architecture_projects')
  .then(response => response.json())
  .then(data => console.log(data));
```
Replace `yourwebsite.com` with your actual WordPress site URL.

## License
This project is open-source and available under the MIT License.

---
Developed by Asif Ali Khan


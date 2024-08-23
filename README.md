# App Builder

## Overview

App Builder is a web application that enables users to create customized Flutter apps without coding knowledge. Users can input an app name, upload an icon, and the system generates a Flutter project with basic configurations. Built with HTML, CSS, JavaScript, PHP, and Flutter, this project automates the app build process, including Gradle version management and APK generation.

## Features

- **User Authentication**: Secure login system for managing user sessions
- **App Creation**: Simple form for inputting app name and uploading an icon
- **Automatic Flutter Project Setup**: Generates a Flutter project with provided configurations
- **Gradle Management**: Updates Gradle version to 8.3 for compatibility
- **APK Build**: Compiles the Flutter project into a release APK
- **Download APK**: Provides a download link for the generated APK

## Prerequisites

- PHP: Installed and configured on your server
- Flutter: SDK installed and available in the system's PATH
- Gradle: Required by Flutter for building the project

## Installation

1. Clone the repository:
   ```bash
   https://github.com/kabangast/appbuilder.git
   cd app-builder
   ```

2. Setup PHP Environment:
   - Install XAMPP or another PHP server environment
   - Place the project in the web directory (e.g., `htdocs` for XAMPP)

3. Configure Flutter:
   - Ensure Flutter is installed and set up correctly
   - Verify Flutter's environment variables are properly set

4. Setup the Project:
   - Create necessary directories for user apps and build outputs
   - Update `build_app.php` to ensure correct file paths and permissions

## Usage

1. Start the PHP Server:
   ```bash
   php -S localhost:8000 -t public
   ```

2. Access the Application:
   Open your web browser and go to `http://localhost:8000`

3. Create an App:
   - Log in to the application
   - Use the form to enter the app name and upload an icon
   - Submit the form to create the app and build the APK

4. Download the APK:
   - Once the build is complete, download the APK from the provided link

## Directory Structure

```
app-builder/
│
├── public/              # Publicly accessible files
│   ├── index.php        # Login and main page
│   └── builder.php      # App creation interface
│
├── functions/           # PHP scripts
│   ├── build_app.php    # Builds the Flutter app
│   ├── download_apk.php # Handles APK downloads
│   └── logout.php       # Logs out the user
│
├── user_apps/           # Directory for user-specific Flutter projects
├── build_apks/          # Directory for storing built APKs
└── logs/                # Directory for build logs
```

## Troubleshooting

- **Gradle Build Issues**: Ensure the correct Gradle version is specified in `gradle-wrapper.properties`
- **File Permissions**: Check file and directory permissions to ensure PHP scripts can read/write necessary files
- **Flutter Issues**: Verify Flutter SDK is properly installed and accessible

## Contributing

1. Fork the repository
2. Create a new branch (`git checkout -b feature-branch`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature-branch`)
5. Create a new Pull Request

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any questions or issues, please contact [your-email@example.com](mailto:your-email@example.com).

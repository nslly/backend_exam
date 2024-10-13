<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Installation

Follow these steps to run the Laravel backend:

1. **Clone the Repository**:

    My Back end repository
   
   git clone https://github.com/nslly/backend_exam.git
   

   cd backend_exam


2. Install Dependencies: Make sure you have Composer installed. Run:

   composer install

3. Set Up Environment File: Copy the .env.example file to .env and configure your environment variables:
   
   cp .env.example .env

4. Generate Application Key: Run the following command to generate the application key:

   php artisan key:generate

5. Migrate the Database: Run the migrations to set up your database and seed the data:
   
   php artisan migrate --seed

6. Install Node Dependencies:

npm install

7. Create Symbolic Link for Storage:

php artisan storage:link

8. Serve the Application:

 php artisan serve


After you copy the BACK END, you can set up the FRONT END Vue project as follows:


1. **Clone the Repository**:
   
   git clone https://github.com/nslly/frontend_exam.git

   cd frontend_exam

2. Install Dependencies: Make sure you have Node.js and npm installed. Run:

npm install

3. Run the Development Server: Start the development server with:

npm run dev




  







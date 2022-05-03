# Cybertek
### A full-stack PHP web application. 
This application was made for an university assignment, but as per usual I had to go above and beyond with the implementation, so I was pretty happy with the results. The platfor is an online shop for high-tech equipement (hence the name). Won't lie that I didn't get the design inspiration from Cyberpunk 2077, which was about to release soon after I submited this work.

![Front page](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/index.PNG?raw=true)

The application features working login and registration, with custom field valiation and two account types: 
  1. Customer - can register normally through the registration portal.
  2. Admin - only added by another admin through the dashboard built in the app or hardoced in the database.

![Login page](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/login.PNG?raw=true)

![Registration page](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/reg.PNG?raw=true)

![Form validation](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/valid.PNG?raw=true)

The application relies on a MySQL database connection, to store customer, admin, product and shopping data. The login passwords are hashed before being stored.

![Store dashboard](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/in1.PNG?raw=true)
![Store dashboard](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/in2.PNG?raw=true)

![Customer profile](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/screencapture-localhost-Cybertek-main-PAGES-customer-profile-php-2022-05-03-19_51_38.png?raw=true)

![Shopping basket](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/screencapture-localhost-Cybertek-main-PAGES-shopping-cart-php-2022-05-03-19_52_50.png?raw=true)

The application features a fully functional e-shop implementation (All the design efforts went into the front page, for the rest I focused mostly on functionality ~ I'm only human). Each individual shopping basket of a customer is saved in the database to allow the user to pick up where they left off. This also means that all basket items are synced, so if meanwhile an item is gone from stock while in someones basket, then that item is dinamically marked as unavailable (tough luck buddy, shoul've been faster, those Macintoshes sell like hot bread). Also each customer, upon registration, has a minimum of data added to their digital profile, meaning that they will need to complete some details before they can make a purchase. Prompts appear on top of the screen to notify of this and only dissapear when the required actions are completed. 

There is an admin and customer side respectively to the app, depending on login. Customers peruse and shop (as expected) and admins manage customer accounts, admin accounts and stock/displayed items.

![Admin dashboard](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/admin_dashboard.png?raw=true)

![Store stock](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/add_product.png?raw=true)

![Update products](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/screencapture-localhost-Cybertek-main-PAGES-update-php-2022-05-03-19_58_25.png?raw=true)

![Accounts management](https://github.com/MihaiNastase/Cybertek/blob/main/Screenshots/screencapture-localhost-Cybertek-main-PAGES-admin-php-2022-05-03-19_59_10.png?raw=true)

Overall, I wanted to give this project the feel (if not the look) of a real e-shop, whith all the functionality that I would like to see in an actually real platform of the sorts.

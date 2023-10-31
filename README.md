# Assignment
## _v1.2.0_

We’d like you to create a small e-commerce application for us to get some insights in your skillset. Focus on the PHP and especially the separation of concern, the UI is optional. Please dont spend more than two hours on this assignment.

# Installation
- `git clone git@github.com:Orderchamp/assignment.git`
- `composer install`
- `php artisan migrate:fresh --seed`
- `php artisan queue:work`
- `php artisan serve` ` recommended to use a wamp or xampp, otherwise you need 2 terminals(one to serve , one to queue work)`

# Description
Our users should be able to add products that are in stock to their shopping cart. During checkout, our visitors should be able to become users and our users should be able to review their previously stored information (name, address, contact details).

Fifteen minutes after checkout, a user should receive a discount code of € 5,- for future purchases. If a user chooses to use a discount code, you should keep track of what discount code was applied and what amount was subtracted from the checkout.

# I provided a UI because I was not used to work with e-commerce
- `Firstly you need to make a checkout to be registed`
- `Then use Already a user and make more checkouts`
- `Visit from the navbar as a registered user your discount codes and your checkout history`
- `You can change user from logout or make with different data on user details`
- `Login if do not want to make another checkout`

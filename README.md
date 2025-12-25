Project Setup & Execution Steps
Create Database
Create a database with the name:
product_cruid

Run Migrations
Execute the following command to create all required tables:
php artisan migrate

Run the Laravel development server:
php artisan serve

Open Project in Browser
http://127.0.0.1:8000/product

Check the Task
After opening the URL, you will be able to view and test the task directly in the browser.

Product CRUD

All Product CRUD logic is handled inside:
ProductController

All Rule CRUD logic is handled inside:
RuleController

Rule Entry
A single rule record is stored in the rules table`.
Rule Conditions

Multiple conditions related to the rule are stored in the rule_conditions table`.

Each condition is linked to the main rule using a foreign key.
One Rule → stored in rules table

Multiple Conditions → stored in rule_conditions table

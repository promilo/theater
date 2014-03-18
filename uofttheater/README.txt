CSC309H1F 2013 Assignment 2 - U of T Cinema
By Shaun Kho (#998344796) and Milind Shah (#998907982)


Brief Explanation of How it All Works:

To start, run the project, then navigate to http://localhost:31120/uofttheater/admin.php to populate the database as an administrator. Then, go to http://localhost:31120/uofttheater/index.php to buy tickets as a user. 

The first screen allows the user to select the date and movie or venue, with buttons to list relevant showtimes.

The second screen displays all the showtimes with the selected date and movie or venue and a link to select a seat for each showtime.

The third screen displays the seats as boxes with available seats colored white, unavailable seats colored yellow, and the user selected seat colored green. A link to go to the next page is on the bottom.

The fourth screen displays forms for the user to input their credit card information. If input is invalid upon submission, the screen will display relevant error messages besides their respective fields. Otherwise, submitting will go to the next screen.

The fifth screen displays a summary of the ticket information and a link for the user to finalize the transaction, which adds the ticket to the database.

The sixth screen displays a receipt of the ticket and a button for the user to print the receipt.

After a ticket has been purchased, the seat for that showtime will be unavailable and appear yellow in the seat selection screen for that showtime.

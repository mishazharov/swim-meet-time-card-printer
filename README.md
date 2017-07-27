# README #
This website should run on a lamp server. It requires Php, MySQL and Apache (recommended).
In order to get this website running you must first change the constants in /includes/dp_connect.php so that the website can connect to the MySQL server. You must also set up the database. A create statement is located in the top level of the repository (swim.sql). Depending on where the website is installed you may also need to change the favicon. This can be done with the help of [realfavicongenerator.net](realfavicongenerator.net).

Known bugs:

Will not work in Safari (iPhone or computer based)
In order to use a gmail account to send emails, you have to enable 'less secure apps' in google settings
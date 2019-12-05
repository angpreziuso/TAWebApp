# JMU Computer Science TA Hours

This web application implements the current Teacher’s Assistant service ran by James Madison University.  It is a system for helping students that involves asking students to place their names, classes, and problems on a whiteboard to be entered into a queue to be helped.

### Building the project
1. Clone the git repository, naming it `clef`,  to the filesystem that hosts the webpages XAMPP (LAMP,  WAMP, etc.).
2. After the code has been pulled into your XAMPP (LAMP,  WAMP, etc.) environment, start MySQL Database and Apache Server.  
3. In any text editor of your choice, open `clef/sql/clef_ddl.sql`, and select and copy all of the text in the document. 
4. Open phpMyAdmin and navigate to the SQL tab.
5. Paste the contents of `clef/sql/clef_ddl.sql` into the SQL environment in phpMyAdmin. Hit Go. You should see a number of green rows that show the successful building of the database and seeding of some starter data. 
6. Open another browser tab. Navigate to `localhost/clef/api/data/seedDatabase.php`. This step seeds the database with user data, and must be done this way to salt and hash their password correctly. 
7. Finally, repeat steps 3, 4, and 5 using the pasted contents of `clef/sql/seed_schedule.sql`
8. At this point the system should be ready to use

## Roles

Students will be able to log into their course that they have come for help with and see a forum page, similar to Piazza where students will be able to post anonymous questions that can be answered by the TA or another student. Students will also be able to add themselves to a queue for one on one time with a TA. 
TA’s will be able to see and respond to the forum posts written by the students in the system. TA’s will also be able to view the queue of students waiting to be helped. TA’s will be able to edit their hours if need be and request shift changes.
Administrators will create, edit, and administer a schedule to the website. The schedule will be based on the inputs given by the TA’s. An administrator is the only person that can confirm and commit schedule changes between TA’s. 
Professors that is in the works.

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Authors

* [Josh Ehrlich](https://github.com/joshehrlich24/)
* [Nathan Moore](https://github.com/nathan-moore-97/)
* [Brandon Parr](https://github.com/parrbt/)
* [Angela Preziuso](https://github.com/angpreziuso/)

## License

LALALA

## Acknowledgments
* https://www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_start_page&stacked=h
* https://www.w3schools.com/howto/howto_css_login_form.asp
* https://www.w3schools.com/howto/howto_css_signup_form.asp
* https://w3.cs.jmu.edu/lam2mo/cs432_2019_08/calendar.html
* https://www.w3schools.com/howto/howto_js_todolist.asp


* Inspiration
* etc




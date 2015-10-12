VariArt.org
===========

[![VariArt.org](http://variart.org/img/logoVA_2.png)](http://variart.org)

The internet gallery based on CakePHP and Bootstrap, both licensed under MIT license.
VariArt.org is also licensed under MIT license - please read LICENSE.md file.

VariArt.org is complete internet gallery as a web/social media portal with functionality like:

1. file upload
2. news
3. comments
4. forum
5. moderator’s panel
6. private messages


Requirements
------------
All you need is to meet CakePHP requirements that you can find at [CakePHP 2.X website](http://book.cakephp.org/2.0/en/installation.html).
Please note that VariArt.org uses only MySQL database.


Installation
------------
The procedure seems to be complicated but don’t give up :) - it is easy, very easy. It just look very seriously.

1. Download and copy VA_app folder to your web server to your desired location.
2. Create MySQL database (if you don’t have one) and import DB.sql file.
3. Provide your database details in VA_app/app/Config/database.php
4. Configure cron jobs:

4.1. cron_DG.php file should run once everyday between 1 and 2 am
4.2. cron_PT.php file should run once every Monday between 1 and 2 am
5. Configure your domain to point to VA_app/app/webroot
6. Chmod 777 folders:

1. app/tmp
2. app/webroot/img/avatars
3. app/webroot/img/dg
4. app/webroot/img/news
5. app/webroot/img/photos
6. app/webroot/img/works

7. Add some categories to va_categories table in MySQL database
8. Change mail settings in app/Controller/UsersController.php - line: 269
9. Make some changes in design, menu etc. - the sky is the limit


Contributing
------------
If you are interested to develop this project, you are more than welcome. Just write to us [code.variart.org](http://code.variart.org).


Support, Contact & Web
----------------------
Everything you can find at [code.variart.org](http://code.variart.org).
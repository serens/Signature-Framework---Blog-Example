Signature Framework: Blog-Example
==================================

Simple blog implementation based on the Signature Framework. This Signature module is supposed to show you the basic functionality of the Signature MVC framework. You will see how to set up routes for article listing and detail views, handling of active record models and using the template system.

Requirements
------------

You need a running [Signature Framework](https://github.com/serens/Signature-Framework) environment. Additionally, you need one MySQL database to store the articles and comments.

Installation
------------

1. Clone `https://github.com/serens/Signature-Framework---Blog-Example` into the `modules` directory of your Signature environment.
2. Delete `modulelist.php` residing in Signature's `cache`-directory to activate the new module.
3. Import `blog_example.sql` from the root-directory of the Blog module to set up the database structure. After importing you will have two tables with some demo data.
4. Be sure to have a database connection configured in your Application module. As an alternative, you can use the Blog modules `init()`-method to set the database connection.
5. If you have configured your Signature environment as described in [README.md](https://github.com/serens/Signature-Framework/blob/master/README.md) you can open your browser and go to url `signature.local/articles`

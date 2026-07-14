Title: How to install SweetCron on local server - EasyPHP

----

Date: 2008-09-21

----

Text: 

As I've just installed and themed my very own <a href="http://lifestream.carbongraffiti.com">LifeStream </a>courtesy of <a href="http://www.sweetcron.com">SweetCron</a>, I had some of the expected 'issues' installing it on my own local server, running EasyPHP. As much for myself to not forget next time, here's the boiled-down version of how to install SweetCron on your local EasyPHP server.

<ul>
<li class="content">1.    Download <a href="http://Sweetcron.com">Sweetcron </a>to your www folder. Leave named as 'sweetcron' even if you intend to change this on your live server</li>
<li class="content">2.    Edit <code>config.php</code> base URL to http://localhost/sweetcron/</li>
<li class="content">3.    Edit <code>config.php</code> uri_protocol (a little down the page) to "AUTO"</li>
<li class="content">4.    Modify your <code>.htaccess</code> file to include the following (if you can't view your .htaccess file on your pc, <a href="http://www.bleepingcomputer.com/tutorials/tutorial62.html">visit this page</a>)

<pre>
<code>Options +FollowSymLinks
RewriteEngine On
RewriteBase /sweetcron/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?/$1 [L]</code>
</pre>

</li>
<li class="content">5.    Edit the <code>database.php</code> file, adding your new database name, username, and password.  Leave/edit the hostname to [localhost]</li>
<li class="content">6.    Add the database entry to your <a href="http://easyphp.org">EasyPHP</a> admin, as you would with any <a href="http://wordpress.org">Wordpress </a>installation (if you don’t know how, <a href="http://www.johntp.com/2006/06/03/how-to-setup-wordpress-in-easyphp/">follow these great instructions</a>)  <a href="http://groups.google.com/group/sweetcron/browse_thread/thread/c580771a165afdfd/5c515d11e226877e?lnk=gst&amp;q=local#5c515d11e226877e">For more info, visit this thread</a></li>
<li class="content">7.    Voila! You’re up and running; just follow the next steps, name your sweetcron, add feeds and you’re good to go.</li>
</ul>

----

Tags: easyphp,sweetcron,lifestream

----

Categories: coding,General,lifestream

----

Badge: post

----

Feeddate: 2008-09-21

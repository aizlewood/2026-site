Title: Creating iPhone-ready sites using CSS media queries

----

Date: 2010-07-26

----

Text: 

Using** A List Apart's** article on **Responsive Web Design** (by Ethan Marcotte) as inspiration, this site now uses CSS media queries to determine a visitor's screen resolution and serve up an appropriate version should the viewer be visiting from an iPhone.   If you have an iPhone next to you, give it a try. 

I find myself visiting an increasing number of sites through my iPhone, and have noticed I tend to visit a large number of links from Twitter, email, RSS apps and similar, make a mental note of them, and re-read them from my laptop once I'm back in the office.  In fact, I'm getting increasingly frustrated when I'm on 3G and forced to download an entire site's output, from ad farms to images.  So, to that end, I've optimised this site, sans fat, for quick and easy readability.  

The best part? The entire experience is done through a few new meta tags and an iPhone-only stylesheet.  No markup was harmed in the making of this (mobile) version.

<h3>A few points</h3>
<img src="http://www.carbongraffiti.com/wp-content/uploads/2010/10/iPhone-Simulator.gif" alt="CarbonGraffiti iPhone version" title="iPhone Simulator" />
<ul>
	<li>Knowing that mobile users won't take actions normally reserved for desktop browsing, I removed the contact page (and large contact form) from the mobile version.  Should a visitor want to contact me, they can do so using the relevant contact details and a click-to-call mobile number on the footer of each page.  </li>
	<li>Through CSS, I was able to increase the size of buttons throughout the mobile version, as well as remove the need for a hover state.  We all know fingers are much more cumbersome than a mouse pointer, and the mobile optimisation acts accordingly.</li>
	<li>Using %'s for widths vs pixels allows a fluid setup when a user rotates from portrait to landscape orientation. </li>
</ul>

<p><strong><span>Update </span> October 2010 - Let's get responsive!</strong></p>
Having become somewhat obsessed with responsive design recently (and applying it to client sites, for example <a <a href="http://lcpeurope.eu">http://lcpeurope.eu</a>), this site is now set on a fully-flexible layout, powered by media queries and %'s, not pixel widths.  That means the site will expand and stretch to use all available screen real estate, and not remain locked into what now feels like a cramped and confined 960px grid layout.  Unfortunately, this does not apply to IE8 and lower.  Sorry.

<p><strong>Further Reading</strong></p>
<ul>
	<li><a href="http://www.alistapart.com/articles/responsive-web-design/">Responsive Web Design - A List Apart</a></li>
	<li><a href="http://www.engageinteractive.co.uk/blog/2008/06/19/tutorial-building-a-website-for-the-iphone/">http://www.engageinteractive.co.uk</a></li>
	<li><a href="http://building-iphone-apps.labs.oreilly.com/">O'Reilly's Building iphone web apps</a></li>
</ul>

----

Tags: Mobile,web design,design,ux,responsive

----

Categories: Mobile,web design

----

Badge: post

----

Feeddate: 2010-07-26

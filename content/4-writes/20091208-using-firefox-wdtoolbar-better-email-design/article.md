Title: Using the Firefox Web Developer toolbar for better email design

----

Date: 2009-12-08

----

Text: 

When designing and coding email designs, more often than not you're forced into using your browser to render the HTML code you're working on, and have to wait until you're ready to test across multiple inboxes to find the per-client issues (looking at you, Hotmail, Gmail and Outlook 2007).  Working towards that point is probably the most important in the development phase, as the better you create your base file, the less likely it is you'll have to tweak and hack to accommodate those pesky email clients.


A great way to help in the pre-inbox development of email campaigns is Firefox's web developer toolbar add-on.  Normally reserved for developing, debugging and QA'ing websites only, the toolbar can double as a quick but effective QA tester for some of the most important (and easy to fix) email issues.

<img src="http://www.carbongraffiti.com/wp-content/uploads/2009/12/wdexamples.png" alt="wdexamples" title="wdexamples" />

Here's a list of some great commands in the WD toolbar that I've found make my development process easier, which of course keep me happier in the long run (and prevent me from pulling my hair out - I reserve that for IE6 on the web side of things).

<h3>CSS</h3>
<strong>CSS </strong>> <em>Disable all styles</em>
Almost an inevitability, there are some email clients out there (ie Lotus notes) that seem to live simply to mangle your beautiful email designs, namely through poor support for the CSS.  Whether or not you use inline styles (you should), this command is great to view the 'worst case scenario' of your entire message being viewed without CSS.   Not pretty, but you should always strive to maintain a well-structured campaign with and without CSS support.

<h3>Images</h3>
<strong>Images </strong>> <em>Display alt attributes</em>
Self-explanatory; great for ensuring you have the right alt tags on the right images and gives you easy-to-scan highlights to ensure everything's in order.

<strong>Images </strong>> <em>Find broken images</em>
Again self-explanatory, but always worth a check (especially as Firefox doesn't show the ugly red 'x' as IE does - sometimes a good thing!

<strong>Images </strong>> <em>Hide images</em>
Great for a quick and simple check of how the campaign's message is affected if images are turned 'off'. By referring to this early, you can ensure your campaign's style, layout and message aren't too badly affected by images off by default.

<strong>Images </strong>> <em>Replace images with Alt attributes</em>
Probably the most important - this is the closest you'll get, outside of inbox-testing, to see how your email will look with images turned off.  This is when the Alt tags are displayed to the recipient.

<h3>Information</h3>
<strong>Information </strong>> <em>Display table depth</em>
The use of multiple, deep-nested tables in your email designs can severely affect email rendering across all email clients - some clients don't handle nested tables as well as others, meaning your carefully-crafted email and message might appear as a jumbled mess.  This command helps you determine how deep (in levels) your nested tables go.

<strong>Information </strong>> <em>Display title attributes</em>
Similar to alt tags, title tags are a great way to ensure your message is readable even if images are turned off by default in your recipient's inbox.

<strong>Information </strong>> <em>View document size</em>
Crucial in the design and development of email campaigns, the heavier a campaign is, the more likely it is to get flagged by a spam filter as malicious.  Ensuring your campaign's weight - both with and without images - is something you should check early and often.

Don't have the Web Developer toolbar add-on for Firefox yet?  <a href="https://addons.mozilla.org/en-US/firefox/addon/60">Download it here</a>.

----

Tags: email design,Email Marketing,quick tips

----

Categories: email design,Email Marketing,quick tips

----

Badge: post

----

Feeddate: 2009-12-08

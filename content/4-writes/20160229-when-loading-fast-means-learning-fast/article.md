Title: When loading fast means learning fast

----

Date: 2016-02-29

----

Author: aizlewood

----

Tags: responsive,performance budget,design,performance,clearleft

----

Text: 

A few years ago when [Mark wrote his article on performance budgets](http://clearleft.com/thinks/98), we were working together on a redesign for a luxury travel holiday website. 

The use of large images and typography to create a richer experience required the capping of a page’s weight so that I (the designer) didn’t get too ahead of myself. The budget meant I couldn’t throw the kitchen sink at Mark - unfairly - and expect him to work his magic and keep the page load time to a minimum.

In retrospect [he still worked his magic](http://clearleft.com/made/holiday-place), but thankfully the concept of setting a performance budget has spread like wildfire.  Entire design & dev teams are now sharing the responsibility, ensuring page load time gets treated as a first-class citizen.

Fast-forward to now. We’re helping a large education service provider design & develop an LMS (**Learning Management System**). It’s for teachers and students in low-bandwidth areas in India & South Africa. 

Users in some of these regions would _love_ to have the kinds of broadband speeds we have in the UK. Instead they’re faced with patchy and unreliable connections both in the classroom and outside of it. Yet they’re still using sites designed & built for audiences like those visiting our luxury travel site.

## Performance as a persona
A fast load time can considerably affect a user’s experience of a site (and its parent company) much more than design or branding ever could.

We realised that the experiences our users were having with other LMS’s might be setting a precedent for them to be slow, clunky and overweight. We had incentive to flip that precedent on its head, and put performance at the top of the list of requirements.

We used anecdotal research from our client to learn about our user’s behaviours, expectations, needs & goals. We embedded these characteristics into **visual proto-personas**, adding references to poor bandwidth, accessibility requirements and device usage. We used the personas to highlight performance and its importance to the product. 

This notion of performance became almost a persona onto itself, baked-in to the design and development work we’re doing now. It’s referenced in playbacks and conversations, crystallised in the visual personas that are still circulating throughout the organisation.

The concept - though new to our client at the start - was welcomed with open arms. We followed up the persona work with a set of fluid **KPIs** for our team; goals that we have direct influence on and that impact the success of the project directly. At the top of the list was our extremely aggressive performance budget - agreed upon with our client - that soon became the mainstay of our design process.

## Breaking it down
Most websites are created with a base mixture of HTML, CSS and Javascript, sprinkled with more stylistic features like imagery, video and fonts.  The blend of these ingredients can make the weight (measured in KBs or MBs) vary wildly. The more imagery and video used, the longer it will take for a user to download the page when connected.  The intention of a budget is to cap an average page’s weight to a size that allows the design to work without upping the weight into obscene numbers. 

Obviously this is a sliding scale. For the luxury travel site, that scale was more lenient than an LMS for developing markets.  In light of this, after consulting with our client and our internal team, we agreed upon a ranged target.  Our lowest, most aggressive target: **107KB**.  Our top-end range: **210KB**.  

We calculated this using [http://www.performancebudget.io/](http://www.performancebudget.io/). We aimed for a load time of 5 seconds over an average 2G connection.

## Killing the darlings
With the budget concept gaining traction, it was still up to us to evangelise, advocate and educate on why it was so crucial for this project. In some cases we had to sell the idea as best we could. 

During our playbacks we demonstrated designs that omitted any and all web fonts, except the two brand fonts used for titling. These helped impart the brand’s visual language.  We made the argument that though web fonts could help communicate the brand in its entirety, default fonts could suffice. 

With the leading Mobile OS in both target markets being Android, we knew it came pre-installed with Roboto and Droid Serif.  We designed most journeys using a mixture of these fonts. In other journeys we mixed it up, using Verdana and Times New Roman. The constant shifting of fonts helped ensure the typographic palette could stand on its own. It illustrated that performance could and should outweigh visual dominance without being conspicuous. 

As an outcome, our performance budget avoided approximately 150KB of added size after omitting several brand-specified weights.

## Thinking small screen
We also designed mobile, starting small screen first and worked outwards from there. Though a common method at Clearleft, it helped show the client the need to focus on the 80% of users outside the classroom.  

We started designing with textbook cover art, but realised we couldn’t author (and optimise) any imagery that would be used.  After feedback from the client we killed all imagery, bar iconography and basic illustrations.  As a result the ‘images’ part of our performance budget became close to zero.

## For the greater good
The project so far has been a terrific exercise in designing with real, consequential constraints.  So often we take things like accessibility, contrast, legibility and page weight for granted when designing for the modern web; it becomes easy to forget its users are _everywhere_.

As Tim Berners-Lee tweeted during the London 2012 Olympics: _**This is for everyone**_. The web shouldn’t be exclusive to those with fast broadband.  As designers we’re responsible for ensuring all users, regardless of location or situation, should be able to access the web. Better still, they should be able to access educational tools quickly and easily.

Will we achieve our intended performance budget, once the project moves into the production phase and backend?  It may be too early to say, but it’s the idea - and the advocacy now rife in our client’s organisation - that makes me confident it’s become a core principle and not a passing fad.  Watch this space.

_This post was originally published on the <a href="http://clearleft.com/thinks/377" rel="canonical">Clearleft blog</a>._

----

Badge: post

----

Feeddate: 2016-02-29

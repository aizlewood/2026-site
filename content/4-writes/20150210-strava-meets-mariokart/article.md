Title: Strava meets MarioKart

----

Date: 2015-02-10

----

Author: aizlewood

----

Tags: design,hack,strava,ar,clearleft

----

Text: 

This article was originally posted on the [Clearleft blog](http://clearleft.com/thinks/250).

Most Hack Farm projects start as someone's itch that needs scratching.  Last year's [TinyPlanner](http://clearleft.com/thinks/hackfarmingtinyplanner/) was [Boxman's](http://clearleft.com/is/james-box) need for a backwards to-do list.  Our 2012 Hack Farm ended up as a collaborative effort to improve [political opinion tracking](http://hackfarm.org/product), which was an itch shared by many. 

This year we voted on a number of projects and ideas (including [Blood Buddies](http://clearleft.com/thinks/hackfarmingbloodbuddies/)), but notably two of the candidates were completely Strava-based.  Not a coincidence seeing as about half of us in the office are avid bikers or runners.

If you're not familiar with it, [Strava](http://strava.com) is a hugely popular app used by runners and cyclists to track athletic activity.  Strava's **segments** feature - arguably its best USP - allows users to tag sections of a route and compare their effort with others, with best times dubbed PRs (Personal Records).  

Whereas the competition against others is gratifying, arguably it's the competition against one's self that's the most rewarding. It's this feature that makes Strava (at least for me) a terrific example of an app that positively affects behavioural change.

##Strava Echo

It was this concept of racing against one's best time - mixed with hours playing Nintendo64's MarioKart in my youth - that I had the idea of combining a Google Glass-type technology with Strava's segments and PR features. 

After helping with some initial UX and design for the other Strava-based idea ([Mark's](http://clearleft.com/is/mark-perkins) *Strata* ) [Andy T.](http://clearleft.com/is/andy-thornton) and I teamed up for the remaining 2 days to dive into all things HUD (Heads-up display) and near-future. We agreed to deliver a solid concept of what this solution might look and feel like, while conveniently leaving all technical and hardware limitations at the door. 

Related: Not everything at Hack Farm has to ship as code.

##The idea

The concept was simple but effective: Imagine being able to visualise your best time via a heads-up display that didn't impede or hamper your efforts.  

Taking inspiration from MarioKart's 'ghost rider', the intention was to display an avatar or representation of the rider/runner in the field of view.  Upon catching up or surpassing the ghost rider, the user would be notified of their status in real-time.

Our working hypothesis:

> Athletes and enthusiasts using Strava would be able to significantly improve their performance if racing in real-time against a **visible marker** representing a previous best.

## The process

Thinking through the concept, it emerged that *too much* 3D realism was a detail worth considering.  The computational requirements for mapping upcoming terrain in real-time started to look a bit too far-fetched.  Similarly, the aforementioned MarioKart style 'ghost rider' could become more of a safety concern with potentially too much focus afforded to it. We saw this in action in a [promo video for Jaguar's Ghost car navigation](http://youtu.be/rBN5CWMcOnE?t=1m) where the Ghost car could become a hindrance more than a help.

![Inspiration](https://dl.dropboxusercontent.com/u/60180697/hackfarm-2015/strava-ghost/collection.png)


### Design principles
As a result we decided to forego the realism in favour of an ambient, subtle notification process for alerting the rider or runner of their performance.  

Wanting to further reduce the cognitive load as much as possible, we began to draw up some **design principles** around the use of the product, with a focus on simply getting *out of the way*:

* **Eyes first.** Extend their primary active sense before broadening into others.
* **Hands free.** ~~No~~ Minimal touch or gestural interactions during the activity. Everything running passively.
* **Out of the way.** Nothing should impede situational awareness.
* **Non-lethal interruptions.** Any UI prompts need to be non-invasive for obvious safety reasons.
* **Not a dashboard.** No more than the minimum necessary information.

![Cognitive Load](https://dl.dropboxusercontent.com/u/60180697/hackfarm-2015/strava-ghost/cog-load.png)



### UI States
We then drafted up some common UI states that the HUD might display.  These ranged from the basics - default state, segment start, segment end  - to some more complicated ones including:

* *Neck-and-neck* (you are equal to your previous PR)
* *Near behind* (you've almost passed your PR)
* *Far ahead* (you've surpassed your previous PR)

At all times the user would be able to access their real-time info via a simple tap on their hardware/device.  Though not a dashboard, this information (duration, distance, average speed) is still relevant as basic activity metrics.


## Working with Keynote for prototyping

With more time and effort, it would have been nice to work this concept up into something more concrete than a keynote deck. 

That said, by simply embedding a video from one of my rides home (captured with [Andy P's](http://clearleft.com/is/andy-parker) Ghost Cam in the summer), we managed to overlay some concepts quickly and easily, helping communicate our thinking and ideas into a rudimentary prototype.  

<iframe width="420" height="315" src="https://www.youtube.com/embed/idOk7RNHlGE?rel=0" frameborder="0" allowfullscreen></iframe>

In the above (crude) demo, the flashing red fog indicates the 'neck-and-neck' state.  The arrow and seconds counting up indicate how far away you are from your PR (far behind). The inverse shows you catching up to your PR, which then flashes again as you push to beat it.  The flashing bar at bottom indicates the 'near ahead' state.

## Challenges & takeaways

Considering the limitations of the potential hardware, software and Strava itself, we noted several challenges that would need to be considered for this concept to become a reality.  The 3D realism and safety concerns, real-time tracking of Strava's segments via their API, hardware and battery limitations, route deviation, economic viability, activity type (run vs ride) and many more were all considered... but conveniently parked in the interest of simply trying something new.

![Challenges](https://dl.dropboxusercontent.com/u/60180697/hackfarm-2015/strava-ghost/challenges.png)



Ultimately the quick evolution of what could have been a very skeuomorphic UI into something almost sensory-heightening and ambient was really interesting. We stuck to our design principles and conceived an idea that we'd love to see turn into reality.  

There's already talk of Strava hooking up with Google Glass (even though it's now been 'sunset') but time will tell if this type of thing will come out of their great [labs division](http://labs.strava.com/). Fingers crossed!

----

Badge: post

----

Feeddate: 2015-02-10

=== Contact Camo ===
Contributors: planleft
Tags: email, anti-spam, obfuscate, security, antispam, anti spam, spam, protect
Requires at least: 5.0
Tested up to: 6.4.3
Stable tag: 1.0.11
License: GPLv2 or later
Contact Camo protects email addresses by obfuscating or completely hiding them in both the source code and the DOM.


== What Is It? ==
Contact Camo is a plugin for Wordpress developed by Plan Left that effectively hides or obfuscates email addresses from scammers, web scrapers and internet bots to help minimize spam and other nefarious, automated actors.

In addition to protecting  email addresses, Contact Camo also provides some granular control over how those protected  email addresses can be displayed and interacted with by users that are very useful to site builders and also help make site maintenance easier.


== Screenshots ==
1. Admin options after install.
2. Basic shortcode usage.
3. Configurable options.
4. Shortcode output.


== Example Use Cases ==
* Educational Organization with large faculty directories
* Nonprofits who need to be accessible without displaying in-content email addresses
* Large Organizations who have departmental pages and points of contact but don’t want to maintain multiple contact forms
* Anyone who doesn’t want to expose email addresses to the scammers, scrapers and bots of the internet.


== Why Did You Make This Plugin? ==
We work with many non-profits and educational organizations that need to list contact info in directories on their website. Due to the public visibility of these and their large user base, our clients web properties are under constant threat from spammers and bots. We wanted to ensure that their user directories were safe from these threats while still being functional to visitors. In other words, we needed to hide a bunch of email addresses from the outside world while still allowing the outside world to contact those users via their email address. When we got to developing this plugin, we knew we had to provide a solution that was as bulletproof as possible while allowing our clients and customers the most amount of control over things as practical.

= Ultimately, we needed to create a plugin that would: =

* Optionally hide or obfuscate email addresses from scrapers and bots securely and confidently. For our use case, email addresses needed to be obfuscated in the source code, the DOM, and in HTTP requests. We took the email address out of the client-side equation completely by just tucking it safely away in the database in a lookup table instead of providing a workaround that simply disguises the email address. We essentially took the email address to a safe house and sent out its representative to interact with the outside world on its behalf. Nobody gets the email, not no way, not no how, see?!?
* Provide users with lots of control over the UX of protected  email addresses, but without the need for cumbersome configuration. We decided a shortcode with some good options and sensible defaults would foot the bill for most users.
* Be performant in capabilities, lightweight in footprint, and opinionated in scope.

The client was very pleased with the end-result and so were we. So, we decided to offer it back to the community. Our development team reviewed and scrutinized the existing plugin, found areas for improvements and further customizations, and baked them right in for everyone to use.


== Who Is It For? ==
Site administrators and content editors/moderators. Anyone with a Wordpress site that would like the peace of mind of knowing that their user's email addresses are safely hidden from spam bots and other unintended consumers with ill intent. Content creators that don't want to worry about the complications and time expenditure of dealing with and managing their user base getting spammed from their platform. And especially when any of the above mentioned require some level of control over what's displayed to their users, who may very well be their customers or clients or patients, etc…It's for site builders that want protection AND customization without being overwhelmed.


== What Problems Does It Solve? ==
Contact Camo hides or obfuscates email addresses in the source code AND the DOM. Not only this, it ensures the unobfuscated email address is never used in any page or ajax request from its originating context; all handling/processing is done server-side. Once obfuscated, the client-side never sees the original email address again (where obfuscated). The obfuscation (key) is a hash that is stored in a lookup table with the original email address.

A few of the limitations we found in some existing (but great) plugins:

* email address only obfuscated in DOM, but not in source code
* email address only obfuscated in source code, but not in the DOM
* integrating with a 3rd-party service that scrapes entire pages and performs a search-and-replace of email addresses with obfuscated versions in the source code
* email address obfuscation using only html entities replacement
* few options for control   ling output
* no contact form or fallback options


== How Does It Work? ==
Contact Camo provides a simple shortcode that can be used to manually obfuscate or hide email addresses and control how those email address are presented back to the end-user.

This shortcode's eventual default output is a clickable link with the obfuscated email address's generated hash stored in a data attribute. On click, this hash is used to lookup the email address (or generate and store a new hash in your database for that email if one doesn't already exist) and then open the browser's configured email client with the "To" field pre-populated with the corresponding email address.

The shortcode accepts several parameters for overriding the default output. Output a button instead of a link, add CSS classes, change the text output, etc... The sky's the limit for display.

The shortcode also has parameters for displaying an embedded contact form or an optional modal popup contact form instead of a clickable link that opens the browser's default email client.


== What is Hide vs Obfuscate? ==
For our plugin, we wanted to give site administrators the option to either completely hide the email address and never let any end content consumer see any piece of the email, or to hide the email until requested and reveal it in context after a specific action is taken.

* **Hiding the email address:** The site visitor will never see the email address, and instead only be presented a popup contact form that submits and mails through ajax. This option totally hides the email, and it will never be revealed unless the emailed recipient emails the form submitter back.
* **Obfuscating the email address:** The site visitor will not see the email address until the contact button (or link) is clicked. On click, the email address will be revealed and the visitor can copy or mail to that address.


== What Can I Do With It? ==
We chose to err on the side of simplicity, balanced with enough options as to be useful. To this, we default to an anchor tag output, or - if overridden - a clickable button. We give the user control over which of these as well as css classes and an id. The text output is configurable. And with one option, you can have a modal contact form popup when users click on your link. All without showing the email address you want to use, but hide. Hide for real for real.  The plugin includes template files if you wish to really change the output, like maybe you want a different wrapper, or need to include some custom data attributes for javascript to use. We thought about adding all that level of configuration to our shortcode, but figured if you were at that point, you'd probably also know how to edit a template file ;)

= Basic Usage: =

* **`[contactcamo email="contact@example.com"]`**

output: a basic anchor tag with default text


* **`[contactcamo email="contact@example.com" label="Contact Us" form=true button=true]`**

output: a clickable button with text that says "Contact Us".


* **`[contactcamo email="contact@example.com" label="Contact Us" form=true button=true popup=true]`**

output: a clickable button with text that says "Contact Us" that, when click, pops up a modal contact form


* **`[contactcamo email="contact@example.com" subject="ContactCamo" class="mail-icon-lg mail-link"]`**

output: a link with default text typographically styled along with an inline mail icon


* **`[contactcamo email="contact@example.com" id="one-contactcamo-to-rule-them-all" label="Fly, You Fools!" button=true class="btn btn-lg btn-lt-blue mail-icon-sm"]`**

output: a large, light blue clickable button with text that says "Fly, You Fools!" along with an inline mail icon


= Shortcode Parameters =

* **email** *required string*
the email address to be obfuscated

* **label** *optional string default="Email"*
the text output

* **subject** *optional string*
the text to populate mail subject lines

* **class** *optional string*
the css class(es) to add to the anchor/button html output, space delimited

* **id** *optional string*
the css id to add to the anchor/button html output

* **form** *optional boolean default=false*
if true, output contact form in place of link

* **popup** *optional boolean default=false*
if true, output link that opens modal contact form on click

* **button** *optional boolean default=false*
if true, output link as a clickable button instead of an anchor tag

There is also an admin page for Contact Camo. From this page, you can configure where the contact form redirects after form submission.

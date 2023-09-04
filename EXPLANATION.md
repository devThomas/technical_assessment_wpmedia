
1/ The problem to be solved in your own words

The problem to solve is to analyze which links will be read and referenced by search engines on my website.

2/ A technical spec of how you will solve it

To solve this problem, I will create a WordPress plugin that will create a page in the WordPress admin dashboard. This page will be able to initiate a crawl of the homepage and store the discovered URLs in temporary memory until the next generation of the sitemap or after 1hour without any action from the crawl .
The crawl will have an option to automatically relaunch every hour with the same process.

The plugin will be able to display the latest results upon the administrator's request. In case of an error, the plugin will provide details about the issue encountered during the process.

If the sitemap.html exists, the plugin will add a link on the homepage for visitors to access and view it.

3/ The technical decisions you made and why

The chosen direction focuses on simplicity, user friendly, and compatibility. I got a Boilerplate template for organise my work ensures that the plugin is easy to maintain, and upgrade in the future.

4/ How the code itself works and why

The administrator logs into the plugin's administration page in the WordPress dashboard.
The administrator manually triggers the crawl by clicking on an appropriate button.
A checkbox is available for the administrator to enable the crawl to run every hour.
when the crawl is launching, the previous crawl results and the existing sitemap.html file, if any, are deleted.
The crawl analyzes each available link on the administrator's page.
The crawl results are temporarily stored in a database for one hour.
The results are displayed on the plugin's administration page after the crawl is launched or can be displayed by pressing the second button implemented for this purpose.
The sitemap is saved as a sitemap.html file in a list format.
If the plugin is uninstalled, the automatic crawl will be disabled if it is enabled.


5/ How your solution achieves the admin’s desired outcome per the user story

My solution provides the administrator with a convenient interface to visualize the links on their website from the homepage. The plugin performs regular crawls if requested by the administrator. The crawl temporarily stores the results and displays them on the administration page. This allows the administrator to study these results to improve their SEO.

Think out loud. We want to know:

1/ How you approach a problem

When I approach a problem, I try to get all the necessary details from the client. I'm not afraid to ask more questions to understand the request better. I do my best to write clear code, which makes it easier to update the plugin in the future and more readable for other developers who will work on it after me.

2/ How you think about it

I create a user friendly interface for a smooth user experience. When it comes to the code, I prioritize compatibility and use popular folder organization methods.

3/ Why you chose this direction

To make the plugin as user-friendly as possible and minimize user confusion, I focus on simplicity. Regarding the code, I choose an approach that makes it easier for future developers to work with and maintain the plugin.

4/ Why this direction is a better solution

Its better for the futur maintain and upgrad the plugin if needed.

PS : More detail about the test and my apply

I got some issues while using some tools in the development kit due to my Windows env. This make me regret not having installed dual boot on my computer in the past.
I did my best making this test, but my skills in unit testing are not very advanced. My test is simple and maybe doesnt match with company expectations. However, I want you to know that I am highly motivated to improve my skills in WordPress development and unit testing. If you believe in me, I will not disappoint you because I am always open to challenges and not afraid of difficulties. I am determined to level up in any situation.

Thank you for taking time to read my message, and i would appreciate any feedback you can provide. i hope to proceed to the next steps of the application process.




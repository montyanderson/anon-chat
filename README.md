anon-chat
========

An online chat that uses MongoDB.

Features:
---------

* Base-64 encodes traffic to avoid swearing/monitoring filters.
* Automatically stores different domains in different collections.
  * So you can host multiple different chatrooms on the same server.
  * Works best with apache virtualhosts.
* Requires minimal setup-time.
* Allows for admin logins.
  * Admins can set the colour of their name (to show their status).
  * Admins can see IPs (in order to identify people).
  * Admins will be able to delete messages.

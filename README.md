# A Lighthouse Style Guide: Wordpress

*How we do it why we do it and some resources to help you*

## Table of Contents
1. Project Structure
2. Theme
2. Custom Post Types
3. Custom Taxonomies
4. Custom Meta (Boxes)
5. Plugins

# Wordpress Best Practice

When setting up a site use these defaults:

Never use Admin as a username. The main admin user should be something unique that relates to the client name. Passwords should be strong (use 1Password's generator if you're unsure) and unguessable. 

Never use the standard Wordpress table prefix, always use a table prefix that relates to the client name.

Once logged in create a secondary Lighthouse user with admin privilegegs. Make sure you store both the client username / password and Lighthouse username / password in 1Password. Also make sure that you store the admin panel URL (this can change based on the framework you're using - Roots, standard WP etc.)

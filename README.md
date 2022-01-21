## About this project

This is a simple demonstration project that consumes the Hail Articles' API with backend OAuth authentication.

## Installation Guide

1. Clone the git repository
2. run `sail build` then `sail up`
3. Configure the .env file (copy the .env.example)
    > Make sure you have a working database and cache driver (as per Laravel documentation.)
    > Set your Hail OAuth credentials: `HAIL_CLIENT_ID` and `HAIL_SECRET`
    > To create OAuth application credentials, these can be found under your Account settings → Manage developer settings.
4. run `sail artisan migrate`
5. run `sail artisan oauth:connect hail`
    > Open the URL from the output in your browser and follow the prompts.
6. run `sail artisan organisation:list` to retrieve a bunch of org ids and their names
7. Set `HAIL_ORG_ID=` to one of the IDs return from the previous command
8. Run the unit tests `sail test`

**Tip:** You can change the `...PORT...` fields in the .env to avoid clashing with other applications that might be using 80, 3306, or 6379 on your host.
Make sure to run `sail build` and `sail up` after making the port changes.

##### These resources may help with installation

-   https://laravel.com/docs/8.x/configuration
-   https://laravel.com/docs/8.x/sail
-   https://laravel.com/docs/8.x/installation

##### Hail API Documentation

-   https://developers.hail.to/api/introduction

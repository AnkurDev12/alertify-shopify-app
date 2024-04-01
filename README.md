1. Create partners account
2. Create test app
3. Save client id api key and secret key
4. Intsall laravel fresh project
5. Install composer require kyon147/laravel-shopify for shopify app setup
6. then run php artisan vendor:publish --tag=shopify-config
7. now setup some important configuration like app_name, api_key, api_secret, and api_scopes, client id, and secret key. webhooks and script tags are optional
8. In shopify app under configuration option we need to set our development url and callback url in app settings.
9. For development url we can use ngrok to create tunnel
10. development url will be the domain given by ngrok and callback url will be {domain_given_by_ngrok}/authenticate


{% if product.metafields.alertify-custom-description and product.metafields.alertify-custom-description.custom-description!=blank %}
    {{ product.metafields.alertify-custom-description.custom-description }}
{% endif %}


Configuration document: https://github.com/Kyon147/laravel-shopify/wiki/Installation#configuration
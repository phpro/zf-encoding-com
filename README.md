# zf-encoding-com

This module is a wrapper for calling the Encoding.com API.
It is based on package "svilborg/guzzle-encoding-com". 

# Installation
## Add to composer.json
```
"phpro/zf-encoding-com": "~0.1.0"
```

## Add to application config
```php
return array(
    'modules' => array(
        'Phpro\\EncodingCom',
        // other libs...
    ),
    // Other config
);
```

## Configuration
Copy the file `config/phpro_zf_encoding_com.local.php.dist` to the autoload folder of your application.

## Configuration options:
### API

- user ID: The API user ID
- user key: The API user key

### Notify
- format: xml or json
- notify_route: defaults to encodingcom/notify
- notify_service: the key of the service that needs to be called when receiving a notification. Note: this service must implement NotifyInterface

### Local tunnel
When you are running the application on a domain that is not publicly available, it is possible to use a service like ngrok.
Ngrok will run on a custom domain name, so you will need to enable this local tunnel in configuration:

- enabled: true / false
- host: the host of the tunnel. E.g: subdomain.ngrok.com

### Hash
For security reasons, a hash is added to the notification routes. Please specify a unique string which match regex: [0-9a-zA-Z]*



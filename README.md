﷽

# Residue PHP Client
A very simple, secure PHP library to interact with residue seamlessly.

This library provides interface for connecting and interacting with residue server seamlessly, means, once you are connected this module takes care of expired tokens and clients and keep itself updated with latest tokens and ping server when needed to stay alive.

[![Version](https://img.shields.io/github/release/muflihun/residue-php.svg)](https://github.com/muflihun/residue-php/releases/latest) [![GitHub license](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://github.com/muflihun/residue-php/blob/master/LICENCE) [![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/MuflihunDotCom/25)

[**This is in early stages of development and should not be used in production**]

## Dependencies
This library currently depends on following binaries

 * `ripe`
 * `nc` (netcat)

Please check out [sample configuration](/samples/client.conf.json) to find out more

## Progress
Does not support following features at the moment

 * Unknown clients
 * Bulk requests
 * Compression (will require when bulk requests is done)
 * Plain log request
 * Custom key size

## Config

| **Config** | **Type** | **Description** |
|------------|----------|-----------------|
| `url`      | String   | Combination of URI and port of residue server |
| `access_codes`      | Object   | Array of access codes |
| `application_id`      | String   | Application ID for `%app` format specifier |
| `rsa_key_size`      | Number   | RSA key size (generated randomly) for unknown clients |
| `time_offset`      | Number   | Log time offset (in seconds) |
| `client_id`      | String   | Client ID that server knows this client as |
| `client_private_key`      | String   | Full path of RSA private key |
| `client_key_secret`      | String   | Secret (passphrase) for encrypted private key (if any) |
| `server_public_key`      | String   | Full path to server public key (if any) |
| `ripe_bin`      | String   | Command to successfully run [ripe](https://github.com/muflihun/ripe) binary using user that will run your PHP script |
| `nc_bin`      | String   | Command to successfully run [nc](https://linux.die.net/man/1/nc) binary using user that will run your PHP script |
| `session_dir`      | String   | Full path to empty directory for storing temporary objects by script (e.g, connection params, tokens etc) |
| `reset_conn`      | Number   | Resets the connection and ignores objects in `session_dir` after these seconds |
| `internal_log_file_limit` | Number | Maximum limit (in KB) for internal logging file (stored in `<session_dir>/internal.log`). Defaults to 2048 KB |

### Sample Config
```
{
    "url": "localhost:8777",
    "access_codes": [
        {
            "logger_id": "sample-app",
            "code": "a2dcb"
        }
    ],
    "application_id": "com.muflihun.residue.php.sampleapp",
    "rsa_key_size": 2048,
    "time_offset": 0,
    "client_id": "muflihun00102030",
    "client_private_key": "keys/muflihun00102030.pem",
    "client_key_secret": "",
    "server_public_key": "keys/server.pub.pem",
    "ripe_bin": "ripe",
    "nc_bin": "nc",
    "session_dir": "/tmp/resphp/",
    "reset_conn": 120,
    "internal_log_file_limit": 2048
}
```
## Usage
```
// initialize only once in the beginning of the script
\residue\Residue::init("client.conf.json");

$logger = new \residue\Logger("sample-app");


$logger->debug("another");

// array
$logger->info([1, 2]);

// object
$logger->info("blah %s this", $myCar);

// number
$logger->info(1234);
$logger->info(1234.233);

// formatted (see http://php.net/manual/en/function.sprintf.php)
$logger->info("test %s %s", 1, 2);


// verbose log
$logger->verbose(9, "this is msg %d ---", 123);

```

## License
```
Copyright 2017-present Muflihun Labs

https://github.com/muflihun/
https://muflihun.com

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
```
![Build badge, since nobody will even look at this shit without one.](https://travis-ci.org/chainfailure/bitpay-rates-api.svg?branch=master)

## What is this?
I built this microservice to easen up the process of hooking up copay to your own rate service.

## How does it work?
It fetches the prices from some other service (currently coinmarketcap) and answers the request with a response similair in format to [the bitpay rates API used by copay](https://bitpay.com/api/rates).

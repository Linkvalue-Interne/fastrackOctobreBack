#!/bin/sh
mkdir -p config/jwt
openssl genpkey -pass pass:$JWT_PASSPHRASE -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -passin pass:$JWT_PASSPHRASE -in config/jwt/private.pem -out config/jwt/public.pem -pubout

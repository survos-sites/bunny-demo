# Storage and Images Demo

This application integrates bundles related to storage and image management.

* survos/storage-bundle: Flysystem wrapper
* survos/bunny-bundle (lower-level)
* liip/imagine-bundle (thumbnails)
* survos/flickr-bundle

## Terminology

* storageZone: the key in flysystem.yaml 
* adapter: the underlying adapter for the storage, hidden in Flysystem, exposed here.

## Development

composer config repositories.bunny '{"type": "path", "url": "/home/tac/g/sites/survos/packages/bunny-bundle"}'
## Adapters

While the goal is to test flysystem / liip with all storage adapters, these are integrated now.

* AWS/S3
* local

Setup requires getting an API key for each storage.

To create a new S3 bucket

```bash
aws s3api create-bucket \
    --bucket survos-storage-demo-1 \
    --region us-east-1 

aws s3api create-bucket \
    --bucket amzn-s3-demo-bucket1$(uuidgen | tr -d - | tr '[:upper:]' '[:lower:]' ) \
    --region us-west-1 \
    --create-bucket-configuration LocationConstraint=us-west-1
    ```

## Command line

```bash
bin/console survos:storage:list
# syncs between zones
bin/console survos:storage:sync default:storage pictures:storage --recursive --include=*.jpg 
```

```bash
git clone git@github.com:survos-sites/bunny-demo.git
cd bunny-demo
composer install
../survos/link .
symfony check:req

symfony server:start -d
symfony open:local 
```

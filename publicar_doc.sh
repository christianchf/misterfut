#!/bin/sh

rm -rf docs/
vendor/bin/apidoc api commands,controllers,assets,models,views docs/api --pageTitle="MisterFut API" --guide=.. --guidePrefix= --interactive=0
vendor/bin/apidoc guide guia docs --pageTitle="Guía de MisterFut" --guidePrefix= --apiDocs=api --interactive=0
ln -sf README.html docs/index.html
touch docs/.nojekyll

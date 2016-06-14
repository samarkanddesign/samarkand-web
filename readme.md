# Samarkand Design

This is the official web application of Samarkand Design.

## Usage

1. Clone the repo to your working directory
2. Run `composer install` to install dependencies
3. Set your environment variables, including database config. (see `.env.example` for examples)
4. Serve it up and enjoy

### Notes on environment variables

- The cache driver should be one that supports cache tags (e.g. memcached, redis).
- Cache time specifies the default number of minutes that a cache entry will be retained in the cache. This is so values like this are not hard-coded.
- Not all config entries are in `.env.example`. Check individual config files for more options.

## Contributing

Development is by Git Flow. To add a feature contribute create a branch from the dev branch called `feature/<feature-name>` and pull request back to the dev branch.

All the tests should pass before trying to merge. This is checked using TravisCI.

PSR-2 code style should be used throughout. This is auto-checked with StyleCI

### Front End

The app uses npm modules with browserify for front-end scripts. Vue components are used and compiled with vueify. You should install the node dependencies with `npm install` before making changes.

Styles are compiled from SASS. Some bower dependencies are used (install them with `bower install`).

The whole lot can then be recompiled by running `gulp`.


[1]: https://almsaeedstudio.com/
